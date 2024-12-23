<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectEmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // Retrieve all projects and employees
        $projects = Project::all();
        $employees = User::where('role', 'employee')->get();

        // Ensure there are enough employees for each project
        if ($projects->count() > 0 && $employees->count() >= 3) {
            foreach ($projects as $project) {
                // Randomly select 3 employees for each project
                $assignedEmployees = $employees->random(3);

                // Attach each selected employee to the project
                foreach ($assignedEmployees as $employee) {
                    $project->users()->attach($employee->id);
                }
            }
        }
    }
}
