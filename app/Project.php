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
    public function addTask($data)
    {
        $this->tasks()->create(['body' => $data]);
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
