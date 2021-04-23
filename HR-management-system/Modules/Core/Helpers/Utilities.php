<?php

namespace Modules\Core\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\URL;
use Modules\Core\Services\AdUserService;

class Utilities
{
    public static function getUrlWithGoBack($targetUrl, $currentUrl = '')
    {
        if (!$currentUrl) {
            $currentUrl = \Request::getRequestUri();
        }
        return self::setQueryStringToUrl($targetUrl, ['lastUrl' => $currentUrl]);
    }

    public static function getGoBackUrl($defaultUrl)
    {
        $goBackUrl = \Request::get('lastUrl');
        return !strlen(trim($goBackUrl)) == 0 ? $goBackUrl : $defaultUrl;
    }

    public static function setQueryStringToUrl($url, array $queryString = [])
    {
        $currentQuery = [];

        $parseUrl = parse_url($url);

        $url = $parseUrl['path'];
        if (isset($parseUrl['query'])) {
            $query = $parseUrl['query'];
            $query = explode('&', $query);

            for ($i = 0; $i < count($query); $i++) {
                $obj = explode('=', $query[$i]);
                if (isset($obj[0]) && $obj[0]) {
                    $currentQuery[$obj[0]] = isset($obj[1]) ? $obj[1] : '';
                }
            }

            $queryString = array_merge(
                $currentQuery,
                $queryString
            );
        }

        return $url . '?' . http_build_query($queryString);
    }

    public static function getUploadFileName($filename)
    {
        return date('dmYhis') . '-' . $filename;
    }

    public static function getUploadMaxFileSize($unit = '', $showUnit = false)
    {
        $fileUploadMaxSize = config('core.fileUploadMaxSize') * 1024;

        $postMaxSize = self::parseSize(ini_get('post_max_size'));
        if ($postMaxSize > 0 && $fileUploadMaxSize > $postMaxSize) {
            $fileUploadMaxSize = $postMaxSize;
        }

        $uploadMaxSize = self::parseSize(ini_get('upload_max_filesize'));
        if ($uploadMaxSize > 0 && $fileUploadMaxSize > $uploadMaxSize) {
            $fileUploadMaxSize = $uploadMaxSize;
        }

        switch ($unit) {
             case 'KB':
                $fileUploadMaxSize = round($fileUploadMaxSize / 1024, 2);
                if ($showUnit) {
                    $fileUploadMaxSize .= ' ' . $unit;
                }
                 break;
             case 'MB':
                $fileUploadMaxSize = round($fileUploadMaxSize / (1024 * 1024), 2);
                if ($showUnit) {
                    $fileUploadMaxSize .= ' ' . $unit;
                }
                 break;
             case 'GB':
                $fileUploadMaxSize = round($fileUploadMaxSize / (1024 * 1024 * 1024), 2);
                if ($showUnit) {
                    $fileUploadMaxSize .= ' ' . $unit;
                }
                 break;
             default:
                if ($showUnit) {
                    $fileUploadMaxSize .= ' B';
                }
                 break;
        }

        return $fileUploadMaxSize;
    }

    public static function parseSize($size)
    {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size);
        $size = preg_replace('/[^0-9\.]/', '', $size);
        if ($unit) {
            return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
        } else {
            return round($size);
        }
    }

    public static function getImageUrl($url)
    {
        if (\Str::of($url)->startsWith('http://') || \Str::of($url)->startsWith('https://')) {
            return $url;
        } elseif (!\Str::of($url)->startsWith('/')) {
            $url = '/' . $url;
        }

        return URL::to('/') . $url;
    }

    public static function saveImageBase64($img)
    {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $fileUrl = config('core.uploadPath') . '/' . date('dmYhis') . '.png';
        file_put_contents($fileUrl, $data);

        return '/' . $fileUrl;
    }

    public static function parseDateOnly($value)
    {
        return \Carbon\Carbon::createFromFormat(config('core.displayDateFormat'), $value)->format('Y-m-d');
    }

    public static function formatDisplayDateOnly($value, $format = '')
    {
        if (!$value) {
            return '';
        }

        if (!$format) {
            $format = config('core.displayDateFormat');
        }

        return date($format, strtotime($value));
    }

    public static function formatDisplayDateTime($value, $format = '')
    {
        if (!$value) {
            return '';
        }

        if (!$format) {
            $format = config('core.displayDateTimeFormat');
        }

        return date($format, strtotime($value));
    }

    public static function getErrorMessageByStatusCode($statusCode)
    {
        switch ($statusCode) {
            case 404:
                return 'Không tìm thấy đường dẫn này';
            default:
                return 'Có lỗi xảy ra';
        }
    }

    public static function getUserById($id)
    {
        return User::find($id);
    }

    public static function formatDisplayLogType($type)
    {
        switch ($type) {
            case config('core.logType')['info']:
                return '<span class="badge badge-success">Thông tin</span>';
            case config('core.logType')['error']:
                return '<span class="badge badge-danger">Lỗi</span>';
            case config('core.logType')['system']:
                return '<span class="badge badge-warning">Hệ thống</span>';
            default:
                return '';
        }
    }

    public static function getUserStatus()
    {
        $status = config('core.userStatus');
        return [
            $status['actived'] => 'Đã kích hoạt',
            $status['unactive'] => 'Chưa kích hoạt',
            $status['locked'] => 'Đã khóa'
        ];
    }

    public static function formatDisplayUserStatus($status)
    {
        switch ($status) {
            case config('core.userStatus')['unactive']:
                return '<span class="badge badge-dark">Chưa kích hoạt</span>';
            case config('core.userStatus')['actived']:
                return '<span class="badge badge-success">Đã kích hoạt</span>';
            case config('core.userStatus')['locked']:
                return '<span class="badge badge-danger">Đã khóa</span>';
            default:
                return '';
        }
    }
}
