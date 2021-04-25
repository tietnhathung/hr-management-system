@extends('layouts.master')
@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
    <div class="card">
        <div class="card-header">
            <h1 class="h5 m-0">Update User</h1>
        </div>
        <!-- /.box-header -->
            {{ Form::model( $obj, ['route' => ['user.update', $obj->id], 'method' => 'put', 'role' => 'form'] ) }}
                @include('user::partials.form-edit', ['submit_text' => 'Save'])
            {{ Form::close() }}
    </div>
@endsection

