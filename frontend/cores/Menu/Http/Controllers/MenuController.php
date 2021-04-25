<?php

namespace Core\Menu\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Core\Logging\Helpers\LoggingHelper;
use Core\Menu\Entities\Menu;
use Core\Menu\Helpers\MenuHelper;
use Core\Menu\Http\Requests\MenuEditRequest;
use Core\Menu\Http\Requests\MenuRequest;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{

    protected $index_page;

    public function __construct()
    {
        $this->index_page = 'menu.index';
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function index()
    {
        $menus = Menu::getAllMenuBuildTree();
        $this->_data['menus'] = $menus;

        return view('menu::index', $this->_data);
    }

    private function removeSession(){
        session()->forget('admin_menus');
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $fileJson =  __DIR__."./../../Resources/assets/json/font-awesome.json";
        $listIcon = json_decode(file_get_contents($fileJson), true);

        $obj = new Menu();
        $menus =  Menu::orderBy(DB::raw('ABS(`order`)'))->orderBy('id', 'ASC')->get();
        $mTree = array();
        MenuHelper::buildTreeMenu_select($menus, $mTree, 0);
        $m = collect($mTree);
        $menuTree = $m->pluck("text", "value");
        $menuTree->prepend ( 'Chọn Menu', '0' );
        $permission_list = Permission::all();
        $obj->permissions = $obj->permissions()->pluck("id")->toArray();
        return view('menu::create', compact('obj', 'menuTree', 'permission_list','listIcon') );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(MenuRequest $request)
    {

        $this->removeSession();
        $obj = Menu::create ( $request->except ( [ ] ) );
        $obj->target = isset($request->target)?"_blank":"_self";
        $obj->parent_id=(int)$request->parent_id?? 0;
        $obj->status=(int)$request->status;
        $obj->menu_title = (int)$request->menu_title ?? 0;
        if ($request->has ( [
            'error_description'
        ] )) {
            $errors = implode ( ',', $request->error_description );
        }

        $obj->save();

        $permissions = null;
        if (is_array($request->permissions)) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();

        }

        $obj->syncPermissions($permissions);


        LoggingHelper::infor("","Add new menu ",$obj->name);

        return redirect ( route($this->index_page))->with ( 'flash-message', "Add New Menu Success!" );
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('menu::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $fileJson =  __DIR__."./../../Resources/assets/json/font-awesome.json";
        $listIcon = json_decode(file_get_contents($fileJson), true);
        $obj = Menu::find($id);
        $menus =  Menu::orderBy(DB::raw('ABS(`order`)'))->orderBy('id', 'ASC')->get();
        $mTree = array();
        MenuHelper::buildTreeMenu_select($menus, $mTree, 0);
        $m = collect($mTree);
        $menuTree = $m->pluck("text", "value");
        $menuTree->prepend ( 'Select Menu', '0' );

        $permission_list = Permission::all();
        $obj->permissions = $obj->permissions()->pluck("id")->toArray();

        return view ( 'menu::edit', compact('obj', 'menuTree','listIcon', 'permission_list') );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(MenuEditRequest $request, $id)
    {
        $this->removeSession();

        $obj = Menu::find($id);
        $obj->name = $request->name;
        $obj->parent_id = (int)$request->parent_id;
        $obj->url = $request->url;
        $obj->icons = $request->icons;
        $obj->menu_title = (int)$request->menu_title ?? 0;
        $obj->status=(int)$request->status;
        $obj->target = isset($request->target)?"_blank":"_self";
        $obj->save();

        $permissions = null;
        if (is_array($request->permissions)) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();

        }
        $obj->syncPermissions($permissions);
        LoggingHelper::infor("","Edit menu ",$obj->name);

        return redirect ( route($this->index_page))->with ( 'flash-message', "Change Data Success!" );
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $this->removeSession();
        if (! is_numeric ( $id )) {
            return response()->json(["status"=>1,"message"=>"Data Not Exist!"]);
        }
        $obj= Menu::find($id);
        $obj->delete ();

        LoggingHelper::infor("","Delete menu ",$obj->name);

        return response()->json(["status"=>0,"message"=>"Delete Menu Success!"]);
    }


    public function destroyMany(Request $request) {
        $ids = $request->id;
        $this->removeSession();
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
            Menu::whereIn('id', $ids)->delete();
            LoggingHelper::infor("","Delete Multiple Menu ","");

            return redirect ( route($this->index_page))->with ( "flash-message", "Delete Successful!" );
        }
        return redirect ( route($this->index_page))->with ( "error", "Data Invalid, Please try again!" );

    }

    public function updateStatus(Request $request) {
        $this->removeSession();
        $id = (int)$request->id;
        if ($id<1) return abort(400, "No Data Valid!");
        $status = (int)$request->status;
        $status = ($status==0)?0:1;

        $obj = Menu::find($id);
        if (!$obj) return abort(400, "No Data Valid!");

        $obj->status = $status;
        $obj->save();
        LoggingHelper::infor("","Change Menu: ",$obj->name);

       return response()->json(["status" => 0, "message" => "Change data success!"]);

    }
    public function updateOrder(Request $request) {
        $ids = $request->ids;
        $parent = $request->parent;
        $dataUpdate = Menu::updateOrderAndStatus($ids , $parent);
        $this->removeSession();
        return response()->json($dataUpdate);

    }
//    public function updateOrder(Request $request) {
//        $this->removeSession();
//        $id = (int)$request->id;
//        $action = $request->order;
//
//        if ($id<1) return abort(500, "Data is not exist or restrict permission.");
//        $obj = Menu::find($id);
//        if (!$obj) return abort(500, "Data is not exist or restrict permission.");
//
//        $siblings = Menu::where("parent_id", $obj->parent_id)->orderBy(DB::raw('ABS(`order`)'))->get();
//        $bfItem = array();
//        $afItem = array();
//        $lastItem = null;
//        $bfOk = false;
//        $afOk = false;
//        $order = 1;
//        foreach ($siblings as $item) {
////            if ($item->id == $obj->id) {
////                $obj->order = $order;
////                continue;
////            }
//            if ($item->order != $order) {
//                $item->order = $order;
//                $item->save();
//            }
//
//            $order++;
//            if (!$bfOk) {
//                if ($item->id == $id) {
//                    $bfItem = $lastItem;
//                    $bfOk = true;
//                }
//            }
//
//            if (!$afOk) {
//                if ($lastItem != null && $lastItem->id == $id) {
//                    $afItem = $item;
//                    $afOk = true;
//                }
//            }
//
//            $lastItem = $item;
//        }
//
//        if (strcmp($action, "up") == 0 ) {
//
//            if (!$bfItem) return abort(500, "Invalid Action!");
//            $tg = $bfItem->order;
//            $bfItem->order = $obj->order;
//            $obj->order = $tg;
//            $bfItem->save();
//            $obj->save();
//        }
//
//        if (strcmp($action, "down") == 0) {
//            if (!$afItem) return abort(500, "Invalid Action!");
//            $tg = $afItem->order;
//            $afItem->order = $obj->order;
//            $obj->order = $tg;
//            $afItem->save();
//            $obj->save();
//        }
//        LoggingHelper::infor("","Change Menu Order ","");
//
//        return response()->json(["status" => 0, "message" => "Change data success!"]);
////        $obj->save();
//    }
}
