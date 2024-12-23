@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen py-4">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <h1 class="text-3xl font-semibold text-gray-900">Tasks</h1>
            </div>

            @if ($tasks->isEmpty())
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <p class="text-gray-600 text-lg">No tasks found. Start by creating a new task!</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($tasks as $task)
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
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
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
