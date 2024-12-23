<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\TaskRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class EmployeeDashboardController extends Controller
{
    protected UserRepository $userRepository;
    protected TaskRepository $taskRepository;
    protected ProjectRepository $projectRepository;

    public function __construct(UserRepository $userRepository, TaskRepository $taskRepository, ProjectRepository $projectRepository)
    {
        $this->userRepository = $userRepository;
        $this->taskRepository = $taskRepository;
        $this->projectRepository = $projectRepository;
    }

    public function show(): View
    {
        $employeeId = Auth::user()->id;

        $tasks = $this->taskRepository->getTasksByEmployee($employeeId);
        $projects = $tasks->load('project');
        $tasksCount = $tasks->count();
        $projectsCount = $this->taskRepository->getProjectsByEmployee($employeeId)->count();

        return view('employee.dashboard', compact('tasks', 'tasksCount', 'projectsCount', 'projects'));
    }

    public function index(): View
    {
        $employees = $this->userRepository->getAllUserByRole('employee');
        return view('employee.index', compact('employees'));
    }

    public function tasks(User $user): View
    {
        $tasks = $this->taskRepository->getTasksByEmployee($user->id);
        return view('employee.tasks', compact('tasks'));
    }

    public function projects(User $user): View
    {
        $projects = $this->taskRepository->getProjectsByEmployee($user->id);
        return view('employee.projects', compact('projects'));
    }
}
