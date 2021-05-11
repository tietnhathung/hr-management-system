@extends('layouts.master')
@php
    $users = $data["users"];
    $listDay = $data["listDay"];
    $timeskeeping = $data["timekeeping"];
@endphp
@section('content')
    @include("shared.message")
    <div class="card">
        <div class="card-header">
            <form class="mt-repeater form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="form-group col-md-10">
                        <label>Từ khóa</label>
                        {{ Form::text("name", request()->name, ['class' => 'form-control', 'id'=>'name', 'placeholder' => "Enter keyword...", 'autocomplete' => 'off']) }}
                    </div>
                    <div class="form-group col-md-2">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-success btn-block"><i class="fas fa-search"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div style="width: 100%; overflow: auto; white-space: nowrap;">
                        @include("timekeeping::partial.table-data")
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
