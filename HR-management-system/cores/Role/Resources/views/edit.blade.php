@extends(env('LAYOUT_MASTER', 'layouts.master'))

@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
    <div class="card">
        <div class="card-header">
            <h1 class="h5 m-0">Update user groups</h1>
        </div>
        <div class="card-body">
            {{ Form::model( $obj, ['route' => ['role.update', $obj->id], 'method' => 'put', 'role' => 'form'] ) }}
                @include('role::partials.form', ['submit_text' => 'Save'])
            {{ Form::close() }}
        </div>
    </div>
@endsection
