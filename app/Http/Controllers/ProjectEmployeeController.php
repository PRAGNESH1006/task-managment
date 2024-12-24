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

}
