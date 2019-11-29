<?php

namespace App;
 

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
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
    
    // to create tasks
    public function addTask($body)
    {
        $this->tasks()->create(compact('body'));
    }



    
}
