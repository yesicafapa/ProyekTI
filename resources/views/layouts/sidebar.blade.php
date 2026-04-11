@php
    use App\Helpers\MenuHelper;
    $menuGroups = MenuHelper::getMainNavItems(); 
@endphp

<aside id="sidebar"
    class="fixed flex flex-col top-0 left-0 z-9999 h-screen transition-all duration-300 ease-in-out bg-white border-r border-gray-200 dark:bg-gray-900 dark:border-gray-800"
    x-data="{
        openSubmenus: {},
        toggleSubmenu(key) {
            if($store.sidebar.isExpanded || $store.sidebar.isHovered) {
                this.openSubmenus[key] = !this.openSubmenus[key];
            }
        }
    }"
    :class="{
        'w-72.5': $store.sidebar.isExpanded || $store.sidebar.isHovered,
        'w-20': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
        'translate-x-0': $store.sidebar.isMobileOpen,
        '-translate-x-full lg:translate-x-0': !$store.sidebar.isMobileOpen
    }"
    @mouseenter="$store.sidebar.setHovered(true)"
    @mouseleave="$store.sidebar.setHovered(false)">

    <div class="flex items-center justify-center h-20 px-6">
        <a href="{{ route('dashboard') }}" class="flex items-center justify-center w-full text-black dark:text-white">
            <template x-if="$store.sidebar.isExpanded || $store.sidebar.isHovered">
                <span class="text-xl font-bold uppercase whitespace-nowrap tracking-widest text-orange-500">CV SEOVDETECH</span>
            </template>
            <template x-if="!$store.sidebar.isExpanded && !$store.sidebar.isHovered">
                <span class="text-2xl font-black text-orange-500">S</span>
            </template>
        </a>
    </div>

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear flex-grow">
        <nav class="mt-5 px-4 lg:px-4">
            @foreach ($menuGroups as $groupIndex => $group)
                @php 
                    $groupName = strtoupper($group['group']);
                    $userLevel = strtolower(auth()->user()->level);
                @endphp

                <div class="mb-6">
                    {{-- Judul Grup (Hanya tampil jika level sesuai) --}}
                    @if ($groupName !== 'ADMINISTRATOR' || $userLevel === 'super admin')
                        <h3 class="mb-4 ml-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest"
                            x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered">
                            {{ $group['group'] }}
                        </h3>

                        <ul class="flex flex-col gap-2">
                            @foreach ($group['items'] as $itemIndex => $item)
                                {{-- Filter Item --}}
                                @if (strtoupper($item['name']) !== 'SYSTEM SETTINGS')
                                    @php 
                                        $key = $groupIndex . '-' . $itemIndex; 
                                        // Gunakan request()->routeIs() agar lebih akurat mendeteksi halaman aktif
                                        $routePrefix = strtolower($item['name']);
                                        $isActive = request()->routeIs('management.' . $routePrefix . '.*') || request()->url() == $item['path'];
                                    @endphp

                                    <li class="relative">
                                        {{-- Link Menu --}}
                                        <a href="{{ $item['path'] }}"
                                            class="group relative flex items-center rounded-lg px-3 py-2.5 font-medium duration-300 ease-in-out {{ $isActive ? 'bg-gray-100 dark:bg-gray-800 text-orange-500 dark:text-white' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:text-orange-500' }}"
                                            :class="{
                                                'justify-start': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                                                'justify-center': !$store.sidebar.isExpanded && !$store.sidebar.isHovered
                                            }">
                                            <span class="flex-shrink-0 transition-colors duration-300 group-hover:text-orange-500 {{ $isActive ? 'text-orange-500' : '' }}">
                                                {!! MenuHelper::getIconSvg($item['icon'] ?? 'dashboard') !!}
                                            </span>
                                            <span class="ml-3 transition-opacity duration-300"
                                                x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered">
                                                {{ $item['name'] }}
                                            </span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </nav>
    </div>
</aside>