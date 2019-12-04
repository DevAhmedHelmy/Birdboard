<?php

namespace App;

 

class Task extends Model
{

    protected $touches = ['project'];
    protected $casts = [
        'completed' => 'boolean'
    ];
       

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

    public function incompleted()
    {
        $this->update(['completed' => false]);
        $this->project->recordActivity('incompleted_task');
        
    }

    public function deleteTask()
    {
        $this->delete();
        $this->project->recordActivity('deleting_task');
        
    }

    
}
