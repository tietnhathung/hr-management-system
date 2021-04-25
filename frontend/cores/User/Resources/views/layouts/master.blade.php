@extends(env('LAYOUT_MASTER', 'layouts.page'))

@section('content')
    <section class="content-header">
        <h1>
            Thông tin người dùng
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fas fa-tachometer-alt"></i> Trang chủ</a></li>
            <li><a href="{{ route("user.index") }}">Quản lý người dùng</a></li>
            <li class="active">Thông tin người dùng</li>
        </ol>
    </section>

    <section class="content">
        @yield('body-content')
    </section>
@endsection
@section('scripts')

@endsection
