@extends('layouts.master')
@php
    $users = $data["users"];
    $listDay = $data["listDay"];
    $timeskeeping = $data["timekeeping"];
    $listMonth = [
        "01" => "Tháng 1",
        "02" => "Tháng 2",
        "03" => "Tháng 3",
        "04" => "Tháng 4",
        "05" => "Tháng 5",
        "06" => "Tháng 6",
        "07" => "Tháng 7",
        "08" => "Tháng 8",
        "09" => "Tháng 9",
        "10" => "Tháng 10",
        "11" => "Tháng 11",
        "12" => "Tháng 12",
    ]
@endphp
@section('content')
    @include("shared.message")
    <div class="card">
        <div class="card-header">
            <form id="form" class="mt-repeater form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-2 select2">
                        {{ Form::select('month', $listMonth , Request::get('month') ?? date('m') , ['class' => 'form-control', 'autocomplete' => 'off']) }}
                    </div>
                    <div class="col-md-2">
                        {{ Form::text("year", null, ['class' => 'form-control', 'id'=>'year', 'placeholder' => "Năm báo cáo", 'autocomplete' => 'off']) }}
                    </div>
                    <div class="col-md-1">
                        <button id="btn-search" type="button" class="btn btn-success btn-block"><i class="fas fa-search"></i> Tìm kiếm</button>
                    </div>
                    <div class="col-md-1">
                        <button id="btn-download" type="button" class="btn btn-primary btn-block"><i class="fas fa-download"></i> Tải xuống</button>
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

@section('styles')
    <link href="{{asset("assets/plugins/YearPicker/dist/yearpicker.css")}}" rel="stylesheet" />
    <style>
        .table-sticky {
            position: relative;
        }
        .td-th-stick{
            position: sticky;
            left: -1px;
            background: #fff;
        }
    </style>
@endsection
@section('scripts')
    <script src="{{asset("assets/plugins/YearPicker/dist/yearpicker.js")}}"></script>
    <script>
        $("#year").yearpicker({
            year: {{request()->year ?? date("Y")}}
        });
        const url = {
            search: "{{route("timekeeping.index")}}",
            download: "{{route("timekeeping.download")}}"
        };
        $("#btn-search").on("click",function () {
            $("#form").attr('action', url.search);
            $("#form").submit();
        })
        $("#btn-download").on("click",function () {
            $("#form").attr('action', url.download);
            $("#form").submit();
        })
    </script>
@endsection
