<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClientDashboardController extends Controller
{
    protected UserRepository $userRepository;
    protected ProjectRepository $projectRepository;

    public function __construct(UserRepository $userRepository, ProjectRepository $projectRepository)
    {
        $this->userRepository = $userRepository;
        $this->projectRepository = $projectRepository;
    }

    public function show(): View
    {
        $projects = $this->projectRepository->getProjectsByClient(Auth::user()->id);
        $tasks = $this->projectRepository->getTasksByClient(Auth::user()->id);
        return view('client.dashboard', compact('projects', 'tasks'));
    }

    public function index(): View
    {
        $clients = $this->userRepository->getAllUserByRole('client');
        return view('client.index', compact('clients'));
    }

    public function projects(User $user): View
    {
        $projects = $this->projectRepository->getProjectsByClient($user->id);
        return view('client.projects', compact('projects'));
    }

    public function tasks(User $user): View
    {
        $tasks = $this->projectRepository->getTasksByClient($user->id);
        return view('client.tasks', compact('tasks'));
    }
}
