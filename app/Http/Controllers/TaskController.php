<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProjectRepository;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    protected TaskRepository $taskRepository;
    protected UserRepository $userRepository;
    protected ProjectRepository $projectRepository;

    public function __construct(TaskRepository $taskRepository, UserRepository $userRepository, ProjectRepository $projectRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
        $this->projectRepository = $projectRepository;
    }

    public function index(): View
    {
        $tasks = $this->taskRepository->getAll();
        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    public function create(): View
    {
        $employees = $this->userRepository->getAllUserByRole('employee');
        $projects = $this->projectRepository->getAll();
        return view('tasks.create', compact('employees', 'projects'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->taskRepository->store($request->getInsertableFields());
            DB::commit();
            return redirect()->route(Auth::user()->role .'.dashboard')->with('success', 'Task Added Successfully');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Task store failed: ' . $e->getMessage());
            return redirect()->route('tasks.create')->with('error', 'Failed to add task');
        }
    }

    public function edit(Task $task): View
    {
        $task = $this->taskRepository->getById($task->id);
        $employees = $this->userRepository->getAllUserByRole('employee');
        return view('tasks.edit', compact('task', 'employees'));
    }

    public function update(Task $task, UpdateTaskRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->taskRepository->update($task->id, $request->getUpdateableFields($task->project_id));
            DB::commit();
            return redirect()->route(Auth::user()->role .'.dashboard')->with('success', 'Task Updated Successfully');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Task update failed: ' . $e->getMessage());
            return redirect()->route('tasks.edit', $task->id)->with('error', 'Failed to update task');
        }
    }

    public function destroy(Task $task): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->taskRepository->destroy($task->id);
            DB::commit();
            return redirect()->route(Auth::user()->role .'.dashboard')->with('success', 'Task Deleted Successfully');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Task delete failed: ' . $e->getMessage());
            return redirect()->route('tasks.index')->with('error', 'Failed to delete task');
        }
    }
}