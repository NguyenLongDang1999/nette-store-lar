<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
            <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>
    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach(adminMenuList() as $parent)
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">{{ $parent['title'] ?? '' }}</span>
            </li>

            @if(count($parent['content']))
                @foreach($parent['content'] as $child)
                    <li class="menu-item">
                        <a href="{{ $child['href'] ?? '' }}" class="menu-link">
                            <i class="menu-icon tf-icons {{ $child['icon'] ?? '' }}"></i>
                            <span class="text-capitalize">{{ $child['title'] ?? '' }}</span>
                        </a>
                    </li>
                @endforeach
            @endif
        @endforeach
    </ul>
</aside>
