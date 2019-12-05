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
    
    public function recordActivity($description)
    {
        $this->activity()->create(compact('description'));
    }
    // to create tasks
    public function addTask($body)
    {
        $task = $this->tasks()->create(['body'=>$body]);
        $this->activity()->create(['description' => 'created_task']);
        return $task;
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function activity()
    {
        return $this->hasMany('App\Activity')->latest();
    }


    



    
}
