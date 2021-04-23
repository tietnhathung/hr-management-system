@extends(env('LAYOUT_MASTER', 'layouts.page'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="h5 m-0">Thay đổi mật khẩu đăng nhập</h1>
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            <!-- form start -->
            <div class="card-body">

                {{ Form::model( $obj, ['route' => ['user.updatePassword'], 'method' => 'put', 'id' => 'formChangePassword'] ) }}
                <div class="col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0">
                    <div class="form-group">
                        <label class="label-control">Mật khẩu cũ</label> {!! Form::password('old_password', ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label class="label-control">Mật khẩu mới</label> {!! Form::password('new_password', ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label class="label-control">Nhập lại mật khẩu</label> {!! Form::password('new_password_confirmation', ['class'=>'form-control']) !!}
                    </div>
                </div>

                {{ Form::close() }}
            </div>

            <div class="card-footer">
                <div class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0">
                    <div class="form-group"><a class="btn btn-primary"  onclick="$('#formChangePassword').submit();">Hoàn thành</a></div></div>
            </div>
        </div>
    </div>
@endsection

