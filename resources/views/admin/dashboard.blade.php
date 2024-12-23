@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8"><div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">Welcome, {{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden ">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">Projects</h2>
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-gray-700">{{ $projectCount }}</p>
                        <p class="text-gray-600">Total Projects</p>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('projects.create') }}"
                                class="text-sm text-blue-500 hover:underline flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create
                            </a>
                            <a href="{{ route('projects.index') }}"
                                class="text-sm text-blue-500 hover:underline flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"></path>
                                </svg>
                                Show All
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden ">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">Tasks</h2>
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-gray-700">{{ $taskCount }}</p>
                        <p class="text-gray-600">Total Tasks</p>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('tasks.create') }}"
                                class="text-sm text-green-500 hover:underline flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create
                            </a>
                            <a href="{{ route('tasks.index') }}"
                                class="text-sm text-green-500 hover:underline flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"></path>
                                </svg>
                                Show All
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden ">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">Clients</h2>
                            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-gray-700">{{ $clientCount }}</p>
                        <p class="text-gray-600">Total Clients</p>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('users.create') }}"
                                class="text-sm text-purple-500 hover:underline flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create
                            </a>
                            <a href="{{ route('client.index') }}"
                                class="text-sm text-purple-500 hover:underline flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"></path>
                                </svg>
                                Show All
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden ">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">Employees</h2>
                            <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-gray-700">{{ $employeeCount }}</p>
                        <p class="text-gray-600">Total Employees</p>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('users.create') }}"
                                class="text-sm text-yellow-500 hover:underline flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create
                            </a>
                            <a href="{{ route('employee.index') }}"
                                class="text-sm text-yellow-500 hover:underline flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"></path>
                                </svg>
                                Show All
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Projects -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Projects</h2>
                        <div class="space-y-4 h-64 overflow-y-auto">
                            @foreach ($recentProjects as $project)
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

                <!-- Recent Tasks -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Tasks</h2>
                        <div class="space-y-4 h-64 overflow-y-auto">
                            @foreach ($recentTasks as $task)
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
                <!-- Recent Clients -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Clients</h2>
                        <div class="space-y-4 h-64 overflow-y-auto">
                            @foreach ($recentClients as $client)
                                <div
                                    class="bg-gray-50 rounded-lg p-4 flex flex-col hover:bg-gray-100 transition duration-300">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $client->name }}</h3>
                                        <a href="{{ route('users.show', [$client->id]) }}"
                                            class="text-xs text-blue-500 hover:text-blue-700 transition duration-200"
                                            aria-label="View details of client {{ $client->name }}">
                                            Details
                                        </a>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-600">
                                        <p><strong class="text-gray-700">Email:</strong> <span
                                                class="text-gray-800">{{ $client->email }}</span></p>
                                        <p><strong class="text-gray-700">Company:</strong> <span
                                                class="text-gray-800">{{ $client->clientDetail->company_name ?? 'N/A' }}</span>
                                        </p>
                                        <p><strong class="text-gray-700">Contact:</strong> <span
                                                class="text-gray-800">{{ $client->clientDetail->contact_number ?? 'N/A' }}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Recent Employees -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Employees</h2>
                        <div class="space-y-4 h-64 overflow-y-auto">
                            @foreach ($recentEmployees as $employee)
                                <div
                                    class="bg-gray-50 rounded-lg p-4 flex flex-col hover:bg-gray-100 transition duration-300">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $employee->name }}</h3>
                                        <a href="{{ route('users.show', [$employee->id]) }}"
                                            class="text-xs text-blue-500 hover:text-blue-700 transition duration-200"
                                            aria-label="View details of employee {{ $employee->name }}">
                                            Details
                                        </a>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-600">
                                        <p><strong class="text-gray-700">Email:</strong> <span
                                                class="text-gray-800">{{ $employee->email }}</span></p>
                                        <p><strong class="text-gray-700">Role:</strong> <span
                                                class="text-gray-800">{{ ucfirst($employee->role) }}</span></p>
                                        <p><strong class="text-gray-700">Joined:</strong> <span
                                                class="text-gray-800">{{ $employee->created_at->format('M d, Y') }}</span>
                                        </p>
                                    </div>
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
