<?php

namespace App;
 

class Project extends Model
{
    public function path()
    {
        return "/projects/$this->id";
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
