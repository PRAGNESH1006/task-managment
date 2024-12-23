    @extends('layouts.app')

    @section('content')
        <div class="container mx-auto p-4">
            <div class="mb-6 flex justify-between items-center">
                <h1 class="text-3xl font-semibold text-gray-900">All Clients</h1>

                <div class="flex space-x-4">
                    <a href="{{ route('users.create') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-600 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New Client
                    </a>
                    <a href="{{ route('client-details.create') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-600 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Client Details
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($clients as $client)
                    <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="flex justify-center mb-4">
                            <img src="{{ $client->profile_photo_url ?? 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fstatic.vecteezy.com%2Fsystem%2Fresources%2Fpreviews%2F013%2F042%2F571%2Foriginal%2Fdefault-avatar-profile-icon-social-media-user-photo-in-flat-style-vector.jpg&f=1&nofb=1&ipt=f64c3e713045dcc6650963ccbba2fb3b785bb724a24649f2c00bdeb2c0f5149d&ipo=images' }}"
                                alt="{{ $client->name }}" class="w-24 h-24 rounded-full object-cover">
                        </div>
                        <h2 class="text-xl font-semibold text-center">{{ $client->name }}</h2>
                        <p class="text-center text-gray-500">{{ $client->email }}</p>
                        <div class="mt-4 text-center">
                            <span
                                class="px-2 py-1 text-xs font-medium rounded-full {{ $client->role == 'admin' ? 'bg-red-500 text-white' : 'bg-blue-500 text-white' }}">
                                {{ ucfirst($client->role) }}
                            </span>
                        </div>

                        <div class="mt-4 flex justify-center space-x-4">
                            <a href="{{ route('users.show', $client->id) }}"
                                class="text-blue-600 hover:text-blue-800">View</a>
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
