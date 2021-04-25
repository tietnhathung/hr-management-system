@extends('layouts.master')

@section('content')
    @include('shared.message')

    {{ Form::open(['route' => 'personal.update', 'class' => 'form-horizontal']) }}
        <div class="card">
            <div class="card-header">
                <h1 class="h5 m-0">{{ $title }}</h1>
            </div>
            <div class="card-body">
                <dl class="form-group row">
                    <label class="col-md-2 col-form-label">Tên đăng nhập</label>
                    <div class="col-md-10 col-form-label">{{ $obj->username }}</div>
                </dl>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Họ tên <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        {{ Form::text('fullname', old('fullname', $obj->fullname), ['class' => 'form-control', 'placeholder' => 'Nhập họ têm...', 'maxlength' => 50, 'autocomplete' => 'off']) }}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Email</label>
                    <div class="col-md-10">
                        {{ Form::text('email', old('email', $obj->email), ['class' => 'form-control', 'placeholder' => 'Nhập email...', 'maxlength' => 50, 'autocomplete' => 'off']) }}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {{ Form::button('<i class="fas fa-save"></i> Lưu lại', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm']) }}
            </div>
        </div>
    {{ Form::close() }}
@endsection