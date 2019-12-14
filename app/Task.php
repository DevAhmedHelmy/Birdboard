<?php

namespace App;

 

class Task extends Model
{
    use RecordsActivity;
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

    

    protected function getActivityChanges()
    {
        if($this->wasChanged())
        {
            return[
                'before' => array_except(array_diff($this->old , $this->getAttributes()), 'updated_at'),
                'after' => array_except($this->getChanges(), 'updated_at')
            ];
        }

        
    }

    public function activity()
    {
        return $this->morphMany('App\Activity', 'subject')->latest();
    }

    
}
