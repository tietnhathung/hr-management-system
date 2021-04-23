<!DOCTYPE html>
<html lang="vi">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    {!! SEOMeta::generate() !!}
    <link href="{{ asset('/assets/themes/coreui/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/themes/coreui/vendors/@@coreui/icons/css/free.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/style.css?v=1.0.0') }}" rel="stylesheet" type="text/css" />
</head>

<body class="c-app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <img src="{{asset('/images/logo-full.png')}}" alt="Logo" class="img-fluid d-inline-block mr-1" />
                                </div>
                            </div>
                            @include('shared.message')
                            {{ Form::open(['route' => ['auth.login', 'lastUrl=' . urlencode(request()->query('lastUrl'))]]) }}
                                <div class="mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <svg class="c-icon">
                                                    <use xlink:href="{{ asset('/assets/themes/coreui/vendors/@@coreui/icons/svg/free.svg#cil-user') }}"></use>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="text" name="username" class="form-control" maxlength="50" placeholder="Tên đăng nhập" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <svg class="c-icon">
                                                    <use xlink:href="{{ asset('/assets/themes/coreui/vendors/@@coreui/icons/svg/free.svg#cil-lock-locked') }}"></use>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="password" name="password" class="form-control" maxlength="50" placeholder="Mật khẩu" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
										{{ Form::button('Đăng nhập', ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) }}
                                    </div>
                                </div>
							{{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/assets/themes/coreui/vendors/@@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/themes/coreui/vendors/@@coreui/icons/js/svgxuse.min.js') }}"></script>
</body>
</html>
