<nav class="bg-gray-800 text-white sticky top-0 z-50 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}"
                    class="text-xl font-bold tracking-wide hover:text-blue-400 transition duration-300">
                    ProjectPilot
                </a>
            </div>

            <!-- Hamburger Menu for Small Screens -->
            <div class="flex items-center lg:hidden">
                <button id="hamburger-menu-toggle"
                    class="text-gray-400 hover:text-white focus:outline-none transition duration-300"
                    aria-expanded="false" aria-controls="mobile-menu" aria-label="Toggle menu">
                    <svg class="h-6 w-6" id="hamburger-icon" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="h-6 w-6 hidden" id="close-icon" stroke="currentColor" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-4">
               
                @auth
                    <div class="relative">
                        <button id="dropdown-toggle"
                            class="flex items-center space-x-1 text-sm font-medium hover:text-blue-400 focus:outline-none transition duration-300">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform" id="dropdown-icon" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div id="dropdown-menu"
                            class="hidden absolute right-0 w-48 py-2 mt-2 bg-white rounded-md shadow-xl z-20">
                            <a id="dropdown-link" href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-300"></a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-300">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('login') ? 'bg-gray-900' : '' }}">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-3 py-2 bg-blue-600 rounded-md text-sm font-medium hover:bg-blue-700 transition duration-300 {{ request()->routeIs('register') ? 'bg-blue-700' : '' }}">
                            Get Started
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-gray-700 shadow-inner">
        <div class="px-2 pt-2 pb-3 space-y-1">
         
            @auth
                <a href="{{ route('profile.index') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300 {{ request()->routeIs('profile.index') ? 'bg-gray-900' : '' }}">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300 {{ request()->routeIs('login') ? 'bg-gray-900' : '' }}">
                    Login
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium bg-blue-600 hover:bg-blue-700 transition duration-300 {{ request()->routeIs('register') ? 'bg-blue-700' : '' }}">
                        Get Started
                    </a>
                @endif
            @endauth
        </div>
    </div>
</nav>

<script>
    const toggleMenu = document.getElementById('hamburger-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    const dropdownToggle = document.getElementById('dropdown-toggle');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const dropdownIcon = document.getElementById('dropdown-icon');

    toggleMenu.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden');
        hamburgerIcon.classList.toggle('hidden', !isOpen);
        closeIcon.classList.toggle('hidden', isOpen);

        toggleMenu.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    if (dropdownToggle) {
        dropdownToggle.addEventListener('click', (event) => {
            event.stopPropagation(); 
            dropdownMenu.classList.toggle('hidden');
            dropdownIcon.classList.toggle('rotate-180');
        });

        document.addEventListener('click', (event) => {
            if (!dropdownMenu.classList.contains('hidden') && !dropdownToggle.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
                dropdownIcon.classList.remove('rotate-180');
            }
        });
    }

    if (dropdownToggle) {
        dropdownToggle.setAttribute('aria-expanded', 'false');
        dropdownToggle.addEventListener('click', () => {
            const isExpanded = dropdownMenu.classList.contains('hidden') ? 'false' : 'true';
            dropdownToggle.setAttribute('aria-expanded', isExpanded);
        });
    }

    const currentRoute = window.location.pathname;
    const dropdownLink = document.getElementById('dropdown-link');
    if (dropdownLink) {
        if (currentRoute === '/profile') {
            dropdownLink.textContent = 'Home';
            dropdownLink.href = '/';
        } else {
            dropdownLink.textContent = 'Profile';
            dropdownLink.href = '/profile';
        }
    }

    mobileMenu.addEventListener('click', (event) => {
        if (event.target.tagName === 'A' || event.target.tagName === 'BUTTON') {
            mobileMenu.classList.add('hidden');
            hamburgerIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    });
</script>

{{-- ///////////////////////////// --}}
<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ClientDetailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('auth')->group(function () {

    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/client-details', [ClientDetailController::class, 'index'])->name('clientDetails.index');
    Route::get('/client-details/{clientDetail}', [ClientDetailController::class, 'show'])->name('clientDetails.show');
    Route::get('/client-details/create', [ClientDetailController::class, 'create'])->name('clientDetails.create');
    Route::get('/client-details/{clientDetail}/edit', [ClientDetailController::class, 'edit'])->name('clientDetails.edit');
    Route::post('/client-details', [ClientDetailController::class, 'store'])->name('clientDetails.store');
    Route::put('/client-details/{clientDetail}', [ClientDetailController::class, 'update'])->name('clientDetails.update');
    Route::delete('/client-details/{clientDetail}', [ClientDetailController::class, 'destroy'])->name('clientDetails.delete');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.admin');
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update'); 
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    Route::middleware(['role:client'])->group(function () {
        Route::get('client/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard.client');
    });
    Route::middleware(['role:employee'])->group(function () {
        Route::get('employee/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard.employee');
    });

    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [UserProfileController::class, 'delete'])->name('profile.delete');
});

require __DIR__ . '/auth.php';