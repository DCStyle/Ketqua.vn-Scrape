<header class="bg-white border-bottom position-relative">
    <div class="container max-w-1140px">
        <div class="header">
            <div class="logo">
                <a href="/" title="Kết quả">
                    <img alt="trang chu ket qua" src="{{ setting('site_logo') ? Storage::url(setting('site_logo')) : 'https://placehold.co/126x38' }}">
                </a>
            </div>
            <div class="divider"></div>
            <div class="title">
                <div class="underline">
                    <h1 class="line-clamp-1">XSMB - Kết Quả Xổ Số Miền Bắc - SXMB Hôm Nay - KQXSMB</h1>
                </div>
            </div>
            <div class="today">
                @php
                    $today = now();
                    $dayNames = [
                        0 => 'Chủ nhật',
                        1 => 'Thứ 2',
                        2 => 'Thứ 3',
                        3 => 'Thứ 4',
                        4 => 'Thứ 5',
                        5 => 'Thứ 6',
                        6 => 'Thứ 7'
                    ];
                @endphp

                Hôm nay: {{ $dayNames[$today->dayOfWeek] }} ngày {{ $today->format('d/m/Y') }}
            </div>
            <div class="calendar-toggle" onclick="tableCalendar()"><i class="far fa-calendar-alt fs-5 color-sub-brand"></i></div>
            <div class="menu-toggle" id="open-sidebar-menu"><i class="fas fa-bars fs-5 color-secondary"></i></div>
        </div>
    </div>
    <nav class="nav-bar" id="sidebar-menu">
        <div class="sidebar-header">
            <img class="mb-2" width="125" height="39" alt="logo" src="{{ setting('site_logo') ? Storage::url(setting('site_logo')) : 'https://placehold.co/126x38' }}">
            <span class="txt-sub-content text-center">Trang kết quả xổ số hàng đầu Việt Nam</span>
            <div class="sidebar-close" id="close-sidebar-menu">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
        <div class="container max-w-1140px">
            <ul class="nav-list">
                @foreach($menuItems as $menu)
                    <li class="nav-items">
                        <a class="nav-links" href="{{ $menu->url }}" title="{{ $menu->title }}">
                            @if($menu->title === 'Trang chủ')
                                <i class="fas fa-home color-sub-brand show-on-mobile me-2"></i>
                            @elseif(in_array($menu->title, ['XSMB', 'XSMT', 'XSMN', 'Vietlott']))
                                <i class="fas fa-dot-circle text-{{ $menu->title === 'XSMB' ? 'danger' : ($menu->title === 'XSMT' ? 'warning' : ($menu->title === 'XSMN' ? 'info' : 'success')) }} show-on-mobile me-2"></i>
                            @elseif($menu->title === 'Sổ kết quả')
                                <i class="fas fa-book color-sub-brand show-on-mobile me-2"></i>
                            @elseif($menu->title === 'Soi cầu')
                                <i class="fas fa-bullseye color-sub-brand show-on-mobile me-2"></i>
                            @elseif($menu->title === 'Thống kê')
                                <i class="fas fa-chart-bar color-sub-brand show-on-mobile me-2"></i>
                            @elseif($menu->title === 'Dò vé số')
                                <i class="fas fa-search color-sub-brand show-on-mobile me-2"></i>
                            @elseif($menu->title === 'Quay thử')
                                <i class="fas fa-play-circle color-sub-brand show-on-mobile me-2"></i>
                            @elseif($menu->title === 'Lịch mở thưởng')
                                <i class="far fa-calendar-alt color-sub-brand show-on-mobile me-2"></i>
                            @elseif($menu->title === 'Liên hệ')
                                <i class="fas fa-phone-alt color-sub-brand show-on-mobile me-2"></i>
                            @endif
                            {{ $menu->title }}
                            @if($menu->children->count() > 0)
                                <i class="fas fa-caret-down ms-2 nav-items-dropdown"></i>
                            @endif
                        </a>
                        @if($menu->children->count() > 0)
                            <i class="fas fa-caret-down sidebar-dropdown"></i>
                            <ul class="dropdown-list">
                                @foreach($menu->children as $child)
                                    <li class="dropdown-items">
                                        <a class="dropdown-links" href="{{ $child->url }}" title="{{ $child->title }}">
                                            {{ $child->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
</header>
