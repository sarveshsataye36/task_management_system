<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{User, Project, Task};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index() {

        $user_id = auth()->user()->id;

        $userCount = User::whereNotIn('role', ['superAdmin'])->count();
        if(auth()->user()->role != 'superAdmin'){
            $projectCount = Project::where('project_user_id',$user_id)->count();
            $taskCompleteCount = Task::where('task_status', 'complete')->where('task_user_id',$user_id)->count();
            $taskInCompleteCount = Task::where('task_status', 'incomplete')->where('task_user_id',$user_id)->count();
        }else{
            $projectCount = Project::count();
            $taskCompleteCount = Task::where('task_status', 'complete')->count();
            $taskInCompleteCount = Task::where('task_status', 'incomplete')->count();
        }
        return view('dashboard.index', compact('taskCompleteCount','taskInCompleteCount','userCount','projectCount'));
    }
}
