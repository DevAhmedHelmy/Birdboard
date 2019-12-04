<?php

namespace App;

 

class Task extends Model
{

    protected $touches = ['project'];

    protected static function boot()
    {
        parent::boot();

        static::created(function($task){
            $task->project->recordActivity('created_task');
        });

        static::updated(function($task){
            if(! $task->completed) return;
            $task->project->recordActivity('completed_task');
           
        });
    }

    public function path()
    {
        return '/tasks/' . $this->id;
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    
}
