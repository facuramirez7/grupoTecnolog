<div x-cloak x-data="sidebar()" class="relative flex items-start ">
    <div class="fixed top-0 z-40 transition-all duration-300">
        <div class="flex justify-end">
            <button @click="sidebarOpen = !sidebarOpen"
                :class="{ 'hover:bg-gray-300': !sidebarOpen, 'hover:bg-gray-700': sidebarOpen }"
                class="transition-all duration-300 w-8 p-1 mx-3 my-2 rounded-full focus:outline-none">
                <svg viewBox="0 0 20 20" class="w-6 h-6 fill-current"
                    :class="{ 'text-gray-600': !sidebarOpen, 'text-gray-300': sidebarOpen }">
                    <path x-show="!sidebarOpen" fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                    <path x-show="sidebarOpen" fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>

    <div x-cloak wire:ignore :class="{ 'w-64': sidebarOpen, 'w-0': !sidebarOpen }"
        class="fixed top-0 bottom-0 left-0 z-30 block w-64 h-full min-h-screen overflow-y-auto text-white transition-all duration-300 ease-in-ou shadow-lg overflow-x-hidden"
        style="background-color: #0098CC;">

        <div class="flex flex-col items-stretch justify-between h-full">
            <div class="flex flex-col flex-shrink-0 w-full">
                <div class="flex items-center justify-center px-8 py-3 text-center">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                    </div>
                </div>

                <nav>
                    <div class="flex-grow md:block md:overflow-y-auto overflow-x-hidden"
                        :class="{ 'opacity-1': sidebarOpen, 'opacity-0': !sidebarOpen }">

                        {{-- Dashboard --}}
                        <a class="flex items-center px-4 py-3 hover:bg-gray-300 focus:bg-gray-300 hover:text-white focus:outline-none focus:ring {{ request()->is('dashboard') ? 'bg-gray-300' : '' }}"
                            href="{{ route('dashboard') }}">
                            <i class="fa-solid fa-house-chimney"></i><span class="mx-4">Inicio</span>
                        </a>

                        {{-- Devices --}}
                        <a class="flex items-center px-4 py-3 hover:bg-gray-300 focus:bg-gray-300 hover:text-white focus:outline-none focus:ring @if(request()->routeIs('dashboard')) bg-gray-300 @endif"
                            href="{{ route('services.index') }}">
                            <i class="fa-solid fa-tachograph-digital"></i></i><span class="mx-4">Máquinas</span>
                        </a>

                        {{-- Users --}}
                        <a class="flex items-center px-4 py-3 hover:bg-gray-300 focus:bg-gray-300 hover:text-white focus:outline-none focus:ring  @if(request()->routeIs('users.index')) bg-gray-300 @endif"
                            href="{{ route('users.index') }}">
                            <i class="fa-solid fa-users"></i></i><span class="mx-4">Usuarios</span>
                        </a>

                        {{-- Roles --}}
                        <a class="flex items-center px-4 py-3 hover:bg-gray-300 focus:bg-gray-300 hover:text-white focus:outline-none focus:ring  @if(request()->routeIs('rols.index')) bg-gray-300 @endif"
                            href="{{ route('rols.index') }}">
                            <i class="fa-solid fa-person-circle-exclamation"></i></i><span class="mx-4">Roles</span>
                        </a>

                        {{-- Clients --}}
                        <a class="flex items-center px-4 py-3 hover:bg-gray-300 focus:bg-gray-300 hover:text-white focus:outline-none focus:ring  @if(request()->routeIs('clients.index')) bg-gray-300 @endif"
                            href="{{ route('clients.index') }}">
                            <i class="fa-solid fa-wine-bottle"></i></i><span class="mx-4">Clientes</span>
                        </a>

                        {{-- Services --}}
                        <a class="flex items-center px-4 py-3 hover:bg-gray-300 focus:bg-gray-300 hover:text-white focus:outline-none focus:ring  @if(request()->routeIs('services.index')) bg-gray-300 @endif"
                            href="{{ route('services.index') }}">
                            <i class="fa-solid fa-list-check"></i></i><span class="mx-4">Servicios</span>
                        </a>

                        {{-- Components --}}
                        <a class="flex items-center px-4 py-3 hover:bg-gray-300 focus:bg-gray-300 hover:text-white focus:outline-none focus:ring  @if(request()->routeIs('services.index')) bg-gray-300 @endif"
                            href="{{ route('services.index') }}">
                            <i class="fa-solid fa-ring"></i><span class="mx-4">Repuestos</span>
                        </a>

                    </div>

                </nav>

            </div>
            <div class="inline mb-4">

                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a href="{{ route('profile.show') }}" class="text-start px-4 py-3"><i class="fa-solid fa-user-gear"></i></a>
                    <a title="Logout" href="{{ route('logout') }}" @click.prevent="$root.submit();" class="text-end px-4 py-3">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </a>
                    
                </form>
            </div>
        </div>

        <script>
            function sidebar() {
                return {
                    sidebarOpen: true,
                    sidebarProductMenuOpen: false,
                    openSidebar() {
                        this.sidebarOpen = true
                    },
                    closeSidebar() {
                        this.sidebarOpen = false
                    },
                    sidebarProductMenu() {
                        if (this.sidebarProductMenuOpen === true) {
                            this.sidebarProductMenuOpen = false
                            window.localStorage.setItem('sidebarProductMenuOpen', 'close');
                        } else {
                            this.sidebarProductMenuOpen = true
                            window.localStorage.setItem('sidebarProductMenuOpen', 'open');
                        }
                    },
                    checkSidebarProductMenu() {
                        if (window.localStorage.getItem('sidebarProductMenuOpen')) {
                            if (window.localStorage.getItem('sidebarProductMenuOpen') === 'open') {
                                this.sidebarProductMenuOpen = true
                            } else {
                                this.sidebarProductMenuOpen = false
                                window.localStorage.setItem('sidebarProductMenuOpen', 'close');
                            }
                        }
                    },
                }
            }
        </script>
    </div>



</div>
