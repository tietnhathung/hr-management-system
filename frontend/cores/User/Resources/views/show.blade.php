@extends('layouts.master')
@section('content')
    
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img class="profile-user-img img-responsive img-circle" src="{{ $user->avatar?(env('URL_IMAGE') . $user->avatar): asset('assets/images/noavatar.png') }}" alt="User profile picture">
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body box-profile">

                    <h3 class="profile-username text-center">{{ $user->fullname }}</h3>
                    @if ($user->id == Auth::id())
                    <p class="text-muted text-center"><a href="{{ route("user.changeProfile") }}" class="badge">Edit thông tin</a> <a href="{{ route("user.changePassword") }}" class="badge">Đổi mật khẩu</a></p>
                    @endif
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>User name:</b> <a class="pull-right">{{ $user->username }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Number phone:</b> <a class="pull-right">{{ $user->mobile }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email:</b> <a class="pull-right">{{ $user->email }}</a>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a class="btn btn-default" id="btnBack" name="btnBack" href="{{route('user.index')}}"> <i class="icon-undo bigger-110"></i>Cancel</a>
                </div>
            </div>
        </div>

    </div>

@endsection
