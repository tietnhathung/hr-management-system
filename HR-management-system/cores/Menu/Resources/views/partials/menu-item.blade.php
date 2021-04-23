<tr role="row" class="odd" id="item-{{ $item->id }}">
    <td class="text-center">
        <input type="checkbox" value="{{ $item->id }}" name="ids[]" class="chk-item" autocomplete="off" />
    </td>
    @if($item->menu_title == 1)
        <td class="sorting_1">
            {!! str_repeat ("&emsp;", $item->level) !!}
            <span class="text-uppercase font-weight-bold">{{ $item->name }}</span>
        </td>
    @else
        <td class="sorting_1">
            {!! str_repeat ("&emsp;", $item->level) !!}
            <i class="{{ (isset($item->icons) && $item->icons!="") ? $item->icons : 'far fa-arrow-alt-circle-right' }}"></i> {{ $item->name }}
        </td>
    @endif
    <td class="hidden-sm hidden-xs">{{ $item->url }}</td>
    <td class="text-center hidden-sm hidden-xs">{{ $item->target }}</td>
    <td class="text-center item">
        <label class="c-switch c-switch-label c-switch-success mb-0">
            {{ Form::checkbox('target', 1, $item->status == 1, ['class' => 'c-switch-input changeStatusmenu', 'autocomplete' => 'off', 'abbr' => $item->id, 'abbr-url' => route("menu.updateStatus")]) }}
            <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
        </label>
    </td>
    <td class="text-center">
        <a href="javascript:void(0)" class="btn btn-success btn-sm orderUp" abbr-url="{{ route('menu.updateOrder') }}" item-id="{{ $item->id }}">
            <i class="fas fa-chevron-up"></i>
        </a>
        <a href="javascript:void(0)" class="btn btn-success btn-sm orderDown" abbr-url="{{ route('menu.updateOrder') }}" item-id="{{ $item->id }}">
            <i class="fas fa-chevron-down"></i>
        </a>
    </td>
    <td class="text-center">
        <a href="{{ Utilities::getUrlWithGoBack(route('menu.edit', $item->id)) }}" class="btn btn-info btn-sm" title="Update">
            <i class="fas fa-pencil-alt"></i>
        </a>
        <a href="#" class="btn btn-danger btn-sm btn-delete-one" title="Delete" data-id="{{ $item->id }}" data-ajax-url="{{ route('menu.destroy') }}">
            <i class="fas fa-trash-alt"></i>
        </a>
    </td>
</tr>

@if (isset($item->children))
    @each('menu::partials.menu-item', $item->children, 'item')
@endif
