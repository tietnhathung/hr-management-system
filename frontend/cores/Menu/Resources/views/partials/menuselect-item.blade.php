<option value="{{ $item->id }}">{{ str_repeat('--', $item->level) }} {{ $item->name }}</option>
@if (isset($item->children))
    @each('menu::partials.menuselect-item', $item->children, 'item')
@endif