@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 sm:p-8">
                    <h1 class="text-3xl font-bold text-white">Task Details</h1>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Task Information</h2>
                            <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Name</h3>
                                    <p class="text-gray-600">{{ $task->name }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Status</h3>
                                    <span
                                        class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                                    {{ $task->status === 'completed'
                                        ? 'bg-green-100 text-green-800'
                                        : ($task->status === 'in_progress'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </div>

                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Assigned To</h3>
                                    <p class="text-gray-600">
                                        @if ($task->assignedUser)
                                            {{ $task->assignedUser->name }}
                                        @else
                                            Unassigned
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Additional Details</h2>
                            <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                                <p><span class="font-medium text-gray-600">Description:</span>
                                    {{ $task->description ?? 'N/A' }}</p>
                                <p><span class="font-medium text-gray-600">Project:</span>
                                    @if ($task->project)
                                        <a href="{{ route('projects.show', $task->project->id) }}"
                                            class="text-blue-600 hover:text-blue-800">
                                            {{ $task->project->name }}
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </p>
                                <p><span class="font-medium text-gray-600">Start Date:</span>
                                    {{ $task->start_date ? $task->start_date->format('M d, Y') : 'Not set' }}</p>
                                <p><span class="font-medium text-gray-600">End Date:</span>
                                    {{ $task->end_date ? $task->end_date->format('M d, Y') : 'Not set' }}</p>
                                <p><span class="font-medium text-gray-600">Created At:</span>
                                    {{ $task->created_at->format('M d, Y H:i') }}</p>
                                <p><span class="font-medium text-gray-600">Updated At:</span>
                                    {{ $task->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-between items-center">
                        <a href="{{ route('tasks.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md transition duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back
                        </a>


                        <div class="space-x-2">
                            @if (Auth::user()->role->value == 'employee' || Auth::user()->role->value == 'admin')
                                <a href="{{ route('tasks.edit', $task->id) }}"
                                    class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md transition duration-300">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit Task
                                </a>

                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition duration-300"
                                        onclick="return confirm('Are you sure you want to delete this task?')">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Delete Task
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

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
