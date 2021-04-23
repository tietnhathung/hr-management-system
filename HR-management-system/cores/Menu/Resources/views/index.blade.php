@extends('layouts.master')

@section('content')
    @csrf
    @include('shared.message')
    <div class="card">
        <div class="card-header">
            <h1 class="h5 m-0">Menu List</h1>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <button type="button" class="btn btn-danger btn-sm btn-delete-multi" data-ajax-url="{{ route('menu.destroyMany') }}">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
                <a href="{{ Utilities::getUrlWithGoBack(route('menu.create')) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-file-alt"></i> Create
                </a>
            </div>
            <div class="col-md-12">
                <div class="row hear-menu">
                    <div class="col-md-1 text-center">
                        <input type="checkbox" class="chk-all" autocomplete="off">
                    </div>
                    <div class="col-md-2 text-center">
                        Name
                    </div>
                    <div class="col-md-3 text-center">
                        Url
                    </div>
                    <div class="col-md-2 text-center">
                        Target
                    </div>
                    <div class="col-md-2 text-center">
                        Status
                    </div>
                    <div class="col-md-2 text-center">
                        Action
                    </div>
                </div>
                <div id="list-menu" class="row list-group-menu" data-id="0">
                    @foreach($menus as $menu)
                        @include("menu::partials.menu-item-index",["menu" => $menu])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link href="{{mix("/mix/css/menu.css")}}" rel="stylesheet" >
@endsection
@section('scripts')
    <script src="{{mix("/mix/js/menu.js")}}" ></script>
@endsection
