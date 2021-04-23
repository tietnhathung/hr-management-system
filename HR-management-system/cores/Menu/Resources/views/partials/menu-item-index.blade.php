<div class="col-md-12 menu-item @if($menu["menu_title"] == 1) menu-title @endif" data-id="{{ $menu["id"]}}">
    <div class="row info-menu">
        <div class="col-md-1 text-center" >
            <input type="checkbox" value="{{ $menu["id"]}}" name="ids[]" class="chk-item" autocomplete="off" />
        </div>
        <div class="col-md-2">
            <i class="icon-menu {{ $menu["icons"] }}"></i>
            <span class="name-menu">{{$menu["name"]}}</span>
        </div>
        <div class="col-md-3 text-center">
            {{$menu["url"]}}
        </div>
        <div class="col-md-2 text-center">
            {{$menu["target"]}}
        </div>
        <div class="col-md-2 text-center">
            <label class="c-switch c-switch-label c-switch-success mb-0">
                {{ Form::checkbox('target', 1, $menu["status"] == 1, ['class' => 'c-switch-input changeStatusmenu', 'autocomplete' => 'off', 'abbr' => $menu["id"], 'abbr-url' => route("menu.updateStatus")]) }}
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <div class="col-md-2 text-center">
            <a href="{{ Utilities::getUrlWithGoBack(route('menu.edit',$menu["id"])) }}" class="btn btn-info btn-sm" title="Update">
                <i class="fas fa-pencil-alt"></i>
            </a>
            <a href="#" class="btn btn-danger btn-sm btn-delete-menu" title="Delete"  data-ajax-url="{{ route('menu.destroy',$menu["id"]) }}">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </div>

    <div class="row list-group-menu" data-id="{{ $menu["id"]}}">
        @foreach($menu["childrens"] as $child)
            @include("menu::partials.menu-item-index",["menu" => $child])
        @endforeach
    </div>

</div>
