<?php

namespace Core\Role\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Core\Logging\Helpers\LoggingHelper;
use Core\Role\Http\Requests\RoleRequest;
use Core\Role\Http\Requests\RoleEditRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    protected $index_page;

    public function __construct()
    {
        $this->index_page = 'role.index';
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(30);
        return view('role::index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $obj = new Role();
        $permission_list = Permission::all()->pluck('title', 'id');
        $obj->role_permissions = array();

        return view('role::create', compact('obj', 'permission_list'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(RoleRequest $request)
    {
        $obj = new Role();
        $obj->name = $request->name;
        //$obj->level = (int)$request->level;
        if ($request->has ( [
            'error_description'
        ] )) {
            $errors = implode ( ',', $request->error_description );
        }

        $obj->save();

        $permissions = null;
        if (is_array($request->role_permissions)) {
            $permissions = Permission::whereIn('id', $request->role_permissions)->get();
        }

        $obj->syncPermissions($permissions);
        LoggingHelper::infor("","Thêm User groups ", $obj->name);

        return redirect ( route($this->index_page))->with ( 'flash-message', "Nhóm người dùng đã được thêm vào thành công!" );
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('role::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $obj = Role::find($id);
        $permission_list = Permission::all()->pluck('title', 'id');
        $obj->role_permissions = $obj->permissions()->pluck("id")->toArray();
        LoggingHelper::infor("","Update user groups ", $obj->name);

        return view('role::edit', compact('obj', 'permission_list'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(RoleEditRequest $request, $id)
    {
        $obj = Role::find($id);
        if( $obj->name!=$request->name)
        {

            $messages = [
                'name.required' => 'User groups names already exist on the system!',
            ];
            $validator = $request->validate([
                'name' => 'unique:roles',

            ], $messages);
        }
        $obj->name = $request->name;
        //$obj->level = (int)$request->level;
        $obj->save();

        $permissions = null;
        if (is_array($request->role_permissions)) {
            $permissions = Permission::whereIn('id', $request->role_permissions)->get();

        }
        $obj->syncPermissions($permissions);

        return redirect ( route($this->index_page))->with ( 'flash-message', "You have successfully updated the data" );
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (! is_numeric ( $id )) {
            redirect ( route($this->index_page))->with ( "flash-message", "Data does not exist" );
            return;
        }
        $obj =Role::find($id);
        $obj->delete ();

        LoggingHelper::infor("","deleted user groups ", $obj->name);

        return response()->json(['message'=>'You have successfully deleted '.$obj->fullname.' user']);
    }


    public function destroyMany(Request $request) {

        $ids = $request->id;
        $check = true;
        if (is_array($ids)) {
            foreach ($ids as $id) {
                if ($id != (int) $id) {
                    $check = false;
                }
            }
        } else {
            $ids = (int)$ids;
            if ($ids>0) {
                $this->destroy($ids);
                return redirect ( route($this->index_page));
            }

            $check = false;
        }

        if ($check) {
            Role::whereIn('id', $ids)->delete();
            LoggingHelper::infor("","Delete multiple User groups", $id);

            return redirect ( route($this->index_page) )->with ( "flash-message", "You have successfully deleted" );

        }

        return redirect ( route($this->index_page))->with ( "error", "Error data, Please try again" );

    }
}
