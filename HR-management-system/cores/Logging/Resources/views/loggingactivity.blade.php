@extends('layouts.master')

@section('content')
    @csrf
    @include('shared.message')
    <div class="card">
        <div class="card-header">
            <h1 class="h5 m-0">Logging Activity List</h1>
        </div>
        <div class="card-body">
            {{ Form::open(['method' => 'get', 'class' => 'form-search mb-2']) }}
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>From</label>
                        {{ Form::text('from', Request::get('from'), ['class' => 'form-control date-picker', 'placeholder' => 'Enter from...', 'autocomplete' => 'off']) }}
                    </div>
                    <div class="form-group col-md-2">
                        <label>To</label>
                        {{ Form::text('to', Request::get('to'), ['class' => 'form-control date-picker', 'placeholder' => 'Enter to...', 'autocomplete' => 'off']) }}
                    </div>
                    <div class="form-group col-md-4">
                        <label>User</label>
                        <div class="select2">
                            {{ Form::select('canbo', $data['users'], Request::get('canbo'), ['class' => 'form-control', 'placeholder' => 'All' , 'autocomplete' => 'off']) }}
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Level</label>
                        {{ Form::select('level', ['' => 'All', '1' => 'Info', '2' => 'Error'], Request::get('level'), ['class'=>'form-control']) }}
                    </div>
                    <div class="form-group col-md-2">
                        <label>&nbsp;</label>
                        {{ Form::button('<i class="fas fa-search"></i> Search', ['type' => 'submit', 'class' => 'btn btn-success btn-block']) }}
                    </div>
                </div>
            {{ Form::close() }}
            <div class="table-responsive-sm">
                <table class="table table-striped table-data table-layout-fixed">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th class="text-center" style="width: 80px;">Status</th>
                            <th class="text-center" style="width: 150px;">Time</th>
                            <th class="text-center" style="width: 180px;">User</th>
                            <th class="text-center">Activity</th>
                            <th class="text-center">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($logs)>0)
                        @for ($i = 0; $i < count($logs); $i++)
                            <tr>
                                <td class="text-center">{{ $i + $logs->firstItem() }}</td>
                                <td class="text-center">
                                    @if($logs[$i]->level == 1)
                                        <span class="badge badge-success">Info</span>
                                    @else
                                        <span class="badge badge-danger">Error</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ Utilities::formatDisplayDateTime($logs[$i]->created_at) }}</td>
                                <td class="text-center">{{ $logs[$i]->User->fullname }}</td>
                                <td class="text-center">{{ $logs[$i]->action }}</td>
                                <td class="text-center">{!! nl2br(e($logs[$i]->detail)) !!}</td>
                            </tr>
                        @endfor
                        @else
                        <tr>
                            <td colspan="6" class="text-center">No result found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {!! $logs->appends(Request::all())->links('shared.pagination') !!}
        </div>
    </div>
@endsection