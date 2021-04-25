<?php
namespace Modules\Core\Services;

use Modules\Core\Entities\AdLogging;

class AdLoggingService
{
    public static function find($id)
    {
        return AdLogging::find($id);
    }

    public static function findJoin($id)
    {
        $obj = AdLogging::select('ad_logging.*', \DB::raw('ad_user.username AS `user_username`, ad_user.fullname AS `user_fullname`'));
        $obj = $obj->leftJoin('ad_user', 'ad_user.id', '=', 'ad_logging.user_id');
        return $obj->where('ad_logging.id', $id)->first();
    }

    public static function create($data)
    {
        $obj = new AdLogging();
        $obj->user_id = array_key_exists('user_id', $data) ? $data['user_id'] : null;
        $obj->action = array_key_exists('action', $data) ? $data['action'] : null;
        $obj->detail = array_key_exists('detail', $data) ? $data['detail'] : null;
        $obj->ip = array_key_exists('ip', $data) ? $data['ip'] : null;
        $obj->user_agent = array_key_exists('user_agent', $data) ? $data['user_agent'] : null;
        $obj->type = array_key_exists('type', $data) ? $data['type'] : null;
        $obj->save();

        return $obj->id;
    }

    public static function update($data)
    {
        $obj = AdLogging::find($data['id']);
        if ($obj) {
            $obj->user_id = array_key_exists('user_id', $data) ? $data['user_id'] : $obj->user_id;
            $obj->action = array_key_exists('action', $data) ? $data['action'] : $obj->action;
            $obj->detail = array_key_exists('detail', $data) ? $data['detail'] : $obj->detail;
            $obj->ip = array_key_exists('ip', $data) ? $data['ip'] : $obj->ip;
            $obj->user_agent = array_key_exists('user_agent', $data) ? $data['user_agent'] : $obj->user_agent;
            $obj->type = array_key_exists('type', $data) ? $data['type'] : $obj->type;
            $obj->save();
        }
    }

    public static function delete($id)
    {
        if (is_array($id)) {
            AdLogging::destroy($id);
        } else {
            $obj = self::find($id);
            if ($obj) {
                $obj->delete();
            }
        }
    }

    public static function getAll()
    {
        return AdLogging::all();
    }

    public static function getPaging($param)
    {
        $list = AdLogging::select('ad_logging.*', \DB::raw('ad_user.username AS `user_username`, ad_user.fullname AS `user_fullname`'));
        if (array_key_exists('keyword', $param)) {
            $list = $list->where(function ($query) use ($param) {
                $query->where('action', 'like', '%' . $param['keyword'] . '%');
                $query->orWhere('detail', 'like', '%' . $param['keyword'] . '%');
            });
        }
        if (array_key_exists('fromDate', $param)) {
            $list = $list->whereDate('created_at', '>=', $param['fromDate']);
        }
        if (array_key_exists('toDate', $param)) {
            $list = $list->whereDate('created_at', '<', $param['toDate']);
        }
        if (array_key_exists('userId', $param)) {
            $list = $list->where('user_id', $param['userId']);
        }
        if (array_key_exists('type', $param)) {
            $list = $list->where('type', $param['type']);
        }
        $list = $list->leftJoin('ad_user', 'ad_user.id', '=', 'ad_logging.user_id');
        $list = $list->orderBy('ad_logging.id', 'desc');

        return $list->paginate(config('core.paginationLimit'));
    }
}
