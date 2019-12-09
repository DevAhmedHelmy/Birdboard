<?php

namespace App;

 

class Task extends Model
{
    // use RecordsActivity;
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
        $this->recordActivity('completed_task');
    }

    public function incompleted()
    {
        $this->update(['completed' => false]);
        $this->recordActivity('incompleted_task');
        
    }

    public function recordActivity($description)
    {
        $this->activity()->create(['description' => $description, 'project_id' => $this->project_id]);
    }

    public function activity()
    {
        return $this->morphMany('App\Activity', 'subject')->latest();
    }

    
}
