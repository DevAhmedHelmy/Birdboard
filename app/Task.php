<?php

namespace App;

 

class Task extends Model
{
    public function path()
    {
        return $this->project->path() . '\/tasks/' . $this->id;
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    
}
