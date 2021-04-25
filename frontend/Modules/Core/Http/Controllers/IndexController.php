<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Services\IndexService;

class IndexController extends Controller
{
    private $baseView = 'core::index.';

    public function index()
    {
        \SEO::setTitle('Trang chủ');

        return view($this->baseView . __FUNCTION__ );
    }
}
