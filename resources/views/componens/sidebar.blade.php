<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <ul class="nav nav-primary">
            @php
                $currentTitle = strtoupper($title ?? '');
                $currentSubTitle = strtoupper($subTitle ?? '');
            @endphp
            
            @foreach (Session::get('menu', []) as $menu)
                @if(isset($menu->menu_sub) && count($menu->menu_sub) > 0)
                    @php
                        $isMenuActive = $currentTitle == strtoupper($menu->menu_label);
                        $hasActiveSubmenu = collect($menu->menu_sub)->contains(function($sub) use ($currentSubTitle) {
                            return $currentSubTitle == strtoupper($sub->sub_menu_label);
                        });
                        $shouldExpand = $isMenuActive || $hasActiveSubmenu;
                    @endphp
                    
                    <li class="nav-item {{ $shouldExpand ? 'active submenu' : '' }}">
                        <a data-bs-toggle="collapse" 
                           href="#menu{{ $menu->id }}" 
                           class="nav-link {{ $shouldExpand ? '' : 'collapsed' }}" 
                           aria-expanded="{{ $shouldExpand ? 'true' : 'false' }}"
                           role="button">
                            <i class="{{ $menu->icon ?? 'fas fa-circle' }}"></i>
                            <p>
                                {{ $menu->menu_label }}
                                <span class="caret"></span>
                            </p>
                        </a>
                        
                        <div class="collapse {{ $shouldExpand ? 'show' : '' }}" 
                             id="menu{{ $menu->id }}"
                             data-bs-parent=".nav-primary">
                            <ul class="nav nav-collapse">
                                @foreach($menu->menu_sub as $submenu)
                                    @php
                                        $isSubmenuActive = $currentSubTitle == strtoupper($submenu->sub_menu_label);
                                    @endphp
                                    <li class="nav-item {{ $isSubmenuActive ? 'active' : '' }}">
                                        <a href="{{ url($submenu->link) }}" 
                                           class="nav-link d-flex align-items-center"
                                           title="{{ $submenu->sub_menu_label }}">
                                            @if(isset($submenu->icon))
                                                <i class="{{ $submenu->icon }} me-2"></i>
                                            @else
                                                <span class="sub-indicator me-2"></span>
                                            @endif
                                            <span class="sub-item">{{ $submenu->sub_menu_label }}</span>
                                            @if($isSubmenuActive)
                                                <i class="fas fa-chevron-right ms-auto text-primary"></i>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @else
                    @php
                        $isMenuActive = $currentTitle == strtoupper($menu->menu_label);
                    @endphp
                    
                    <li class="nav-item {{ $isMenuActive ? 'active' : '' }}">
                        <a href="{{ $menu->link ?? '#' }}" 
                           class="nav-link d-flex align-items-center"
                           title="{{ $menu->menu_label }}">
                            <i class="{{ $menu->icon ?? 'fas fa-circle' }}"></i>
                            <p class="mb-0">
                                {{ $menu->menu_label }}
                                @if($isMenuActive)
                                    <span class="badge badge-primary ms-auto">Active</span>
                                @endif
                            </p>
                        </a>
                    </li>
                @endif
            @endforeach
            
            @if(empty(Session::get('menu', [])))
                <li class="nav-item">
                    <div class="nav-link text-center text-muted">
                        <i class="fas fa-info-circle mb-2"></i>
                        <p class="small">No menu items available</p>
                    </div>
                </li>
            @endif
        </ul>
        
        <!-- Sidebar Footer -->
        <div class="sidebar-footer mt-4 p-3">
            <div class="text-center">
                <small class="text-muted d-block">
                    <i class="fas fa-copyright me-1"></i>
                    {{ date('Y') }} CMS System
                </small>
                <small class="text-muted">
                    Version 1.0
                </small>
            </div>
        </div>
    </div>
</div>

<style>
.nav-primary .nav-item .nav-link {
    padding: 12px 16px;
    margin: 2px 8px;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
}

.nav-primary .nav-item .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transform: translateX(4px);
}

.nav-primary .nav-item.active > .nav-link {
    background: linear-gradient(135deg, #5d87ff 0%, #4c73f5 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(93, 135, 255, 0.3);
}

.nav-primary .nav-item .nav-link i {
    width: 20px;
    text-align: center;
    margin-right: 12px;
    font-size: 16px;
    opacity: 0.8;
}

.nav-primary .nav-item.active .nav-link i {
    opacity: 1;
}

.nav-collapse .nav-item .nav-link {
    padding: 8px 16px 8px 48px;
    margin: 1px 8px;
    font-size: 14px;
    border-radius: 6px;
}

.nav-collapse .nav-item.active .nav-link {
    background-color: rgba(93, 135, 255, 0.2);
    color: #5d87ff;
    font-weight: 500;
}

.sub-indicator {
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.5);
}

.nav-collapse .nav-item.active .sub-indicator {
    background-color: #5d87ff;
}

.caret {
    float: right;
    margin-top: 8px;
    border-top: 4px solid;
    border-right: 4px solid transparent;
    border-left: 4px solid transparent;
    transition: transform 0.3s ease;
}

.nav-link[aria-expanded="true"] .caret {
    transform: rotate(180deg);
}

.sidebar-footer {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    margin-top: auto;
}

.badge-primary {
    background-color: #5d87ff;
    font-size: 10px;
    padding: 2px 6px;
}

@media (max-width: 768px) {
    .nav-primary .nav-item .nav-link {
        padding: 10px 12px;
    }
    
    .nav-collapse .nav-item .nav-link {
        padding: 6px 12px 6px 40px;
    }
}
</style>