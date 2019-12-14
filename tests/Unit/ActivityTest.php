<?php

namespace Tests\Unit;

use App\User;
use App\Project;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;
    

    /** @test */

    function it_has_a_user()
    {
        $user = $this->siginIn();
        $project = ProjectFactory::ownerBy($user)->create();

        $this->assertEquals($user->id, $project->activity->first()->user->id);
    }
}
