<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $users = User::whereNotIn('role', ['superAdmin', 'normalEmployee'])->latest()->get();
        $projects = Project::with('users')->latest()->paginate(10);
        return view('dashboard.project.list',compact('projects','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        try
        {   
            $input = $request->validated();
            Project::create($input);

            // Return respose back to page
            return response()->json(['success'=> true]);
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=> $e],500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        if ($project)
        {
            $response = [
                'result' => 1,
                'project' => $project,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        try
        {
            $input = $request->validated();
            $project->update($input);

            return response()->json(['success'=> true]);
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=> $e],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try
        {   
            $project->delete();
            return response()->json(['success'=> true]);
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=> $e],500);
        }
    }
}
