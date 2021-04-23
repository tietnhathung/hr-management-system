@extends('layouts.master')

@section('content')
    @include('shared.message')
    <div class="card">
        <div class="card-header">
            <h1 class="h5 m-0">Edit Menu</h1>
        </div>
        {{ Form::model($obj, ['route' => ['menu.update', $obj->id], 'method' => 'put', 'role' => 'form'] ) }}
            @include('menu::partials.form')
        {{ Form::close() }}
    </div>
@endsection
