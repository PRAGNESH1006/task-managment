@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="p-6 sm:p-10">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">Edit Project</h1>
                        <a href="{{ route('projects.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md transition duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back
                        </a>
                    </div>

                    <form action="{{ route('projects.update', $project->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Project Name</label>
                                <div class="mt-1">
                                    <input type="text" name="name" id="name"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        value="{{ old('name', $project->name) }}">
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-1">
                                    <textarea name="description" id="description" rows="4"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description', $project->description) }}</textarea>
                                </div>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="client_id" class="block text-sm font-medium text-gray-700">Assign Client</label>
                                <div class="mt-1">
                                    <select name="client_id" id="client_id"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        <option value=""
                                            {{ old('client_id', $project->client_id) ? '' : 'selected' }}>No Client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}"
                                                {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>
                                                {{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('client_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-4 ">
                                <label class="block text-sm font-medium text-gray-700">Assign Employees</label>
                                <div class=" max-h-16 overflow-y-auto p-1">
                                    @foreach ($employees as $employee)
                                        <div class="flex items-center space-x-3">
                                            <input type="checkbox" name="employee_ids[]" value="{{ $employee->id }}"
                                                id="employee_{{ $employee->id }}"
                                                {{ in_array($employee->id, old('employee_ids', $project->users->pluck('id')->toArray())) ? 'checked' : '' }}
                                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                            <label for="employee_{{ $employee->id }}"
                                                class="text-sm text-gray-700">{{ $employee->name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                @error('employee_ids')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <div class="mt-1">
                                    <input type="date" name="start_date" id="start_date"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        value="{{ old('start_date', $project->start_date->toDateString()) }}">
                                </div>
                                @error('start_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                <div class="mt-1">
                                    <input type="date" name="end_date" id="end_date"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        value="{{ old('end_date', $project->end_date ? $project->end_date->toDateString() : '') }}">
                                </div>
                                @error('end_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Update Project
                            </button>
                        </div>
                    </form>
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
