@extends(env('LAYOUT_MASTER', 'layouts.page'))

@section('content')
    <div class="card">
        <div class="card-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{ $user->avatar?(env('URL_IMAGE') . $user->avatar):"/images/noavatar.png" }}" alt="User profile picture">

            <h3 class="profile-username text-center">{{ $user->fullname }}</h3>
            <p class="text-muted text-center"><a href="{{ route("user.changeProfile") }}" class="badge">Edit thông tin</a> <a href="{{ route("user.changePassword") }}" class="badge">Đổi mật khẩu</a></p>


{{--                    <p class="text-muted text-center">{{ $user->position }} - {{ $user->company->Name }}</p>--}}

            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>User name</b> <a class="pull-right">{{ $user->username }}</a>
                </li>
                <li class="list-group-item">
                    <b>Số điện thoại</b> <a class="pull-right">{{ $user->mobile }}</a>
                </li>
{{--                        <li class="list-group-item">--}}
{{--                            <b>Lịch đã thực hiện</b> <a class="pull-right">{{ $schedCountData->cFinished }}</a>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item">--}}
{{--                            <b>Lịch quá hạn</b> <a class="pull-right">{{ $schedCountData->cExpired }}</a>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item">--}}
{{--                            <b>Lịch đang thực hiện</b> <a class="pull-right">{{ $schedCountData->cPlan }}</a>--}}
{{--                        </li>--}}
            </ul>
        </div>
    </div>


        @can("watch_data")
{{--        <div class="col-md-9">--}}
{{--            <div class="nav-tabs-custom">--}}
{{--                <ul class="nav nav-tabs">--}}
{{--                    <li class="active"><a href="#activity" data-toggle="tab">Lịch dự kiến</a></li>--}}
{{--                    <li><a href="#timeline" data-toggle="tab">Đã thực hiện</a></li>--}}
{{--                    <li><a href="#settings" data-toggle="tab">Quá hạn</a></li>--}}
{{--                </ul>--}}
{{--                <div class="tab-content">--}}
{{--                    <div class="active tab-pane" id="activity">--}}

{{--                            <div class="row">--}}
{{--                                <div class="col-sm-12">--}}
{{--                                    <table class="table table-bordered table-striped">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th class="text-center" style="width:20px;">STT</th>--}}
{{--                                            <th class="text-center">Tên lịch</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @php $count=1; @endphp--}}
{{--                                        @foreach ($sched["Plan"] as $item)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$count++}}</td>--}}
{{--                                            <td><a href="{{ route("watch.showSchedule", $item->Id) }}">{{ $item->Name }}</a></td>--}}
{{--                                        </tr>--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                    </div>--}}
{{--                    <!-- /.tab-pane -->--}}
{{--                    <div class="tab-pane" id="timeline">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <table class="table table-bordered table-striped">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th class="text-center" style="width:20px;">STT</th>--}}
{{--                                        <th class="text-center">Tên lịch</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @php $count=1; @endphp--}}
{{--                                    @foreach ($sched["Finished"] as $item)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$count++}}</td>--}}
{{--                                            <td><a href="{{ route("watch.showSchedule", $item->Id) }}">{{ $item->Name }}</a></td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /.tab-pane -->--}}

{{--                    <div class="tab-pane" id="settings">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <table class="table table-bordered table-striped">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th class="text-center" style="width:20px;">STT</th>--}}
{{--                                        <th class="text-center">Tên lịch</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @php $count=1; @endphp--}}
{{--                                    @foreach ($sched["Expired"] as $item)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$count++}}</td>--}}
{{--                                            <td><a href="{{ route("watch.showSchedule", $item->Id) }}">{{ $item->Name }}</a></td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /.tab-pane -->--}}
{{--                </div>--}}
{{--                <!-- /.tab-content -->--}}
{{--            </div>--}}
{{--            <!-- /.nav-tabs-custom -->--}}
{{--        </div>--}}

            {{--<div class="col-md-9">--}}
                {{--<div class="box box-danger">--}}
                {{--<div class="box-header with-border">--}}
                    {{--<h1 class="h5 m-0">Tiêu chí đánh giá vi phạm gần nhất</h1>--}}
                {{--</div>--}}
                {{--<div class="card-body">--}}
                    {{--<table class="table table-bordered table-striped">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th class="text-center" style="width:20px;">STT</th>--}}
                            {{--<th class="text-center">Tiêu chí</th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--@php $count=1; @endphp--}}
                        {{--@foreach ($issues as $item)--}}
                            {{--<tr>--}}
                                {{--<td>{{$count++}}</td>--}}
                                {{--<td>{{ $item->criteria->Title }}</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--</tbody>--}}
                    {{--</table>--}}
                {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        @endcan<!-- /.col -->

    </div>
    <!-- /.row -->

</section>
@endsection
