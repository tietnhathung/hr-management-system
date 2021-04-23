@php
    $hasChildren = count($menu["childrens"]) > 0;
@endphp
@if (isset($menu["menu_title"])&& empty($menu["parent_id"]) && $menu["menu_title"] == 1)
    <li class="c-sidebar-nav-title">
        {{$menu["name"]}}
    </li>
    @if($hasChildren)
{{--        @include('layouts.master-itemmenu',["menu"=>$childrens])--}}
{{--    <li class="c-sidebar-nav-title c-sidebar-nav-dropdown c-show">--}}
{{--        {{$menu["name"]}}--}}
{{--        <ul class="c-sidebar-nav-dropdown-items">--}}
            @foreach($menu["childrens"] as $childrens)
                @include('layouts.master-itemmenu',["menu"=>$childrens])
            @endforeach
{{--        </ul>--}}
{{--    </li>--}}
    @endif
@else
    <li class="c-sidebar-nav-item @if($hasChildren) c-sidebar-nav-dropdown @endif">
        <a class="c-sidebar-nav-link @if($hasChildren) c-sidebar-nav-dropdown-toggle @endif" target="{{$menu["target"]}}" href="{{$menu["url"]}}">
            @if(empty($menu["icons"]) || $menu["icons"] == "")
                <span class="c-sidebar-nav-icon"></span>
            @else
                <div class="c-sidebar-nav-icon">
                    <i class="{{$menu["icons"]}}"></i>
                </div>
            @endif
            {{$menu["name"]}}
        </a>
        @if($hasChildren)
            <ul class="c-sidebar-nav-dropdown-items">
                @foreach($menu["childrens"] as $childrens)
                    @include('layouts.master-itemmenu',["menu"=>$childrens])
                @endforeach
            </ul>
        @endif
    </li>
@endif
