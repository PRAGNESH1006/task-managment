<?php

namespace App\Http\Controllers;

use App\Repositories\ProjectEmployeeRepository;
use App\Http\Requests\StoreClientDetailRequest;
use App\Http\Requests\UpdateClientDetailRequest;
use App\Models\ProjectEmployee;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ProjectEmployeeController extends Controller
{
    protected ProjectEmployeeRepository $projectEmployeerepository;

    public function __construct(ProjectEmployeeRepository $projectEmployeerepository)
    {
        $this->projectEmployeerepository = $projectEmployeerepository;
    }

    public function index(): View
    {
        $projects = $this->projectEmployeerepository->getAll();
        return view('projects.index', compact('projects'));
    }

    public function show(ProjectEmployee $projectEmployee): View
    {
        return view('projects.show', compact('projectEmployee'));
    }

    public function create(): View
    {
        return view('projects.create');
    }

    public function edit(ProjectEmployee $projectEmployee): View
    {
        return view('projects.edit', compact('projectEmployee'));
    }

    public function store(StoreClientDetailRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->projectEmployeerepository->store($request->getInsertableFields());
            DB::commit();
            return redirect()->route(Auth::user()->role .'.dashboard')->with('success', 'Project Employee Added Successfully');
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->route('projects.create')->with('error', $e->getMessage());
        }
    }

    public function update(ProjectEmployee $projectEmployee, UpdateClientDetailRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->projectEmployeerepository->update($projectEmployee->id, $request->getInsertableFields());
            DB::commit();
            return redirect()->route(Auth::user()->role .'.dashboard')->with('success', 'Project Employee Updated Successfully');
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->route('projects.edit', $projectEmployee->id)->with('error', $e->getMessage());
        }
    }

    public function destroy(ProjectEmployee $projectEmployee): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->projectEmployeerepository->destroy($projectEmployee->id);
            DB::commit();
            return redirect()->route(Auth::user()->role .'.dashboard')->with('success', 'Project Employee Deleted Successfully');
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->route('projects.index')->with('error', $e->getMessage());
        }
    }
}
