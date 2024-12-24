@extends('layouts.app')

@section('content')
    <div class="container py-8">
        <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg p-8">
            <div class="flex justify-between ">
                <h1 class="text-4xl font-semibold  text-indigo-600 mb-6">{{ $task->project->name }} <span
                        class=" text-sm">(Update Task)</span></h1>
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md transition duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back
                </a>
            </div>

            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div class="form-floating">
                        <label for="name" class="text-sm text-gray-700">Task Name</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full p-3 rounded-lg border-gray-300  @error('name') border-red-500 @enderror"
                            value="{{ old('name', $task->name) }}" required>
                        @error('name')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <label for="description" class="text-sm text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-1 block w-full p-3 rounded-lg border-gray-300  @error('description') border-red-500 @enderror"
                            placeholder="Describe the task">{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mt-6">

                    <div>
                        <label for="status" class="text-sm text-gray-700">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full p-3 rounded-lg border-gray-300  @error('status') border-red-500 @enderror">
                            <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="in_progress"
                                {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>
                                Completed</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="assigned_to" class="text-sm text-gray-700">Assigned To</label>
                        <input type="text" name="assigned_to" id="assigned_to"
                            class="mt-1 block w-full p-3 rounded-lg border-gray-300 @error('assigned_to') border-red-500 @enderror"
                            value="{{ $employees->firstWhere('id', old('assigned_to', $task->assigned_to))->name ?? 'No employee assigned' }}"
                            readonly>


                        @error('assigned_to')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mt-6">

                    <div>
                        <label for="start_date" class="text-sm text-gray-700">Start Date</label>
                        <input type="date" name="start_date" id="start_date"
                            class="mt-1 block w-full p-3 rounded-lg border-gray-300  @error('start_date') border-red-500 @enderror"
                            value="{{ old('start_date', $task->start_date->toDateString()) }}" required>
                        @error('start_date')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_date" class="text-sm text-gray-700">End Date</label>
                        <input type="date" name="end_date" id="end_date"
                            class="mt-1 block w-full p-3 rounded-lg border-gray-300  @error('end_date') border-red-500 @enderror"
                            value="{{ old('end_date', $task->end_date ? $task->end_date->toDateString() : '') }}">
                        @error('end_date')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="text-center mt-8">
                    <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-full text-lg font-semibold">
                        Update Task
                    </button>
                </div>
            </form>
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
