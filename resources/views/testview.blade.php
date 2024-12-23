@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-6 bg-gradient-to-r from-blue-50 to-blue-100">

        <!-- Title Section -->
        <h1 class="text-4xl font-semibold text-center mb-12 text-gray-900">Data Overview</h1>

        <!-- Users Section -->
        <div class="mb-12">
            <h2 class="text-3xl font-semibold text-gray-900 mb-6">Users</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($users as $user)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 transform hover:scale-105 hover:shadow-2xl">
                        <div class="p-6">
                            <div class="text-center mb-6">
                                <h3 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $user->email }}</p>
                            </div>
                            <div class="mb-4 text-gray-700">
                                <p><strong class="text-blue-600">Role:</strong> {{ $user->role }}</p>
                                <p><strong class="text-blue-600">Client:</strong>
                                    {{ $user->clientDetail ? $user->clientDetail->company_name : 'No Client Details' }}
                                </p>
                                @if ($user->clientDetail)
                                    <p><strong class="text-blue-600">Contact Number:</strong>
                                        {{ $user->clientDetail->contact_number }}
                                    </p>
                                @endif
                            </div>
                            <div class="mt-4">
                                <p class="text-blue-600 font-medium">Projects:</p>
                                <ul class="list-disc pl-5">
                                    @foreach ($user->projects as $project)
                                        <li>{{ $project->name }} (ID: {{ $project->id }})</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-4">
                                <p class="text-blue-600 font-medium">Client Projects:</p>
                                <ul class="list-disc pl-5">
                                    @foreach ($user->clientProjects as $project)
                                        <li>{{ $project->name }} (ID: {{ $project->id }})</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-4">
                                <p class="text-blue-600 font-medium">Created Projects:</p>
                                <ul class="list-disc pl-5">
                                    @foreach ($user->createdProjects as $project)
                                        <li>{{ $project->name }} (ID: {{ $project->id }})</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-4">
                                <p class="text-blue-600 font-medium">Updated Projects:</p>
                                <ul class="list-disc pl-5">
                                    @foreach ($user->updatedProjects as $project)
                                        <li>{{ $project->name }} (ID: {{ $project->id }})</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Projects Section -->
        <div class="mb-12">
            <h2 class="text-3xl font-semibold text-gray-900 mb-6">Projects</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($projects as $project)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 transform hover:scale-105 hover:shadow-2xl">
                        <div class="p-6">
                            <div class="text-center mb-6">
                                <h3 class="text-2xl font-semibold text-gray-800">{{ $project->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $project->description }}</p>
                            </div>
                            <div class="mb-4 text-gray-700">
                                <p><strong class="text-blue-600">Client:</strong>
                                    {{ $project->client ? $project->client->name : 'None' }}
                                </p>
                                @if ($project->client)
                                    <p><strong class="text-blue-600">Client Email:</strong> {{ $project->client->email }}
                                    </p>
                                @endif
                                <p><strong class="text-blue-600">Creator:</strong>
                                    {{ $project->creator ? $project->creator->name : 'None' }}
                                </p>
                                @if ($project->creator)
                                    <p><strong class="text-blue-600">Creator Email:</strong> {{ $project->creator->email }}
                                    </p>
                                @endif
                                <p><strong class="text-blue-600">Updater:</strong>
                                    {{ $project->updater ? $project->updater->name : 'None' }}
                                </p>
                                @if ($project->updater)
                                    <p><strong class="text-blue-600">Updater Email:</strong> {{ $project->updater->email }}
                                    </p>
                                @endif
                            </div>
                            <div class="mt-4">
                                <p class="text-blue-600 font-medium">Tasks:</p>
                                <ul class="list-disc pl-5">
                                    @foreach ($project->tasks as $task)
                                        <li>{{ $task->name }} (ID: {{ $task->id }})</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-4">
                                <p class="text-blue-600 font-medium">Users:</p>
                                <ul class="list-disc pl-5">
                                    @foreach ($project->users as $user)
                                        <li>{{ $user->name }} (Email: {{ $user->email }})</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Tasks Section -->
        <div>
            <h2 class="text-3xl font-semibold text-gray-900 mb-6">Tasks</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($tasks as $task)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 transform hover:scale-105 hover:shadow-2xl">
                        <div class="p-6">
                            <div class="text-center mb-6">
                                <h3 class="text-2xl font-semibold text-gray-800">{{ $task->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $task->description }}</p>
                            </div>
                            <div class="mb-4 text-gray-700">
                                <p><strong class="text-blue-600">Status:</strong>
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full 
                                    @if ($task->status == 'completed') bg-green-100 text-green-800
                                    @elseif($task->status == 'in-progress') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($task->status) }}</span>
                                </p>
                                <p><strong class="text-blue-600">Assigned To:</strong>
                                    {{ $task->assignedUser ? $task->assignedUser->name : 'None' }}
                                </p>
                                @if ($task->assignedUser)
                                    <p><strong class="text-blue-600">Assigned User Email:</strong>
                                        {{ $task->assignedUser->email }}
                                    </p>
                                @endif
                            </div>
                            <div>
                                <p><strong class="text-blue-600">Project:</strong>
                                    {{ $task->project ? $task->project->name : 'None' }}
                                </p>
                                @if ($task->project)
                                    <p><strong class="text-blue-600">Project Description:</strong>
                                        {{ $task->project->description }}
                                    </p>
                                @endif
                                <p><strong class="text-blue-600">Creator:</strong>
                                    {{ $task->creator ? $task->creator->name : 'None' }}
                                </p>
                                @if ($task->creator)
                                    <p><strong class="text-blue-600">Creator Email:</strong>
                                        {{ $task->creator->email }}
                                    </p>
                                @endif
                                <p><strong class="text-blue-600">Updater:</strong>
                                    {{ $task->updater ? $task->updater->name : 'None' }}
                                </p>
                                @if ($task->updater)
                                    <p><strong class="text-blue-600">Updater Email:</strong>
                                        {{ $task->updater->email }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
