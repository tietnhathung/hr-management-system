<div class="card-body">
    <div class="row">
        <div class="col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0">
            <div class="form-group @if ($errors->has('username')) has-error @endif">
                @php
                    $atrrName = ['class' => 'form-control', "required"=>"required",'id'=> 'username', 'autocomplete' => 'off', 'maxlength' => 255 ];
                    if ($errors->has('username')) {
                        $atrrName["autofocus"] = 'autofocus';
                    }
                @endphp
                <label class="label-control">Tên đăng nhập<span class="text-danger">*</span></label>
                {!! Form::text('username', $obj->username,
                   ['class'=>'form-control','required' => 'required', 'autocomplete' => 'OFF']) !!}
            </div>
            <div class="form-group @if ($errors->has('password')) has-error @endif">
                @php
                    $atrrName = ['class' => 'form-control', "required"=>"required",'id'=> 'password', 'maxlength' => 255 ];
                    if ($errors->has('password')) {
                        $atrrName["autofocus"] = 'autofocus';
                    }
                @endphp
                <label class="label-control">Mật khẩu<span class="text-danger">*</span></label>
                {!! Form::password('password',
                    ['class'=>'form-control','required' => 'required', 'autocomplete' => 'OFF']) !!}
            </div>

            <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                @php
                    $atrrName = ['class' => 'form-control', "required"=>"required",'id'=> 'password_confirmation', 'maxlength' => 255 ];
                    if ($errors->has('password_confirmation')) {
                        $atrrName["autofocus"] = 'autofocus';
                    }
                @endphp
                <label class="label-control">Xác nhận mật khẩu<span class="text-danger">*</span></label> {!! Form::password('password_confirmation',
			['class'=>'form-control', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
                <label class="label-control">Họ và tên</label> {!! Form::text('fullname', $obj->fullname,
			['class'=>'form-control']) !!}
            </div>
            <div class="form-group @if ($errors->has('email')) has-error @endif">
                @php
                    $attrEmail = ['class' => 'form-control', 'id'=> 'email', 'maxlength' => 255 ];
                     if ($errors->has('email')) {
                        $attrEmail['autofocus'] = 'autofocus';
                    }
                @endphp
                <label class="label-control">Email<span class="text-danger">*</span></label> {!! Form::text('email', $obj->email,
			['class'=>'form-control', 'required' => 'required']) !!}
            </div>
            <div class="form-group @if ($errors->has('mobile')) has-error @endif">
                @php
                    $attrMobile = ['class' => 'form-control', 'id'=> 'mobile','maxlength' => 10 ];
                     if ($errors->has('mobile')) {
                        $attrMobile['autofocus'] = 'autofocus';
                    }
                @endphp
                <label class="label-control">Số điện thoại</label>
                {!! Form::number('mobile', $obj->mobile,
                   ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0">

            <div class="form-group">
                <label class="label-control">Vị trí, chức vụ</label>
                {!! Form::text('position', $obj->position,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label class="label-control">Nhóm người dung</label>
                {!!  Form::select('user_roles',$role_list->pluck('name', 'id'), $obj->user_roles,array('multiple'=>'multiple','name'=>'user_roles[]', 'class'=>'form-control ', 'id' => 'user_roles')) !!}
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label class="label-control">Trạng thái</label>
                    <label class="c-switch c-switch-label c-switch-success mb-0" style="padding-top: 8px;">
                        {{ Form::checkbox('status', 1 ,  $obj->status, ['class' => ['c-switch-input','changeStatus'] ,"id" => "status",'autocomplete' => 'off']) }}
                        <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="row">
        <div class="col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-save"></i>
                    {{$submit_text}}
                </button>
                <a class="btn btn-default btn-sm" id="btnBack" name="btnBack" href="{{route('user.index')}}">
                    <i class="fas fa-undo"></i>Quay lại
                </a>

            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        $('#user_roles').bootstrapDualListbox({
            showFilterInputs: false,
            infoText: false
        });

    </script>
@endsection
