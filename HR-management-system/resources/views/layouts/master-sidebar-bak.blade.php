<div class="c-sidebar c-sidebar-dark c-sidebar-fixed{{ !isset($layout['sidebarHidden']) || !$layout['sidebarHidden'] ? ' c-sidebar-lg-show' : '' }}" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <div class="c-sidebar-brand-full text-uppercase">
            <strong>Quản lý Kho</strong>
        </div>
        <div class="c-sidebar-brand-minimized text-uppercase text-center">
            <strong>QLK</strong>
        </div>
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('index') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-home"></i>
                </div>
                Trang chủ
            </a>
        </li>
        <li class="c-sidebar-nav-title">Quản lý nghiệp vụ</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('stock.export.create') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-download"></i>
                </div>
                Nhập kho
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('stock.export.index') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-download"></i>
                </div>
                DS phiếu nhập
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('stock.voucherDelivery.create') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-upload"></i>
                </div>
                Xuất kho
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('stock.voucherDelivery.index') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-upload"></i>
                </div>
                DS phiếu xuất
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('exchanges.create') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                Đổi/Trả SP
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('orders.index') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                Đơn hàng
            </a>
        </li>

        <li class="c-sidebar-nav-title">Báo cáo</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('stock.report.voucherReceivingIndex') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-download"></i>
                </div>
                Tổng hợp nhập kho
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('stock.report.voucherDeliveryIndex') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-upload"></i>
                </div>
                Tổng hợp xuất kho
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('report.index') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-archive"></i>
                </div>
                Báo cáo tồn kho
            </a>
        </li>
        <li class="c-sidebar-nav-title">Quản lý Kho</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('stock.stock.index') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-warehouse"></i>
                </div>
                Kho hàng
            </a>
        </li>
        <li class="c-sidebar-nav-title">Quản lý Danh mục</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('stock.productType.index') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-archive"></i>
                </div>
                Loại Sản phẩm
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('stock.product.index') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-box"></i>
                </div>
                Sản phẩm
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('printer.index') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-qrcode"></i>
                </div>
                In mã vạch
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('stock.consignee.index') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="far fa-building"></i>
                </div>
                Đơn vị nhận hàng
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('stock.workshop.index') }}">
                <div class="c-sidebar-nav-icon">
                    <i class="fas fa-industry"></i>
                </div>
                Phân xưởng sản xuất
            </a>
        </li>

    </ul>
</div>
