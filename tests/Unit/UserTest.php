<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
//     public function a_user_has_projects()
//     {
//         $user = factory('App\User')->create();
//         $this->assertInstanceOf(App\User::class, $user->projects());
//     }


    /** @test */

    public function a_user_has_accessible_projects()
    {
        $ahmed = $this->siginIn();

         ProjectFactory::ownerBy($ahmed)->create();


        $this->assertCount(1,$ahmed->accessibleProjects());

        $helmy = factory(User::class)->create();
         

        $project = tap(ProjectFactory::ownerBy($helmy)->create())->invite(factory(User::class)->create());
        $this->assertCount(1,$ahmed->accessibleProjects());

        $project->invite($ahmed);
        $this->assertCount(2,$ahmed->accessibleProjects());


    }
}
