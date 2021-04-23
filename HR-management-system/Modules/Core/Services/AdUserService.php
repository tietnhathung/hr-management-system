<?php
namespace Modules\Core\Services;

use Modules\Core\Entities\AdUser;

class AdUserService
{
    public static function find($id)
    {
        return AdUser::where('id', $id)->first();
    }

    public static function create($data)
    {
        $obj = new AdUser();
        $obj->username = array_key_exists('username', $data) ? $data['username'] : null;
        $obj->password = array_key_exists('password', $data) ? $data['password'] : null;
        $obj->fullname = array_key_exists('fullname', $data) ? $data['fullname'] : null;
        $obj->email = array_key_exists('email', $data) ? $data['email'] : null;
        $obj->avatar = array_key_exists('avatar', $data) ? $data['avatar'] : null;
        $obj->default_stock_id = array_key_exists('default_stock_id', $data) ? $data['default_stock_id'] : null;
        $obj->status = array_key_exists('status', $data) ? $data['status'] : null;
        $obj->save();
    }

    public static function update($data)
    {
        $obj = AdUser::find($data['id']);
        if ($obj) {
            $obj->username = array_key_exists('username', $data) ? $data['username'] : $obj->username;
            $obj->password = array_key_exists('password', $data) ? $data['password'] : $obj->password;
            $obj->fullname = array_key_exists('fullname', $data) ? $data['fullname'] : $obj->fullname;
            $obj->email = array_key_exists('email', $data) ? $data['email'] : $obj->email;
            $obj->avatar = array_key_exists('avatar', $data) ? $data['avatar'] : $obj->avatar;
            $obj->default_stock_id = array_key_exists('default_stock_id', $data) ? $data['default_stock_id'] : $obj->default_stock_id;
            $obj->status = array_key_exists('status', $data) ? $data['status'] : $obj->status;
            $obj->save();
        }
    }

    public static function delete($id)
    {
        if (is_array($id)) {
            AdUser::destroy($id);
        } else {
            $obj = self::find($id);
            if ($obj) {
                $obj->delete();
            }
        }
    }

    public static function getAll()
    {
        return AdUser::all();
    }

    public static function updatePassword($data)
    {
        $obj = self::find($data['id']);
        if ($obj) {
            $obj->password = array_key_exists('password', $data) ? $data['password'] : $obj->password;
            $obj->save();
        }
    }

    public static function updatePersonalInfo($data)
    {
        $obj = self::find($data['id']);
        if ($obj) {
            $obj->fullname = array_key_exists('fullname', $data) ? $data['fullname'] : $obj->fullname;
            $obj->email = array_key_exists('email', $data) ? $data['email'] : $obj->email;
            $obj->avatar = array_key_exists('avatar', $data) ? $data['avatar'] : $obj->avatar;
            $obj->default_stock_id = array_key_exists('default_stock_id', $data) ? $data['default_stock_id'] : $obj->default_stock_id;
            $obj->save();
        }
    }

    public static function getPaging($param)
    {
        $list = new AdUser();
        if (array_key_exists('keyword', $param)) {
            $list = $list->where('username', 'like', '%' . $param['keyword'] . '%');
        }
        $list = $list->orderBy('id', 'desc');

        return $list->paginate(config('core.paginationLimit'));
    }

    public static function getByUsername($username)
    {
        return AdUser::where('username', $username)->first();
    }
}
