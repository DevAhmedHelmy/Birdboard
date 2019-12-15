<?php

namespace App;

use App\Activity;
 

class Project extends Model
{
    use RecordsActivity;

    

    public function path()
    {
        return "/projects/$this->id";
    }

    public function owner()
    {
        return $this->belongsTo('App\User');
    }
    
    

   
    // to create tasks
    public function addTask($body)
    {
        $task = $this->tasks()->create(['body'=>$body]);
        $task->recordActivity('created_task');
        return $task;
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function invite(User $user)
    {
        return $this->members()->attach($user);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members');
    }
    


    



    
}
