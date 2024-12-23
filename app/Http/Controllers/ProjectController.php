<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ProjectController extends Controller
{
    protected ProjectRepository $projectRepository;
    protected UserRepository $userRepository;

    public function __construct(ProjectRepository $projectRepository, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->projectRepository = $projectRepository;
    }

    public function index(): View
    {
        $projects = $this->projectRepository->getAll();
        return view('projects.index', compact('projects'));
    }

    public function show(Project $project): View
    {
        return view('projects.show', compact('project'));
    }

    public function create(): View
    {
        $clients = $this->userRepository->getUsersWithNameId('client');
        $employees = $this->userRepository->getUsersWithNameId('employee');
        return view('projects.create', compact('clients', 'employees'));
    }

    public function edit(Project $project): View
    {
        $clients = $this->userRepository->getUsersWithNameId('client');
        $employees = $this->userRepository->getUsersWithNameId('employee');
        return view('projects.edit', compact('project', 'clients', 'employees'));
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $project = $this->projectRepository->store($request->getInsertableFields());

            if ($request->has('employee_id') && !empty($request->employee_id)) {
                $project->users()->attach($request->employee_id);
            }

            DB::commit();
            return redirect()->route(Auth::user()->role .'.dashboard')->with('success', 'Project Added Successfully');
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->route('projects.create')->with('error', $e->getMessage());
        }
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->projectRepository->update($project->id, $request->getInsertableFields());
            DB::commit();
            return redirect()->route(Auth::user()->role .'.dashboard')->with('success', 'Project Updated Successfully');
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->route('projects.edit', $project->id)->with('error', $e->getMessage());
        }
    }

    public function destroy(Project $project): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->projectRepository->destroy($project->id);
            DB::commit();
            return redirect()->route(Auth::user()->role .'.dashboard')->with('success', 'Project Deleted Successfully');
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->route('projects.index')->with('error', $e->getMessage());
        }
    }
}
