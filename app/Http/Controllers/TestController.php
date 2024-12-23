<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\View\View;

class TestController extends Controller
{
    public function index(): View
    {
        $users = User::with(['projects', 'assignedTasks', 'createdTask', 'updatedTask', 'clientDetail'])->get();
        $projects = Project::with(['tasks', 'users', 'client'])->get();
        $tasks = Task::with(['project', 'assignedUser', 'creator', 'updater'])->get();

        return view('testview', compact('users', 'projects', 'tasks'));
    }
}
