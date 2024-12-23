@extends('layouts.app')

@section('content')
        <div class="bg-gray-100 min-h-screen py-2">
                <div class="p-6 sm:p-10">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">Your Tasks</h1>
                        <a href="{{ route('employee.dashboard') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-600 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($tasks as $task)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $task->name }}</h2>
                                <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($task->description, 100) }}</p>
                                <div class="flex justify-between items-center">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $task->status === 'completed'
                                        ? 'bg-green-100 text-green-800'
                                        : ($task->status === 'in_progress'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        Due: {{ $task->end_date ? $task->end_date->format('M d, Y') : 'Not set' }}
                                    </span>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-6 py-4">
                                <div class="flex justify-between items-center">
                                    <a href="{{ route('tasks.show', $task->id) }}"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium transition duration-300">
                                        View Details
                                    </a>
                                    <p>{{$task->assignedUser->name}}</p>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                            class="text-yellow-600 hover:text-yellow-800 transition duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="col-span-full text-center">
                                <p class="text-gray-600">No tasks assigned</p>
                            </div>
                        @endforelse
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
