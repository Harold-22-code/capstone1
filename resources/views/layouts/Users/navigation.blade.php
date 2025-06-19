<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm font-[serif] text-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo and Title -->
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Church Logo" class="h-12 w-auto rounded-full shadow border border-yellow-400">
                    <span class="text-2xl text-blue-900 font-semibold tracking-wide">San Jacinto Parish</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden sm:flex space-x-8 items-center text-sm">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-blue-800 transition">
                    {{ __('Dashboard') }}
                </x-nav-link>
                <x-nav-link href="{{ route('users.schedule-form') }}" class="hover:text-blue-800 transition">
                    {{ __('Book Schedule') }}
                </x-nav-link>

                <!-- Add Record Dropdown -->
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center text-gray-700 hover:text-blue-800 transition font-medium">
                            {{ __('Add Record') }}
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-width="2" d="M6 8l4 4 4-4" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('users.add-baptism-record') }}">
                            {{ __('Baptismal Record') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('users.add-wedding-record') }}">
                            {{ __('Marriage Record') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('users.burial-form') }}">
                            {{ __('Burial Record') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('users.confirm-form') }}">
                            {{ __('Confirmation Record') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center text-gray-700 hover:text-blue-800 transition font-medium">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L10 13.414l-4-4a1 1 0 010-1.414z"/>
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('profile.edit') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                        <x-dropdown-link>
                            <span class="text-xs italic text-gray-500">Role: {{ Auth::user()->roles[0]->name }}</span>
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-500 hover:bg-gray-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-white text-gray-800 shadow-md p-4">
        <x-responsive-nav-link :href="route('dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('users.schedule-form')">
            {{ __('Book Schedule') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('users.add-baptism-record')">
            {{ __('Baptismal Record') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('users.add-wedding-record')">
            {{ __('Marriage Record') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('users.burial-form')">
            {{ __('Burial Record') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('users.confirm-form')">
            {{ __('Confirmation Record') }}
        </x-responsive-nav-link>
        <hr class="my-2 border-gray-200">
        <div class="text-sm text-gray-700 mb-1">{{ Auth::user()->name }}</div>
        <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
        <x-responsive-nav-link :href="route('profile.edit')">
            {{ __('Profile') }}
        </x-responsive-nav-link>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
    </div>
</nav>
