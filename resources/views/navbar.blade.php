<nav class="bg-gray-800 text-white sticky top-0 z-50 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold tracking-wide hover:text-blue-400 transition duration-300">
                    ProjectPilot
                </a>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center lg:hidden">
                <button id="hamburger-menu-toggle" class="text-gray-400 hover:text-white focus:outline-none transition duration-300" aria-expanded="false" aria-controls="mobile-menu" aria-label="Toggle menu">
                    <svg class="h-6 w-6" id="hamburger-icon" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="h-6 w-6 hidden" id="close-icon" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop -->
            <div class="hidden lg:flex items-center space-x-4">
                @auth
                    @if (Auth::user()->role == 'admin')
                        <div class="relative group">
                            <button class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 transition duration-300 focus:outline-none">
                                Clients
                                <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute hidden group-hover:block bg-gray-700 rounded-md shadow-lg py-2 w-40">
                                <a href="{{ route('client.index') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600 transition duration-300">
                                    <i class="fas fa-list"></i> View All
                                </a>
                                <a href="{{ route('users.create') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600 transition duration-300">
                                    <i class="fas fa-plus"></i> Add New
                                </a>
                            </div>
                        </div>
                        <div class="relative group">
                            <button class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 transition duration-300 focus:outline-none">
                                Projects
                                <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute hidden group-hover:block bg-gray-700 rounded-md shadow-lg py-2 w-40">
                                <a href="{{ route('projects.index') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600 transition duration-300">
                                    <i class="fas fa-list"></i> View All
                                </a>
                                <a href="{{ route('projects.create') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600 transition duration-300">
                                    <i class="fas fa-plus"></i> Add New
                                </a>
                            </div>
                        </div>
                        <div class="relative group">
                            <button class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 transition duration-300 focus:outline-none">
                                Tasks
                                <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute hidden group-hover:block bg-gray-700 rounded-md shadow-lg py-2 w-40">
                                <a href="{{ route('tasks.index') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600 transition duration-300">
                                    <i class="fas fa-list"></i> View All
                                </a>
                                <a href="{{ route('tasks.create') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600 transition duration-300">
                                    <i class="fas fa-plus"></i> Add New
                                </a>
                            </div>
                        </div>
                        <div class="relative group">
                            <button class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 transition duration-300 focus:outline-none">
                                Employees
                                <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute hidden group-hover:block bg-gray-700 rounded-md shadow-lg py-2 w-40">
                                <a href="{{ route('employee.index') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600 transition duration-300">
                                    <i class="fas fa-list"></i> View All
                                </a>
                                <a href="{{ route('users.create') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600 transition duration-300">
                                    <i class="fas fa-plus"></i> Add New
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="relative">
                        <button id="dropdown-toggle" class="flex items-center space-x-1 text-sm font-medium hover:text-blue-400 focus:outline-none transition duration-300">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform" id="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="dropdown-menu" class="hidden absolute right-0 w-48 py-2 mt-2 bg-white rounded-md shadow-xl z-20 space-y-2">
                            <a href="{{ route(Auth::user()->role . '.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-300">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-300">
                                <i class="fas fa-user"></i> Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-300">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('login') ? 'bg-gray-900' : '' }}">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Mobile -->
    <div id="mobile-menu" class="hidden lg:hidden bg-gray-700 shadow-inner">
        <div class="px-2 pt-2 pb-3 space-y-1">
            @auth
                @if (Auth::user()->role == 'admin')
                    <a href="{{ route('client.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300">
                        All Clients
                    </a>
                    <a href="{{ route('users.create') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300">
                        Add New Client
                    </a>
                    <a href="{{ route('projects.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300">
                        All Projects
                    </a>
                    <a href="{{ route('projects.create') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300">
                        Add New Project
                    </a>
                    <a href="{{ route('tasks.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300">
                        All Tasks
                    </a>
                    <a href="{{ route('tasks.create') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300">
                        Add New Task
                    </a>
                    <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300">
                        All Users
                    </a>
                    <a href="{{ route('users.create') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300">
                        Add New User
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300 {{ request()->routeIs('login') ? 'bg-gray-900' : '' }}">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggle = document.getElementById('dropdown-toggle');
        const dropdownMenu = document.getElementById('dropdown-menu');
        const dropdownIcon = document.getElementById('dropdown-icon');
        const hamburgerToggle = document.getElementById('hamburger-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        dropdownToggle.addEventListener('click', function() {
            dropdownMenu.classList.toggle('hidden');
            dropdownIcon.classList.toggle('rotate-180');
        });

        hamburgerToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    });
</script>