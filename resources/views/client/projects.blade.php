@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-900">All Projects</h1>
            <a href="{{ route('projects.create') }}"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-600 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Create New Project
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($projects as $project)
                <div class="bg-white overflow-hidden shadow-lg rounded-lg ">
                    <div class="relative pb-2/3">
                        <img class="absolute h-full w-full object-cover" src="{{ asset('images/project-thumbnail.jpg') }}"
                            alt="{{ $project->name }} Thumbnail">
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2 hover:text-indigo-600 transition duration-200">
                            {{ $project->name }}</h2>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($project->description, 100) }}</p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Created {{ $project->created_at->diffForHumans() }}
                        </div>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('projects.show', $project->id) }}"
                                class="text-indigo-600 hover:text-indigo-900 font-medium transition duration-200">View
                                Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
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
