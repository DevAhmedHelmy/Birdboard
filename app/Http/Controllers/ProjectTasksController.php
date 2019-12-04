<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        $this->authorize('update',$project);
        $attributes = request()->validate([
            'body' => 'required', 
            ]);

        $project->addTask(request('body'));
        
        return redirect($project->path());
    }

    public function update(Task $task)
    {
        $this->authorize('update',$task->project);
        $task->update(['body' => request('body')]);
        if(request()->has('completed'))
        {
            $this->completed();
        }
        
        return redirect($task->project->path());
    }

}
