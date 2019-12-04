<?php

namespace App;

use App\Activity;
 

class Project extends Model
{
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
        Activity::create(['project_id' => $this->id, 'description' => 'created_task']);
        return $task;
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function activity()
    {
        return $this->hasMany('App\Activity');
    }


    public function recordActivity($type)
    {
        Activity::create(['project_id'=>$this->id, 'description' => $type]);
    }



    
}
