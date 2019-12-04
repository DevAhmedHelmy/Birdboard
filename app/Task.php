<?php

namespace App;

 

class Task extends Model
{

    protected $touches = ['project'];
    protected $casts = [
        'completed' => 'boolean'
    ];
    protected static function boot()
    {
        parent::boot();

        static::created(function($task){
            $task->project->recordActivity('created_task');
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

    public function completed()
    {
        $this->update(['completed' => true]);
        $this->project->recordActivity('completed_task');
    }

    public function inCompleted()
    {
        $this->update(['completed' => true]);
        $this->project->recordActivity('completed_task');
    }

    
}
