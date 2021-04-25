@extends(env('LAYOUT_MASTER', 'layouts.master'))

@section('content')
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
            <button class="btn btn-danger btn-sm btn-delete-multi" id="deleteAll"
                    data-ajax-url="{{ route('role.destroyMany') }}">
                <i class="fas fa-trash-alt"></i>
                Xóa
            </button>
            <a href="{{ route('role.create')}}" class="btn btn-sm btn-primary">
                <i class="fas fa-file-alt"></i>Thêm
            </a>
            {!! Form::open(array('route' => 'role.destroyMany', 'id' => 'deleteAllForm')) !!}
            {{ Form::hidden('ids', '', array('id' => 'ids')) }}
            {!! Form::close()  !!}

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <table id="data" class="table table-data table-bordered table-hover">
                        <thead>
                        <tr class="d-flex">
                            <th class="text-center col-1" style="width:50px;"><input type="checkbox" name="checkAll"
                                                                                     id="checkAll" value=""/></th>

                            <th class="col-7">Nhóm người dùng</th>
                            <th class="hidden-sm hidden-xs col-2">Thời gian tạo</th>
                            <th class="col-2"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($roles as $item)
                            <tr class="d-flex">
                                <td class="text-center col-1">
                                    <input type="checkbox" class="chk-item" value="{{ $item->id }}" name="ids[]"/>
                                </td>
                                <td class="col-7">{{ $item->name }}</td>
                                <td class="hidden-sm hidden-xs col-2 ">{{ $item->created_at->format(env("datetimeFormat")) }}</td>
                                <td class="text-center col-2">
                                    <div class="action-buttons">
                                        <a class="btn btn-info btn-sm" href="{{route("role.edit", $item->id)}}">
                                            <i title="Edit" id="item-12" class="fas fa-pencil-alt bigger-120"></i>
                                        </a>
                                        <a class="btn btn-danger text-white btn-delete-one btn-sm"  data-ajax-url="{{ route("role.destroy", $item->id) }}">
                                            <i title="Delete" id="item-12" class="fa fa-trash bigger-120"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-right">  {{ $roles->links() }}</div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $("#checkAll").click(function () {
            $('tbody input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
