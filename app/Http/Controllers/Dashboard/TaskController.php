<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $user_id = auth()->user()->id;
        $users = User::whereNotIn('role', ['superAdmin', 'teamLeader'])->latest()->get();
        if(auth()->user()->role != 'superAdmin'){
            $projects = Project::with('users')->where('project_user_id', $user_id)->latest()->get();
        }else{
            $projects = Project::with('users')->latest()->get();
        }
        $tasks = Task::with('projects.users', 'users')->get();
        return view('dashboard.task.list',compact('tasks','users','projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        try
        {   
            $input = $request->validated();
            Task::create($input);

            // Return respose back to page
            return response()->json(['success'=> true]);
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=> $e],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if ($task)
        {
            $response = [
                'result' => 1,
                'task' => $task,
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
    public function update(TaskRequest $request, Task $task)
    {
        try
        {
            $input = $request->validated();
            $task->update($input);

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
    public function destroy(Task $task)
    {
        try
        {   
            $task->delete();
            return response()->json(['success'=> true]);
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=> $e],500);
        }
    }
}
