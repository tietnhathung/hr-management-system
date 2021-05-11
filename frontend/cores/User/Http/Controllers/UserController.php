<?php

namespace Core\User\Http\Controllers;

use App\Models\User;
use Core\Role\Repositories\Interfaces\IRoleRepository;
use Core\User\Repositories\Interfaces\IUserRepository;
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
    protected $userRepository;
    protected $roleRepository;

    public function __construct(
        IUserRepository $iUserRepository,
        IRoleRepository $iRoleRepository
    ){
        $this->index_page = 'user.index';
        $this->userRepository = $iUserRepository;
        $this->roleRepository = $iRoleRepository;
    }

    public function index(Request $request){

        $username = $request->name;

        $users = $this->userRepository->paginate($username);

        return view('user::index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function create(){

        $obj = $this->userRepository->getInstance();

        $role_list = $this->roleRepository->getAll();

        $obj->user_roles = array();

        return view('user::create', compact('obj', 'role_list'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function store(UserRequest $request){


        $role_list = $this->roleRepository->getAll();

        if (!empty($request->user_roles)){
            foreach ($request->user_roles as $roleId) {
                if (!$role_list->contains("id", $roleId)) {
                    return redirect()->back()->with("error-message", "The role does not exist");
                }
            }
        }

        $obj = $this->userRepository->create($request->except([]));

        if($obj == null){
            return redirect()->back()->with("error-message", "There was an error in adding user!");
        }
        if ($request->has([ 'error_description' ])) {
            $errors = implode(',', $request->error_description);
        }

        LoggingHelper::infor("","Thêm người dùng ",$obj->fullname);

        return redirect(route($this->index_page))->with('flash-message', "You have added the user successfully");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function show($id)
    {
        $user = $this->userRepository->findById($id);
        if (!$user){
            return redirect("/")->with("error-message", "Data does not exist or is not allowed to access");
        }

       return view('user::show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function edit($id){
        $id = (int)$id;
        if ($id < 1) return redirect(route($this->index_page))->with("error-message", "Date error");
        if ($id  == Auth::id()) return redirect(route($this->index_page))->with("error-message", "Date error");

        $obj = $this->userRepository->findById($id);
        $role_list = $this->roleRepository->getAll();
        $obj->user_roles = $obj->roles()->pluck("id")->toArray();

        return view('user::edit', compact('obj', 'role_list'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserEditRequest $request, $id){

        $role_list = $this->roleRepository->getAll();
        if (!empty($request->user_roles)){
            foreach ($request->user_roles as $roleId) {
                if (!$role_list->contains("id", $roleId)) {
                    return redirect()->back()->with("error-message", "The role does not exist");
                }
            }
        }

        $obj = $this->userRepository->update($id ,$request->except([]));

        if ( $obj === null ) {
            return redirect()->back()->with("error-message","There was an error in updating user!");
        }

        foreach ($obj->roles as $role) {
            if ($role_list->contains("Id", $role->Id)) {
                $obj->removeRole($role);
            }
        }

        if (is_array($request->user_roles)){
            foreach ($request->user_roles as $rid) {
                $role = Role::findById($rid);
                $obj->assignRole($role);
            }
        }

        LoggingHelper::infor("","Update user ",$obj->fullname);

        return redirect(route($this->index_page))->with('flash-message', "You have successfully updated the data");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        if (!is_numeric($id)) {
            return response()->json(['status'=>2,'message'=>"Invalid data, please check again."]);
        }

        if ($id  == Auth::id()){
            return response()->json(['status'=>3,'message'=>"Can't delete your own account."]);
        }

        $isDeleted = $this->userRepository->delete($id);

        if(!$isDeleted){
            return response()->json(['status'=>1,'message'=>'You have failed to delete the user!']);
        }

        LoggingHelper::infor("","Delete users ", $id);
        return response()->json(['status'=>0,'message'=>'You have successfully deleted '.$id.' user']);
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
