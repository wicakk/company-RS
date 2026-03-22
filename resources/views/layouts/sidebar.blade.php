@php
    use App\Helpers\MenuHelper;
    $menuGroups = MenuHelper::getMenuGroups();
    $currentPath = request()->path();
@endphp

<aside id="sidebar"
    class="fixed flex flex-col mt-0 top-0 px-5 left-0 bg-white dark:bg-gray-900 dark:border-gray-800 text-gray-900 h-screen transition-all duration-300 ease-in-out z-[99999] border-r border-gray-200 overflow-y-auto overflow-x-hidden"
    x-data="{
        openSubmenus: {},
        init() { this.initializeActiveMenus(); },
        initializeActiveMenus() {
            const cp = '{{ $currentPath }}';
            @foreach($menuGroups as $gi => $group)
                @foreach($group['items'] as $ii => $item)
                    @if(isset($item['subItems']))
                        @foreach($item['subItems'] as $sub)
                            if (cp === '{{ ltrim($sub['path'],'/') }}' || window.location.pathname === '{{ $sub['path'] }}') {
                                this.openSubmenus['{{ $gi }}-{{ $ii }}'] = true;
                            }
                        @endforeach
                    @endif
                @endforeach
            @endforeach
        },
        toggleSubmenu(gi, ii) {
            const k = gi+'-'+ii, v = !this.openSubmenus[k];
            if (v) this.openSubmenus = {};
            this.openSubmenus[k] = v;
        },
        isSubmenuOpen(gi, ii) { return this.openSubmenus[gi+'-'+ii] || false; },
        isActive(path) { return window.location.pathname === path || '{{ $currentPath }}' === path.replace(/^\//,''); }
    }"
    :class="{
        'w-[290px]': $store.sidebar.isExpanded || $store.sidebar.isMobileOpen || $store.sidebar.isHovered,
        'w-[90px]' : !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
        'translate-x-0'            :  $store.sidebar.isMobileOpen,
        '-translate-x-full xl:translate-x-0': !$store.sidebar.isMobileOpen
    }"
    @mouseenter="if (!$store.sidebar.isExpanded) $store.sidebar.setHovered(true)"
    @mouseleave="$store.sidebar.setHovered(false)">

    {{-- ── Logo ─────────────────────────────────────────────── --}}
    <div class="pt-8 pb-7 flex"
         :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'">
        <a href="/admin" class="flex items-center gap-3">
            {{-- Icon (always visible) --}}
            <div class="w-9 h-9 flex-shrink-0 rounded-xl flex items-center justify-center"
                 style="background:linear-gradient(135deg,#3b97f3,#1560d5);">
                <svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            {{-- Text (only when expanded) --}}
            <div x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                 style="line-height:1.2;">
                <div style="font-weight:700;font-size:0.9rem;color:inherit;" class="text-gray-900 dark:text-white whitespace-nowrap">RS Medika</div>
                <div style="font-size:0.7rem;color:#3b97f3;font-weight:600;" class="whitespace-nowrap">Nusantara</div>
            </div>
        </a>
    </div>

    {{-- ── Navigation ──────────────────────────────────────── --}}
    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar flex-1">
        <nav class="mb-6">
            <div class="flex flex-col gap-4">
                @foreach($menuGroups as $gi => $group)
                <div>
                    {{-- Group Title --}}
                    <h2 class="mb-4 text-xs uppercase flex leading-5 text-gray-400"
                        :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'lg:justify-center' : 'justify-start'">
                        <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">
                            {{ $group['title'] }}
                        </span>
                        <span x-show="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/>
                            </svg>
                        </span>
                    </h2>

                    {{-- Menu Items --}}
                    <ul class="flex flex-col gap-1">
                        @foreach($group['items'] as $ii => $item)
                        <li>
                            @if(isset($item['subItems']))
                            {{-- With Submenu --}}
                            <button @click="toggleSubmenu({{ $gi }}, {{ $ii }})"
                                    class="menu-item w-full"
                                    :class="[
                                        isSubmenuOpen({{ $gi }},{{ $ii }}) ? 'menu-item-active' : 'menu-item-inactive',
                                        (!$store.sidebar.isExpanded && !$store.sidebar.isHovered) ? 'xl:justify-center' : 'xl:justify-start'
                                    ]">
                                <span :class="isSubmenuOpen({{ $gi }},{{ $ii }}) ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    {!! MenuHelper::getIconSvg($item['icon']) !!}
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                      class="flex-1 text-left">{{ $item['name'] }}</span>
                                <svg x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                     class="ml-auto w-4 h-4 transition-transform duration-200"
                                     :class="{ 'rotate-180': isSubmenuOpen({{ $gi }},{{ $ii }}) }"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            {{-- Submenu --}}
                            <div x-show="isSubmenuOpen({{ $gi }},{{ $ii }}) && ($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)"
                                 x-transition>
                                <ul class="mt-1 space-y-1 ml-9">
                                    @foreach($item['subItems'] as $sub)
                                    <li>
                                        <a href="{{ $sub['path'] }}"
                                           class="menu-dropdown-item"
                                           :class="isActive('{{ $sub['path'] }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            {{ $sub['name'] }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            @else
                            {{-- Simple Item --}}
                            <a href="{{ $item['path'] }}"
                               class="menu-item"
                               :class="[
                                   isActive('{{ $item['path'] }}') ? 'menu-item-active' : 'menu-item-inactive',
                                   (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                               ]">
                                <span :class="isActive('{{ $item['path'] }}') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    {!! MenuHelper::getIconSvg($item['icon']) !!}
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">
                                    {{ $item['name'] }}
                                </span>
                            </a>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </nav>

        {{-- Sidebar Widget --}}
        <div x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
             x-transition class="mt-auto pb-4">
            <div style="border-radius:16px;background:#f9fafb;padding:1.25rem;text-align:center;" class="dark:bg-white/5 mx-auto max-w-[220px]">
                <div style="width:40px;height:40px;border-radius:10px;background:linear-gradient(135deg,#3b97f3,#1560d5);display:flex;align-items:center;justify-content:center;margin:0 auto 0.75rem;">
                    <svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <p style="font-weight:600;font-size:0.8rem;margin-bottom:0.25rem;" class="text-gray-900 dark:text-white">RS Medika</p>
                <p style="font-size:0.7rem;color:#6b7280;margin-bottom:0.75rem;" class="dark:text-gray-400">Admin Panel v1.0</p>
                <a href="/" target="_blank"
                   style="display:flex;align-items:center;justify-content:center;gap:6px;padding:8px;border-radius:8px;background:#3b97f3;color:white;font-size:0.75rem;font-weight:600;text-decoration:none;"
                   onmouseover="this.style.background='#1d77e8'" onmouseout="this.style.background='#3b97f3'">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Website
                </a>
            </div>
        </div>
    </div>
</aside>
