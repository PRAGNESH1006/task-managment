@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-gray-900">Employee Dashboard</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">Welcome, {{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Access Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">My Tasks</h2>
                            <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-4">View and manage your assigned tasks.</p>
                        <a href="{{ route('employee.tasks', ['user' => Auth::user()->id]) }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-800 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            View All Tasks
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden">
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
                        <p class="text-gray-600 mb-4">View projects you're involved in.</p>
                        <a href="{{ route('employee.projects', ['user' => Auth::user()->id]) }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                            View All Projects
                        </a>
                    </div>
                </div>
            </div>

            <!-- Task Overview Section -->
            <div class="bg-white rounded-lg overflow-hidden mb-8">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Task Overview</h2>

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

                    <!-- Tasks Content -->
                    <div id="tasks"
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 overflow-y-auto max-h-96">
                        @foreach ($tasks as $task)
                            <div class="task-card bg-gradient-to-br from-white to-gray-50 rounded-lg overflow-hidden border border-gray-200 relative"
                                data-status="{{ $task->status }}">
                                <div class="absolute top-1 right-2">
                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                        class="text-blue-500 hover:text-blue-700 font-semibold">Update</a>
                                </div>

                                <div class="p-6">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $task->name }}</h3>
                                    <p class="text-sm text-gray-500 mb-4">{{ Str::limit($task->description, 100) }}</p>
                                    <p class="mb-2"><strong>Project:</strong> {{ $task->project->name }}</p>
                                    <p class="mb-2"><strong>Status:</strong>
                                        <span
                                            class="capitalize text-{{ $task->status === 'completed' ? 'green' : 'yellow' }}-800 rounded-full bg-{{ $task->status === 'completed' ? 'green' : 'yellow' }}-100 p-2 text-xs">
                                            {{ str_replace('_', ' ', $task->status) }}
                                        </span>
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

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Activity</h2>
                    <ul class="divide-y divide-gray-200">
                        @foreach ($tasks as $task)
                            <li class="py-4">
                                <div class="flex space-x-3">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div class="flex-1 space-y-1">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-sm font-medium text-gray-900">Task Updated: {{ $task['name'] }}
                                            </h3>
                                            <p class="text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($task['updated_at'])->diffForHumans() }}</p>
                                        </div>
                                        <p class="text-sm text-gray-500">Status changed to
                                            {{ str_replace('_', ' ', $task['status']) }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sessionMessage = @json(session('message'));

            if (sessionMessage) {
                const {
                    status,
                    description
                } = sessionMessage;
                showToast(description, status);
            }
        });

        function showToast(message, type) {
            // Ensure toast container exists
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'fixed top-4 right-4 flex flex-col space-y-4 z-50';
                document.body.appendChild(toastContainer);
            }

            // Create toast element
            const toast = document.createElement('div');
            toast.className = `toast px-6 py-3 rounded-lg shadow-lg text-white transition-all duration-500 ease-in-out transform ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    }`;
            toast.innerText = message;

            // Append to container
            toastContainer.appendChild(toast);

            // Set timer for automatic dismissal
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-x-2');
                setTimeout(() => {
                    toast.remove();
                    if (!toastContainer.children.length) {
                        toastContainer.remove();
                    }
                }, 500); // Wait for fade-out transition to complete
            }, 5000); // Toast visible duration
        }
    </script>
@endsection
