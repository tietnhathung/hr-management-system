@php
    $userCreate=Utilities::getUserById($obj->created_by);
    $userUpdate=Utilities::getUserById($obj->updated_by)
@endphp

<div class="card">
    <div class="card-body">
        <p class="mb-0">Khởi tạo lúc
            <strong>
                <span class="text-success">{{ Utilities::formatDisplayDateTime($obj->created_at )}}</span></strong> bởi <strong>
                <a href="javascript:void(0)"  class="text-success">{{ $userCreate?$userCreate->fullname:"" }}</a>
            </strong>
        </p>
        @if ($obj->updated_at || $obj->updated_by)
            <p class="mt-2 mb-0">
                Cập nhật lần cuối
                @if ($obj->updated_at)
                    lúc
                    <strong>
                        <span  class="text-success">{{ Utilities::formatDisplayDateTime($obj->updated_at )}}</span>
                    </strong>
                @endif
                @if ($obj->updated_by)
                    bởi <strong><a href="javascript:void(0)"
                                   class="text-success">{{ $userUpdate?$userUpdate->fullname:"" }}</a></strong>
                @endif
            </p>
        @endif
    </div>
</div>
