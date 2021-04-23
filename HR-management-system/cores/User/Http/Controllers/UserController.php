<?php

namespace Core\User\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Core\Logging\Helpers\LoggingHelper;
use Core\User\Http\Requests\UserEditRequest;
use Core\User\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    protected $index_page;

    public function __construct()
    {
        $this->index_page = 'user.index';
    }

    public function index(Request $request){

        $username = $request->name;

        $users = User::when($username, function($query) use($username) {
                $query->where("fullname", "like" , "%$username%");
                $query->orWhere("email", "like" , "%$username%");
                $query->orWhere("username", "like" , "%$username%");
            })
            ->orderBy('Id', 'DESC')->paginate(30);

        return view('user::index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request){
        $obj = new User();
        $role_list = Role::all();

        $obj->user_roles = array();

        return view('user::create', compact('obj', 'role_list'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(UserRequest $request){


        $role_list = Role::all();

        if (!empty($request->user_roles))
            foreach ($request->user_roles as $roleId) {
            if (!$role_list->contains("id", $roleId)) {
                return redirect()->back()->with("error-message", "Delete user, Please try again");
            }
        }

        $obj = User::create($request->except([]));

        $obj->password = bcrypt($request->password);

        if ($request->has([
            'error_description'
        ])) {
            $errors = implode(',', $request->error_description);
        }

        $obj->save();

        if (is_array($request->user_roles))
            foreach ($request->user_roles as $rid) {
                $role = Role::findById($rid);
                $obj->assignRole($role);
            }
        LoggingHelper::infor("","Thêm người dùng ",$obj->fullname);

        return redirect(route($this->index_page))->with('flash-message', "You have added the user successfully");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user)
            return redirect("/")->with("error-message", "Data does not exist or is not allowed to access");

       return view('user::show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id){
        $id = (int)$id;
        if ($id < 1) return redirect(route($this->index_page))->with("error-message", "Date error");
        if ($id  == Auth::id()) return redirect(route($this->index_page))->with("error-message", "Date error");
        $obj = User::find($id);
        $role_list = Role::all();
        $obj->user_roles = $obj->roles()->pluck("id")->toArray();

        return view('user::edit', compact('obj', 'role_list'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UserEditRequest $request, $id){

        $role_list = Role::all();
        if (!empty($request->user_roles))
            foreach ($request->user_roles as $roleId) {
            if (!$role_list->contains("id", $roleId)) {
                return redirect()->back()->with("error-message", "Date error, Please try again");
            }
        }

        $obj = User::find($id);
        $obj->fullname = $request->fullname;
        $obj->email = $request->email;
        $obj->status = (int)$request->status;
        $obj->mobile = $request->mobile;
        $obj->position = $request->position;
        $obj->type = (int)$request->type;
        $obj->app = (int)$request->app;
        if ($request->password != "")
        {
            if($obj->password != bcrypt($request->password))
            {
                $user = Auth::user();

                // logout user
                $userToLogout = User::find($id);
                $userToLogout->password = bcrypt($request->password);
                Auth::setUser($userToLogout);

                //Auth::logout();
               // Auth::logoutOtherDevices($userToLogout->getAuthPassword());
                Auth::guard($userToLogout->name)->logoutOtherDevices($request->password, 'password');
                // set again current user
                Auth::setUser($user);
            }
            $obj->password = bcrypt($request->password);

        }

        $obj->save();

        foreach ($obj->roles as $role) {
            if ($role_list->contains("Id", $role->Id)) {
                $obj->removeRole($role);
            }
        }
        if (is_array($request->user_roles))
            foreach ($request->user_roles as $rid) {
                $role = Role::findById($rid);
                $obj->assignRole($role);
            }
        LoggingHelper::infor("","Update user ",$obj->fullname);

        return redirect(route($this->index_page))->with('flash-message', "You have successfully updated the data");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        if (!is_numeric($id)) {
            return abort(404, "Invalid data, please check again.");
        }

        if ($id  == Auth::id()) return abort(500, "Can't delete your own account.");

        $obj = User::find($id);
        if (!$obj) {
            return abort(404, "Can not find the user to delete.");
        }

        $obj->delete();

        LoggingHelper::infor("","Delete users ", $obj->fullname);

        return response()->json(['message'=>'You have successfully deleted '.$obj->username.' user']);

    }

    public function updateStatus(Request $request)
    {
        $id = (int)$request->id;

        if ($id<1) return abort(404, "Data does not exist");
        $status = (int)$request->status;
        $status = ($status==0)?0:1;
        $obj = User::find($id);
        if (!$obj) return abort(404, "Data does not exist");
        $obj->status = $status;

        $obj->save();

        LoggingHelper::infor("","Change user status ",$obj->fullname);

        return response()->json(['message'=>'You have successfully changed the ' . $obj->username . '  user status ']);
    }


    public function logout($id)
    {
        $obj = User::find($id);
        $obj->accesstoken_app = null;
        $obj->save();
        LoggingHelper::infor("","Exit user login session ",$obj->username);

        return response()->json(['message'=>'You have successfully canceled the '.$obj->username.' user login session']);
    }

    public function destroyMany(Request $request)
    {
        $ids = $request->id;

        $check = true;

        if (is_array($ids)) {

            foreach ($ids as $id) {
                if ($id != (int)$id) {
                    $check = false;
                }
            }

        } else {
            $ids = (int)$ids;
            if ($ids > 0) {
                $obj=User::find( $ids);
                $this->destroy($ids);
                LoggingHelper::infor("","Delete user ",$obj->Name);

                return redirect()->back()->with("flash-message", "You have successfully deleted");
            }

            $check = false;
        }
        if ($check) {

            User::whereIn('id', $ids)->delete();

            LoggingHelper::infor("","Delete users","");

            return redirect()->back()->with("flash-message", "You have successfully deleted");
        }

        return redirect()->back()->with("error", "Data error, Please try again");

    }

}
