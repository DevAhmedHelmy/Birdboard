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
    function non_owners_may_not_invite_users()
    {
        $project = ProjectFactory::create();
        $user = factory(User::class)->create();
        $assertInvitationForbidden = function () use ($user, $project) {
            $this->actingAs($user)
                ->post($project->path() . '/invitations')
                ->assertStatus(403);
        };
        $assertInvitationForbidden();
        $project->invite($user);
        $assertInvitationForbidden();
    }

    /** @test */

    public function a_project_can_invite_a_user()
    {
        // $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $userToInvite = \factory(User::class)->create();
        $this->actingAs($project->owner)->post($project->path() .'/invitations', [
            'email' => $userToInvite->email
        ]);
        $this->assertTrue($project->members->contains($userToInvite));
    }
     /** @test */
     function the_email_address_must_be_associated_with_a_valid_birdboard_account()
     {
         $project = ProjectFactory::create();
         $this->actingAs($project->owner)
             ->post($project->path() . '/invitations', [
                 'email' => 'notauser@example.com'
             ])
             ->assertSessionHasErrors([
                 'email' => 'The user you are inviting must have a Birdboard account.'
             ], null, 'invitations');
     }

    /** @test */

    function invited_users_may_update_project_details()
    {
        $project = ProjectFactory::create();
        $project->invite($newUser = factory(User::class)->create());

        $this->siginIn($newUser);
        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
