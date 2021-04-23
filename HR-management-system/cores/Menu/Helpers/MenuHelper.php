<?php

namespace Core\Menu\Helpers;

use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: Hung Nguyen
 * Date: 06/05/2019
 * Time: 15:33
 */
class MenuHelper {
    public static function buildTreeMenu($menus, $parent_id = 0, $level = 0) {
        $branch = array();
        $order = 1;
        foreach ($menus as $element) {
            if ($element->parent_id == $parent_id) {
                $children = MenuHelper::buildTreeMenu($menus, $element->id, $level + 1);
                $element['level'] = $level;
                $element['order'] = $order++;
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    public static function buildTreeMenu_left($menus, $permissionArr, $parent_id = 0, $level = 0) {
        $branch = array();

        foreach ($menus as $element) {
            $menuItem = [];
            if ($element->parent_id == $parent_id) {
                $hasPerm = false;
                // check authenticate
                $perms = $permissionArr->get($element->id);
                if ($perms == "" || $perms == null) $hasPerm = true;
                else {
                    $permArr = explode(",", $perms);
                    foreach ($permArr as $perm) {
                        if (Auth::user()->can($perm)) {
                            $hasPerm = true;
                            break;
                        }
                    }
                }

                if ($hasPerm) {
                    $children = MenuHelper::buildTreeMenu_left($menus, $permissionArr, $element->id, $level + 1);

                    $menuItem['level'] = $level;
                    $menuItem['text'] = $element->name;
                    $menuItem['url'] = $element->url;
                    $menuItem['target'] = $element->target;
                    $menuItem['class'] = '';
                    $menuItem['href'] = $element->url;
                    if($element->icons != "") {
                        $menuItem['icon'] = $element->icons;
                    }

                    if ($children) {
                        $menuItem['submenu'] = $children;
                    }
                    if ($children || ($menuItem['url'] && $menuItem['url']!="#")) {
                        $branch[] = $menuItem;
                    }

                }

            }

        }
        return $branch;
    }

    public static function buildTreeMenu_select($menus, &$menuSelect, $parent_id = 0, $level = 0) {

//        dd($menus);
        foreach ($menus as $element) {
            $menuItem = [];
            if ($element->parent_id == $parent_id) {

                $menuItem['value'] = $element->id;
                $menuItem['text'] = str_repeat("--", $level) . ($level>0?" ":"") . $element->name;
                if($element->icons != "") {
                    $menuItem['icon'] = $element->icons;
                }

                $menuSelect[] = $menuItem;
//                print_r($menuSelect);
                MenuHelper::buildTreeMenu_select($menus, $menuSelect, $element->id, $level + 1);
            }

        }
//        return $menuSelect;
    }
}
