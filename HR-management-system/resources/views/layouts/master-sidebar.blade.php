<div class="c-sidebar c-sidebar-dark c-sidebar-fixed{{ !isset($layout['sidebarHidden']) || !$layout['sidebarHidden'] ? ' c-sidebar-lg-show' : '' }}" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <a class="text-white text-uppercase text-decoration-none" href="{{url('/')}}">
            <div class="c-sidebar-brand-full text-uppercase">
                <img src="{{asset('/images/logo.png')}}" alt="Logo" class="img-fluid d-inline-block mr-1" style="width: 45px;" />
                <strong>Kho Tuấn Huyền</strong>
            </div>
            <div class="c-sidebar-brand-minimized text-uppercase text-center">
                <strong>Kho Tuấn Huyền</strong>
            </div>
        </a>
    </div>
    <ul class="c-sidebar-nav">
        @foreach ($admin_menus as $menu)
            @include('layouts.master-itemmenu',["menu"=> $menu])
        @endforeach
    </ul>
</div>
