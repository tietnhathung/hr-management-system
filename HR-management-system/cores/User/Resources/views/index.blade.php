@extends('layouts.master')
@section('content')
    @csrf
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    @if (Session::get('flash-message'))
        <div class="alert alert-success">{{Session::get('flash-message')}}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h1 class="h5 m-0">Quản lý người dùng</h1>
        </div>
        <div class="card-body">

            <form class="mt-repeater form-horizontal">
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
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            </form>

            <div class="mb-3">
                <button type="button" class="btn btn-danger btn-sm btn-delete-multi"
                        data-ajax-url="{{ route('user.destroyMany') }}" id="deleteAll">
                    <i class="fas fa-trash-alt"></i> Xóa
                </button>
                <a href="{{ route('user.create')}}" class="btn btn-primary btn-sm">
                    <i class="fas fa-file-alt"></i>
                    Thêm
                </a>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="data" class="table table-bordered table-hover table-data" role="grid"
                           aria-describedby="data_info">
                        <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" name="checkAll" id="checkAll" value=""/></th>
                            <th class="text-center">Tên đăng nhập</th>
                            <th class="hidden-sm hidden-xs">Tên đầy đủ</th>
                            <th class="hidden-sm hidden-xs">Trạng thái</th>
                            <th class="text-center"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @if ( isset($users) && !empty($users) && count($users) > 0 )
                            @foreach ($users as $item)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="chk-item" value="{{ $item->id }}" name="ids[]"/>
                                    </td>
                                    <td>
                                        <a href="{{route("user.show", $item->id)}}">{{ $item->username }}</a>
                                    </td>
                                    <td class=" hidden-sm hidden-xs"><a
                                            href="{{route("user.show", $item->id)}}">{{ $item->fullname }}</a>
                                    </td>
                                    <td class=" text-center hidden-sm hidden-xs">
                                        @if($item->id != Auth::id())
                                            <label class="c-switch c-switch-label c-switch-success mb-0">
                                                {{ Form::checkbox('status', 1 , $item->status, ['class' => ['c-switch-input','changeStatus'], 'abbr'=>  $item->id, 'abbr-url' => route("user.updateStatus") ,'autocomplete' => 'off', 'data-id' => $item->id]) }}
                                                <span class="c-switch-slider" data-checked="On"
                                                      data-unchecked="Off"></span>
                                            </label>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if($item->id != Auth::id())
                                            <div class="action-buttons">
                                                <a href="{{route("user.edit", $item->id)}}"
                                                   class="btn btn-sm btn-info ">
                                                    <i title="Edit" id="item-12"  class="fas fa-pencil-alt bigger-120"></i>
                                                </a>
                                                <a class="btn btn-danger text-white btn-delete-one btn-sm"  data-ajax-url="{{ route("user.destroy", $item->id) }}">
                                                    <i title="Delete" id="item-12" class="fa fa-trash bigger-120"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    Không có dữ liệu
                                </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                    <div class="text-right">
                        {{ $users->appends(request()->query())->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        $("#checkAll").click(function () {
            $('tbody input:checkbox').not(this).not('.c-switch-input').prop('checked', this.checked);
        });

    </script>
@endsection
