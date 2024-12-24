@extends('layouts.app')

@section('styles')
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .animate-fade-out {
            animation: fadeOut 0.5s ease-in forwards;
        }


        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>
@endsection

@section('content')
    <div class="bg-white p-6 sm:p-10">
        <div class="flex flex-col sm:flex-row items-center">
            <img class="h-32 w-32 rounded-full object-cover border-4 border-blue-500 shadow-lg"
                src="{{ asset('storage/' . $user->profile_image) ?? asset('images/default-avatar.png') }}"
                alt="{{ $user->name }}">
            <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left">
                <h1 class="text-3xl font-bold text-blue-500">{{ $user->name }}</h1>
                <p class="text-xl text-blue-500">{{ $user->email }}</p>
                <p class="text-xl text-blue-500">{{ $user->number }}</p>
                <button onclick="openUpdateProfileModal()"
                    class="mt-4 px-4 py-2 bg-gray-200 text-blue-600 rounded-md hover:bg-blue-50 transition duration-300 ease-in-out">
                    Update Profile
                </button>
            </div>
        </div>

    </div>


    <div id="updateProfileModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-md mx-auto">
            <h3 class="text-2xl font-bold mb-4">Update Profile</h3>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeUpdateProfileModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const openUpdateProfileModal = () => {
            const updateProfileModal = document.getElementById('updateProfileModal')
            updateProfileModal.classList.remove('hidden')
        }
        const closeUpdateProfileModal = () => {
            const closeUpdateProfileModal = document.getElementById('updateProfileModal')
            closeUpdateProfileModal.classList.add('hidden')
        }

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
