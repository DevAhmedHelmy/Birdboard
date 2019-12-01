<?php

namespace App\Policies;

use App\User;
use App\Project;

use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectsPolicy
{
    use HandlesAuthorization;
 
    public function update(User $user , Project $project)
    {
        return $user->id == $project->owner->id;
        // if(! $user->isNot($project->owner))
        // {
        //     abort(403);
        // }
    }
}
