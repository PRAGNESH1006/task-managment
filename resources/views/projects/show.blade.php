@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 sm:p-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-white">{{ $project->name }}</h1>
                        </div>
                        <div class="flex space-x-2">
                            @if (Auth::user()->id === $project->created_by || Auth::user()->role == 'admin')
                                <a href="{{ route('projects.edit', $project->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                                    Edit
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this project?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Project Details</h2>
                            <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                                <p><span class="font-medium text-gray-600">Project Id:</span> {{ $project->id }}</p>
                                <p><span class="font-medium text-gray-600">Project Description:</span>
                                    {{ $project->description }}</p>
                                <p><span class="font-medium text-gray-600">Start Date:</span>
                                    {{ $project->start_date->format('M d, Y') }}</p>
                                <p><span class="font-medium text-gray-600">End Date:</span>
                                    {{ $project->end_date->format('M d, Y') }}</p>
                                <p><span class="font-medium text-gray-600">Created At:</span>
                                    {{ $project->created_at->format('M d, Y') }}</p>
                                <p><span class="font-medium text-gray-600">Updated At:</span>
                                    {{ $project->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-900 mb-4">People</h2>
                            <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Client</h3>
                                    <p class="text-gray-600">{{ $project->client ? $project->client->name : 'N/A' }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Created By</h3>
                                    <p class="text-gray-600">{{ $project->creator->name }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Updated By</h3>
                                    <p class="text-gray-600">{{ $project->updater->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Tasks</h2>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if ($project->tasks->count() > 0)
                                <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                                    @foreach ($project->tasks as $task)
                                        <div class="bg-white p-4 rounded-lg shadow">
                                            <h3 class="font-semibold text-lg text-gray-900">{{ $task->name }}</h3>
                                            <p class="text-gray-600 mt-1">{{ $task->description }}</p>
                                            <div class="mt-2 flex justify-between items-center">
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $task->status === 'completed'
                                                    ? 'bg-green-100 text-green-800'
                                                    : ($task->status === 'in_progress'
                                                        ? 'bg-yellow-100 text-yellow-800'
                                                        : 'bg-red-100 text-red-800') }}">
                                                    {{ ucfirst($task->status) }}
                                                </span>
                                                <span class="text-sm text-gray-500">
                                                    {{ $task->assignedUser ? $task->assignedUser->name : 'Unassigned' }}
                                                </span>
                                            </div>
                                            <p class="text-xs text-gray-400 mt-2">Created:
                                                {{ $task->created_at->format('M d, Y') }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-600">No tasks assigned to this project yet.</p>
                            @endif
                        </div>
                    </div>
                    <div class="mt-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Project Employees</h2>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if ($project->users->count() > 0)
                                <div class="grid gap-4 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4">
                                    @foreach ($project->users as $user)
                                        <div class="bg-white p-3 rounded-lg shadow text-center">
                                            <div
                                                class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                                <span
                                                    class="text-2xl font-semibold text-blue-600">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                            </div>
                                            <p class="font-medium text-gray-900">{{ $user->name }}</p>
                                            <p class="text-sm text-gray-600">{{ ucfirst($user->role) }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-600">No employees assigned to this project yet.</p>
                            @endif
                        </div>
                    </div>
                    @if ($project->client && $project->client->clientDetail)
                        <div class="mt-8">
                            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Client Details</h2>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p><span class="font-medium text-gray-600">Company Name:</span>
                                    {{ $project->client->clientDetail->company_name }}</p>
                                <p class="mt-2"><span class="font-medium text-gray-600">Contact Number:</span>
                                    {{ $project->client->clientDetail->contact_number }}</p>
                            </div>
                        </div>
                    @endif
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
