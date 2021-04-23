@php
$permission = $menuItem->getAllPermissions()->first();
$check = false;
if (!$permission) {
    $check = true;
} else {
    if (Auth::user()->hasPermissionTo($permission->name)) {
        $check = true;
    } else {
        foreach ($user_roles ?? []as $role) {
            if ($role->hasPermissionTo($permission->name)) {
                $check = true;
                break;
            }
        }
    }
}
@endphp

@if ($check == true)
    @if ($menuItem->children->count() == 0)
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" target="{{$menuItem->target}}" href="{{$menuItem->url}}">
                <div class="c-sidebar-nav-icon">
                    <i class="{{$menuItem->icons??"far fa-arrow-alt-circle-right"}}"></i>
                </div>
                {{$menuItem->name}}
            </a>
        </li>
    @else
        <li class="c-sidebar-nav-title">
            {{$menuItem->name}}
        </li>
        @each('layouts.menu-item', $menuItem->children->where('status' ,'=',1) , 'menuItem')
    @endif
@endif

