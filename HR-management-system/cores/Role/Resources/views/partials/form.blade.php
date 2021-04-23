<div class="card-body">
    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
        <div class="form-group @if ($errors->has('name')) has-error @endif">
            @php
                $atrrName = ['class' => 'form-control', "required"=>"required", 'id'=> 'name', 'maxlength' => 255 ];
                if ($errors->has('name')) {
                    $atrrName["autofocus"] = 'autofocus';
                }
            @endphp
            <label for="ConvertToTOE" class="label-control ">Tên nhóm người dùng:<span class="text-danger">*</span></label>

           {!! Form::text('name', $obj->name,
			['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <label class="label-control">Chọn quyền cho nhóm người dùng</label>
            {!!  Form::select('role_permissions',$permission_list, $obj->role_permissions,array('multiple'=>'multiple','name'=>'role_permissions[]', 'class'=>'form-control', 'id' => 'role_permissions')) !!}
        </div>

    </div>
</div>

<div class="card-footer">
    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-save"></i>
                {{$submit_text}}
            </button>
            <a class="btn btn-default btn-sm" id="btnBack" name="btnBack" href="{{route('role.index')}}">
                <i class="fas fa-undo"></i> Quay lại
            </a>
        </div>

    </div>
</div>
@section('scripts')
    <script>
        $('#role_permissions').bootstrapDualListbox({
            showFilterInputs: false,
            infoText: false
        });
    </script>
@endsection
