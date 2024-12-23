@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-gray-900">Client Dashboard</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">Welcome, {{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Access  -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-lg overflow-hidden transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">My Projects</h2>
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-4">View and manage your ongoing projects.</p>
                        <a href="{{ route('client.projects', ['user' => Auth::user()->id]) }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                            View All Projects
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg  overflow-hidden  transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">Project Tasks</h2>
                            <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-4">View tasks associated with your projects.</p>
                        <a href="{{ route('client.tasks', ['user' => Auth::user()->id]) }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-800 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            View All Tasks
                        </a>
                    </div>
                </div>
            </div>

            <!-- Data Overview  -->
            <div class="bg-white  rounded-lg overflow-hidden mb-8">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Data Overview</h2>

                    <!-- Tabs -->
                    <div class="mb-6">
                        <ul class="flex border-b">
                            <li class="mr-1">
                                <a href="#projects" id="default-tab"
                                    class="inline-block py-2 px-4 text-gray-600 hover:text-blue-500 font-semibold transition-all duration-300 rounded-t focus:outline-none active-tab">
                                    Projects
                                </a>
                            </li>
                            <li class="mr-1">
                                <a href="#tasks"
                                    class="inline-block py-2 px-4 text-gray-600 hover:text-blue-500 font-semibold transition-all duration-300 rounded-t focus:outline-none">
                                    Tasks
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Filter Buttons -->
                    <div class="mb-6 flex flex-wrap gap-2">
                        <button
                            class="tab-button px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 transition-all focus:outline-none ring-2 ring-blue-300"
                            data-status="all">All</button>
                        <button
                            class="tab-button px-4 py-2 bg-yellow-500 text-white rounded-lg shadow-md hover:bg-yellow-600 transition-all focus:outline-none ring-2 ring-yellow-300"
                            data-status="pending">Pending</button>
                        <button
                            class="tab-button px-4 py-2 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600 transition-all focus:outline-none ring-2 ring-green-300"
                            data-status="in_progress">In Progress</button>
                        <button
                            class="tab-button px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition-all focus:outline-none ring-2 ring-gray-300"
                            data-status="completed">Completed</button>
                    </div>

                    <!-- Projects Content -->
                    <div id="projects"
                        class="tab-content overflow-y-auto max-h-96 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 ">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($projects as $project)
                                @php
                                    $hasPendingTasks = $project->tasks->contains(
                                        fn($task) => $task->status === 'pending',
                                    );
                                    $hasInProgressTasks = $project->tasks->contains(
                                        fn($task) => $task->status === 'in_progress',
                                    );
                                    $status = $hasPendingTasks
                                        ? 'pending'
                                        : ($hasInProgressTasks
                                            ? 'in_progress'
                                            : 'complete');
                                @endphp
                                <div class="project-card bg-gradient-to-br from-white to-gray-50 rounded-lg  overflow-hidden border border-gray-200 "
                                    data-status="{{ $status }}">
                                    <div class="p-6">
                                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $project->name }}</h3>
                                        <p class="text-sm text-gray-500 mb-4">{{ Str::limit($project->description, 100) }}
                                        </p>
                                        <p class="mb-2"><strong>Start Date:</strong>
                                            {{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}</p>
                                        <p class="mb-2"><strong>End Date:</strong>
                                            {{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}</p>
                                        <p class="mb-2"><strong>Status:</strong>
                                            <span
                                                class="capitalize text-{{ $status === 'complete' ? 'green' : ($status === 'in_progress' ? 'yellow' : 'blue') }}-600">
                                                {{ ucfirst($status) }}
                                            </span>
                                        </p>
                                        <p class="mb-4"><strong>Tasks:</strong> {{ $project->tasks->count() }}</p>
                                        <div class="mt-4 flex justify-between items-center">
                                            <a href="{{ route('projects.show', $project->id) }}"
                                                class="text-blue-500 hover:text-blue-700 transition">View Details</a>
                                            <span class="text-sm text-gray-500">Updated:
                                                {{ \Carbon\Carbon::parse($project->updated_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tasks Content -->
                    <div id="tasks"
                        class="tab-content hidden overflow-y-auto max-h-96 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 ">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($tasks as $task)
                                <div class="task-card bg-gradient-to-br from-white to-gray-50 rounded-lg  overflow-hidden border border-gray-200 "
                                    data-status="{{ $task->status }}">
                                    <div class="p-6">
                                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $task->name }}</h3>
                                        <p class="text-sm text-gray-500 mb-4">{{ Str::limit($task->description, 100) }}</p>
                                        <p class="mb-2"><strong>Project:</strong> {{ $project->name }}</p>
                                        <p class="mb-2"><strong>Status:</strong>
                                            <span
                                                class="capitalize text-{{ $task->status === 'completed' ? 'green' : 'yellow' }}-800 rounded-full bg-{{ $task->status === 'completed' ? 'green' : 'yellow' }}-100 p-2 text-xs">{{ str_replace('_', ' ', $task->status) }}</span>
                                        </p>
                                        <p class="mb-2"><strong>Start Date:</strong>
                                            {{ \Carbon\Carbon::parse($task->start_date)->format('M d, Y') }}</p>
                                        <p class="mb-2"><strong>End Date:</strong>
                                            {{ \Carbon\Carbon::parse($task->end_date)->format('M d, Y') }}</p>
                                        <div class="mt-4 flex justify-between items-center">
                                            <a href="{{ route('tasks.show', $task->id) }}"
                                                class="text-blue-500 hover:text-blue-700 transition">View Details</a>
                                            <span class="text-sm text-gray-500">Updated:
                                                {{ \Carbon\Carbon::parse($task->updated_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Projects -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Projects</h2>
                        <div class="space-y-4 h-64 overflow-y-auto">
                            @foreach ($projects as $project)
                                <div class="bg-gray-50 rounded-lg p-4 flex flex-col">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $project['name'] }}</h3>
                                        <a href="{{ route('projects.show', [$project->id]) }}"
                                            class="text-xs text-blue-400 hover:text-blue-600 transition duration-200"
                                            aria-label="View details of task {{ $project->name }}">
                                            Details
                                        </a>
                                    </div>
                                    <div class="mt-2 flex justify-between text-sm text-gray-600">
                                        <span>Client: {{ $project->client->name }}</span>
                                        <span>Updated:
                                            {{ \Carbon\Carbon::parse($project['updated_at'])->diffForHumans() }}</span>
                                    </div>
                                    <div class="mt-1 flex justify-between text-sm text-gray-600">
                                        <span>Tasks: {{ $project->tasks->count() }}</span>
                                        <span> End Date: {{ $project->end_date->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Tasks</h2>
                        <div class="space-y-4 h-64 overflow-y-auto">
                            @foreach ($tasks as $task)
                                <div class="bg-gray-50 rounded-lg p-4 flex flex-col">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $task->name }} <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $task->status === 'completed' ? 'green' : 'yellow' }}-100 text-{{ $task->status === 'completed' ? 'green' : 'yellow' }}-800">
                                                {{ ucfirst($task['status']) }}
                                            </span></h3>
                                        <a href="{{ route('tasks.show', [$task->id]) }}"
                                            class="text-xs text-blue-400 hover:text-blue-600 transition duration-200"
                                            aria-label="View details of task {{ $task->name }}">
                                            Details
                                        </a>
                                    </div>
                                    <div class="mt-2 flex justify-between text-sm text-gray-600">
                                        <span>Project: {{ $project->name }}</span>
                                        <span> Updated:
                                            {{ \Carbon\Carbon::parse($task['updated_at'])->diffForHumans() }}</span>
                                    </div>
                                    <div class="text-xs">Updated By: <a href=""
                                            class="text-blue-400">{{ $project->updater->name }}</a></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('ul.flex.border-b li a');
            const tabContents = document.querySelectorAll('.tab-content');
            const filterButtons = document.querySelectorAll('.tab-button');
            const projectCards = document.querySelectorAll('.project-card');
            const taskCards = document.querySelectorAll('.task-card');

            // Tab switching functionality
            tabs.forEach(tab => {
                tab.addEventListener('click', (e) => {
                    e.preventDefault();
                    const target = document.querySelector(tab.getAttribute('href'));

                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });

                    // Reset all tabs to inactive state
                    tabs.forEach(t => {
                        t.classList.remove('text-blue-500', 'border-b-2', 'font-semibold');
                        t.classList.add('text-gray-600');
                    });

                    // Show the targeted content and activate the clicked tab
                    target.classList.remove('hidden');
                    tab.classList.remove('text-gray-600');
                    tab.classList.add('text-blue-500', 'border-b-2', 'border-blue-500',
                        'font-semibold');

                    // Reset filter to 'All' when switching tabs
                    document.querySelector('.tab-button[data-status="all"]').click();
                });
            });

            // Filter functionality
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const status = this.getAttribute('data-status');
                    const currentTab = document.querySelector('.tab-content:not(.hidden)');
                    const cards = currentTab.querySelectorAll('.project-card, .task-card');

                    cards.forEach(card => {
                        if (status === 'all' || card.getAttribute('data-status') ===
                            status) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Update active state of filter buttons
                    filterButtons.forEach(btn => {
                        btn.classList.remove('ring-2', 'ring-offset-2');
                    });
                    this.classList.add('ring-2', 'ring-offset-2');
                });
            });

            // Set 'Projects' as default active tab and 'All' as default active filter
            document.getElementById('default-tab').click();
        });




        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showToast('{{ session('success') }}', 'success');
            @endif

            @if (session('error'))
                showToast('{{ session('error') }}', 'error');
            @endif
        });

        function showToast(message, type) {
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'fixed top-4 right-4 flex flex-col space-y-4 z-50';
                document.body.appendChild(toastContainer);
            }

            const toast = document.createElement('div');
            toast.className = `toast px-6 py-3 rounded-lg shadow-lg text-white transition-opacity duration-500 ease-in-out ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            toast.innerText = message;
            toastContainer.appendChild(toast);
            setTimeout(() => {
                toast.classList.add('opacity-0');
                setTimeout(() => {
                    toast.remove();
                    if (toastContainer.children.length === 0) {
                        toastContainer.remove();
                    }
                }, 500);
            }, 5000);
        }
    </script>
@endsection
