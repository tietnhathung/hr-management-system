@extends(env('LAYOUT_MASTER', 'layouts.page'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="h5 m-0">Cập nhật thông tin cá nhân</h1>
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            <!-- form start -->
            <div class="card-body">
                {{ Form::model( $obj, ['route' => ['user.updateProfile'], 'method' => 'put', 'id' => 'formChangeProfile'] ) }}
                <div class="col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0">
                    <div class="form-group">
                        <label class="label-control">Full name</label> {!! Form::text('fullname', $obj->fullname,
['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label class="label-control">Số điện thoại</label> {!! Form::text('mobile', $obj->mobile,
['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label class="label-control">Địa chỉ</label> {!! Form::text('address', $obj->address,
['class'=>'form-control']) !!}
                    </div>
                </div>
                <input type="hidden" name="user_avatar" id="user_avatar" value="{{ $obj->avatar }}" />

                {{ Form::close() }}
                <div class="col-md-6 col-sm-6">
                    @include('ajaxupload::partials.form-upload-avatar', ['image' => ($obj->avatar?$obj->avatar:""), 'element_id' => 'user_avatar'])
                </div>
            </div>

            <div class="card-footer">
                <div class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0">
                    <div class="form-group"><a class="btn btn-primary"  onclick="$('#formChangeProfile').submit();">Hoàn thành</a></div></div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

