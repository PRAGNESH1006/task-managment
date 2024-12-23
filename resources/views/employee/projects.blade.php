@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-900">All Projects</h1>
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
                            @if(Auth::user()->role === 'admin')
                            <div class="flex space-x-2">
                                <a href="{{ route('projects.edit', $project->id) }}"
                                    class="text-yellow-600 hover:text-yellow-900 transition duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition duration-200"
                                        onclick="return confirm('Are you sure you want to delete this project?')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
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
