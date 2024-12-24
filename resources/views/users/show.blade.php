@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-indigo-600 p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fstatic.vecteezy.com%2Fsystem%2Fresources%2Fpreviews%2F013%2F042%2F571%2Foriginal%2Fdefault-avatar-profile-icon-social-media-user-photo-in-flat-style-vector.jpg&f=1&nofb=1&ipt=f64c3e713045dcc6650963ccbba2fb3b785bb724a24649f2c00bdeb2c0f5149d&ipo=images"
                                alt="{{ $user->name }}"
                                class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">
                            <div class="text-center sm:text-left">
                                <h1 class="text-3xl font-bold text-white">{{ $user->name }}</h1>
                                <p class="text-purple-100">{{ $user->email }}</p>
                                <span
                                    class="inline-block mt-2 px-3 py-1 bg-purple-200 text-purple-800 rounded-full text-sm font-semibold">
                                    {{ ucfirst($user->role->value) }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 sm:mt-0 flex space-x-2">
                            @if (Auth::user()->role->value == 'admin')
                                <a href="{{ route($user->role->value.'.index') }}"
                                    class="inline-flex items-center px-4 py-2 h-10 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md transition duration-300">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Back
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 h-10 text-white font-bold py-2 px-4 rounded transition duration-300">
                                    Edit
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone.');">
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
                            <h2 class="text-2xl font-semibold text-gray-900 mb-4">User Details</h2>
                            <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                                <p><span class="font-medium text-gray-600">Created At:</span>
                                    {{ $user->created_at->format('M d, Y') }}</p>
                                <p><span class="font-medium text-gray-600">Updated At:</span>
                                    {{ $user->updated_at->format('M d, Y') }}</p>
                                <p><span class="font-medium text-gray-600">Created By:</span>
                                    {{ $user->createdBy->name ?? 'N/A' }}</p>
                                <p><span class="font-medium text-gray-600">Updated By:</span>
                                    {{ $user->updatedBy->name ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div>
                            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Assigned Projects</h2>
                            <div class="bg-gray-50 rounded-lg p-4">
                                @if ($user->projects->count() > 0)
                                    <ul class="space-y-2">
                                        @foreach ($user->projects as $project)
                                            <li
                                                class="bg-white p-3 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                                                <a href="{{ route('projects.show', $project->id) }}"
                                                    class="flex items-center justify-between text-gray-700 hover:text-indigo-600">
                                                    <span>{{ $project->name }}</span>
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-600">No projects assigned yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Additional Information</h2>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-600">No additional information available.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
