<?php

namespace App;

 

class Task extends Model
{

    protected $touches = ['project'];
    public function path()
    {
        return '/tasks/' . $this->id;
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    
}
