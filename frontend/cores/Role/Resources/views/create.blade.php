@extends(env('LAYOUT_MASTER', 'layouts.master'))

@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
    <div class="card">
        <div class="card-header">
            <h1 class="h5 m-0">Tạo nhóm người dùng</h1>
        </div>
        <div class="card-body">
            {!! Form::open(array('route' => 'role.store')) !!}
                @include('role::partials.form', ['submit_text' => 'Thêm mới'])
            {{ Form::close() }}
        </div>
    </div>
@endsection
