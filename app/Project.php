<?php

namespace App;

use App\Activity;
 

class Project extends Model
{

    public $old = [];

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
         
        $this->activity()->create([
            'description' => $description, 
            'changes' => $this->getActivityChanges($description)
            ]);
    }

    protected function getActivityChanges($description)
    {
        if($description === 'updated')
        {
            return[
                'before' => array_except(array_diff($this->old , $this->getAttributes()), 'updated_at'),
                    'after' => array_except($this->getChanges(), 'updated_at')
            ];
        }

        
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

    public function activity()
    {
        return $this->hasMany('App\Activity')->latest();
    }


    



    
}
