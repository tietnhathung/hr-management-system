<?php

namespace Core\Menu\Entities;

use Awobaz\Compoships\Compoships;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Traits\HasPermissions;

class Menu extends Model
{
    use HasPermissions;
    use SoftDeletes;
    use Compoships;
    protected $softDelete = true;

    protected $guard_name = 'web';

    protected $table = 'ad_menu';
    protected $fillable = ['name', 'url', 'parent_id', 'icons', 'status' ,'menu_title'];


    public function children()
    {
        return $this->hasMany(self::class, "parent_id", "id")->with('children');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, "id", "parent_id")->with('parent');
    }

    private static function getAllMenu(){
        $menus = self::select('ad_menu.id','ad_menu.name','ad_menu.url','ad_menu.parent_id','ad_menu.icons','ad_menu.status','ad_menu.menu_title','ad_menu.target','ad_menu.order','ad_menu.route','model_has_roles.model_id')
            ->join('model_has_permissions','ad_menu.id','model_has_permissions.model_id')
            ->join('role_has_permissions','role_has_permissions.permission_id','model_has_permissions.permission_id')
            ->join('roles','role_has_permissions.role_id','roles.id')
            ->join('model_has_roles','roles.id','model_has_roles.role_id')
            ->where('model_has_roles.model_id',Auth::id())
            ->whereNull('ad_menu.deleted_at')
            ->where('ad_menu.status',1)
            ->groupBy('ad_menu.id','ad_menu.name','ad_menu.url','ad_menu.parent_id','ad_menu.icons','ad_menu.status','ad_menu.menu_title','ad_menu.target','ad_menu.order','ad_menu.route','model_has_roles.model_id')
            ->orderBy('order')
            ->get()->toArray();
        return $menus;
    }

    private static function buildMenu(array $rawMenu , int $parentId = 0 ):array{
        $listMenu = array_filter ( $rawMenu , function ($menu)use($parentId){
           return  $menu["parent_id"] == $parentId;
        });
        foreach ($listMenu as &$menu){
            $menu["childrens"] = self::buildMenu($rawMenu, $menu["id"]);
        }
        return $listMenu;
    }

    public static function getAllMenuBuildTree(){
        $rawMenu = self::orderBy('order')->get()->toArray();
        $listMenu = self::buildMenu($rawMenu);
        return $listMenu;
    }

    public static function getAllMenuBuilded(){
        $rawMenu = self::getAllMenu();
        $listMenu = self::buildMenu($rawMenu);
        return $listMenu;
    }

    public static function updateOrderAndStatus(array $ids, int $parent){
        try {
            foreach ($ids as $key => $id){
                self::where("id",$id)->update(['parent_id'=>$parent ,'order' => $key]);
            }

            return ["status" => 1, "message" => "Update successful!"];
        }catch (Exception $e){
            log::error($e->getMessage());
            return ["status" => 0, "message" => $e->getMessage()];
        }
    }
}
