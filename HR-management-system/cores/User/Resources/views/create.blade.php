@extends('layouts.master')
@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
    <div class="card">
        <div class="card-header">
            <h1 class="h5 m-0">Tạo người dùng</h1>
        </div>
            {!! Form::open(array('route' => 'user.store', "autocomplete"=>"off")) !!}
                @include('user::partials.form', ['submit_text' => 'Thêm mới'])
            {{ Form::close() }}
    </div>
@endsection
