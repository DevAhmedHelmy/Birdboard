<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;
    /** @test */

    function a_project_can_invite_a_user()
    {
        $project = ProjectFactory::create();
        $project->invite($newUser = factory(User::class)->create());

        $this->siginIn($newUser);
        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
