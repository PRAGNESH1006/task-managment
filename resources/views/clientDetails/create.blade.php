@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 w-1/3">
        <div class="mb-6 ">
            <h1 class="text-3xl font-semibold text-gray-900">Create Client</h1>
            <a href="{{ url()->previous() }}">Back</a>
        </div>

        <form action="{{ route('client-details.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="flex flex-col">
                    <label for="user_id" class="text-sm font-medium text-gray-700">Select User</label>
                    <select name="user_id" id="user_id" class="mt-1 p-2 border border-gray-300 rounded-md" required>
                        <option value="" disabled selected>Select a user</option>
                        @foreach ($clients as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="company_name" class="text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" name="company_name" id="company_name"
                        class="mt-1 p-2 border border-gray-300 rounded-md" required value="{{ old('company_name') }}">
                    @error('company_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="contact_number" class="text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="text" name="contact_number" id="contact_number"
                        class="mt-1 p-2 border border-gray-300 rounded-md" required value="{{ old('contact_number') }}">
                    @error('contact_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit"
                        class=" inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 ease-in-out">
                        Save Client
                    </button>
                </div>
            </div>
        </form>
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
