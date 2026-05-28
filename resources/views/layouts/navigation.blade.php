<nav x-data="{ open: false }" class="bg-white border-b border-zinc-200">
    <!-- Primary Navigation Menu (Desktop) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('shop') }}">
                        <x-application-logo class="block h-8 w-auto fill-current text-zinc-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:ms-8 sm:flex sm:items-center">
                    <x-nav-link :href="route('shop')" :active="request()->routeIs('shop')">
                        {{ __('messages.nav_shop') }}
                    </x-nav-link>

                    @if (Auth::user()?->is_admin)
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('messages.nav_dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                            {{ __('messages.nav_products') }}
                        </x-nav-link>
                        <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')">
                            {{ __('messages.nav_categories') }}
                        </x-nav-link>
                        <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                            {{ __('messages.nav_blog') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-2">
                <!-- Language Switcher Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-sm font-medium text-zinc-700 hover:bg-zinc-100 focus:outline-none transition ease-in-out duration-150">
                            <span>{{ strtoupper(app()->getLocale()) }}</span>
                            <svg class="h-4 w-4 text-zinc-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('lang.switch', 'th')">
                            🇹🇭 ไทย (TH)
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('lang.switch', 'en')">
                            🇺🇸 English (EN)
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>

            @auth
                <!-- Settings Dropdown (visible for all authenticated users) -->
                <div class="flex items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md text-sm font-medium text-zinc-700 hover:bg-zinc-100 focus:outline-none transition ease-in-out duration-150">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4 text-zinc-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('messages.nav_profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('messages.nav_logout') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <!-- Login button for guests -->
                <div class="flex items-center">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium text-zinc-700 hover:bg-zinc-100 transition ease-in-out duration-150">
                        Login
                    </a>
                </div>
            @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-zinc-400 hover:text-zinc-600 hover:bg-zinc-100 focus:outline-none focus:bg-zinc-100 focus:text-zinc-600 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- เมนูที่ทุกคนเห็น -->
            <x-responsive-nav-link :href="route('shop')" :active="request()->routeIs('shop')">
                {{ __('messages.nav_shop') }}
            </x-responsive-nav-link>

            <!-- เมนูเฉพาะ Admin ในมือถือ -->
            @if (Auth::user()?->is_admin)
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('messages.nav_dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                    {{ __('messages.nav_products') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('categories.index')"
                    :active="request()->routeIs('categories.index')">
                    {{ __('messages.nav_categories') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                    {{ __('messages.nav_blog') }}
                </x-responsive-nav-link>
            @endif
        </div>

        @auth
            <!-- ถ้าล็อกอินแล้ว ให้แสดงข้อมูลผู้ใช้และปุ่ม Logout -->
            <div class="pt-4 pb-1 border-t border-zinc-200">
                <div class="px-4">
                    <div class="font-medium text-sm text-zinc-900">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-zinc-500 mt-0.5">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('messages.nav_profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('messages.nav_logout') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <!-- ถ้ายังไม่ล็อกอิน ให้แสดงปุ่ม Login ในเมนูมือถือ -->
            <div class="pt-4 pb-1 border-t border-zinc-200">
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>
