<div class="card-body">
	<div class="form-horizontal">
		<div class="form-group row @if ($errors->has('name')) has-error @endif">
			@php
				$atrrName = ['class' => 'form-control', 'required' => 'required', 'id' => 'name', 'maxlength' => 255];
				if ($errors->has('name')) {
					$atrrName['autofocus'] = 'autofocus';
				}
			@endphp
			<label class="col-md-2 col-form-label">Name <span class="text-danger">*</span></label>
			<div class="col-md-10">
				{{ Form::text('name', old('name', $obj->name), ['class' => 'form-control', 'placeholder' => 'Enter name...', 'maxlength' => 191, 'autocomplete' => 'off']) }}
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label">Url</label>
			<div class="col-md-10">
				{{ Form::text('url', old('url', $obj->url), ['class' => 'form-control', 'placeholder' => 'Enter url...', 'maxlength' => 191, 'autocomplete' => 'off']) }}
			</div>
		</div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Icon</label>
            <div class="col-md-10">
                {{ Form::select('icons', [] , null , ["id" => "icon" , 'placeholder' => "Select icon" ,'class' => 'form-control', 'autocomplete' => 'off']) }}
            </div>
        </div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label">Permission</label>
			<div class="col-md-10">
				{{ Form::select('permissions[]', $permission_list->pluck('title', 'id'), old('permissions', $obj->permissions), ['multiple' => 'multiple',  'class' => 'form-control', 'id' => 'permissions', 'autocomplete' => 'off']) }}
			</div>
		</div>
		<div class="form-group row " id="parent-menu">
			<label class="col-md-2 col-form-label">Parent menu</label>
			<div class="col-md-10">
				{{ Form::select('parent_id', $menuTree, old('parent_id', $obj->parent_id), ['class' => 'form-control', 'autocomplete' => 'off']) }}
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label">Open new tab</label>
			<div class="col-md-10 col-form-label">
				<label class="c-switch c-switch-label c-switch-success mb-0">
					{{ Form::checkbox('target', '_blank', old('target', $obj->target) == '_blank', ['class' => 'c-switch-input', 'autocomplete' => 'off']) }}
					<span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
				</label>
			</div>
		</div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Title menu</label>
            <div class="col-md-10 col-form-label">
                <label class="c-switch c-switch-label c-switch-success mb-0">
                    {{ Form::checkbox('menu_title', 1, old('menu_title', $obj->menu_title) == 1, ['class' => 'c-switch-input', 'autocomplete' => 'off' ]) }}
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
        </div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label">Status</label>
			<div class="col-md-10 col-form-label">
				<label class="c-switch c-switch-label c-switch-success mb-0">
					{{ Form::checkbox('status', 1, old('status', $obj->status) == 1, ['class' => 'c-switch-input', 'autocomplete' => 'off' ]) }}
					<span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
				</label>
			</div>
		</div>
	</div>
</div>
<div class="card-footer">
	<button type="submit" class="btn btn-primary btn-sm">
		<i class="fas fa-save"></i> Save
	</button>
	<a href="{{ Utilities::getGoBackUrl('/menu') }}" class="btn btn-light btn-sm">
		<i class="fas fa-undo"></i> Back
	</a>
</div>

@section('scripts')
    <script>
        let selectedItem = "{{$obj->icons}}";

        let listItem = @json($listIcon);

        let listResultsItem = listItem.map(function (item){
            if (item==selectedItem){
                return {
                    "id": item,
                    "text": item,
                    "selected": true
                };
            }else{
                return {
                    "id": item,
                    "text": item,
                };
            }
        });

        function formatState (state) {
            var $state = $('<i style="width: 30px" class="'+state.text+'"></i>  </span>'+state.text+'</span>');
            return $state;
        };

        $('#icon').select2({
            width: '100%',
            data: listResultsItem,
            templateResult: formatState,
            templateSelection: formatState
        });

        $("#permissions").select2();

        $('form').on('submit',function (){
            let status = $('[name="menu_title"]').is(":checked");
            if (status){
                $('#parent-menu').find("select").val(0);
            }
        })
    </script>
@endsection
