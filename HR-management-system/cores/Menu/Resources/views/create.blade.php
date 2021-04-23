@extends('layouts.master')

@section('content')
    @include('shared.message')
    <div class="card">
        <div class="card-header">
            <h1 class="h5 m-0">Create Menu</h1>
        </div>
        {{ Form::open(['route' => ['menu.store', ['lastUrl' => Request::get('lastUrl')]] ]) }}
            @include('menu::partials.form')
        {{ Form::close() }}
    </div>
@endsection