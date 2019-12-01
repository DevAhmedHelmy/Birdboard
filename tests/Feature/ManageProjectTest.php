<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectTest extends TestCase
{

    use WithFaker, RefreshDatabase;

     /**
     * @test
     */
    public function only_authenticated_users_cannot_control_projects()
    {
       // $this->withoutExceptionHandling();
       $attributes = [
        'title' => $this->faker->sentence,
        'description' => $this->faker->paragraph

        ];
        $project = factory('App\Project')->create();

        $this->get('/projects')->assertRedirect('login');

        $this->get('/projects/create')->assertRedirect('login');
        $this->get('/projects/edit')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');

        $this->post('/projects',$attributes)->assertRedirect('login');
        
        
    }
     /**
     * @test
     */
    // public function only_authenticated_users_can_view_projects()
    // {
        
    //     $this->get('/projects')->assertRedirect('login');
    // }

    /**
     * @test
     */
    // public function only_authenticated_users_can_view_a_single_project()
    // {
    //     // $this->withoutExceptionHandling();
    //       $project = factory('App\Project')->create();
          
    //     $this->get($project->path())->assertRedirect('login');
    // }
   /**
    * @test
    */
    public function a_user_can_create_a_project()
    {
        // $this->withoutExceptionHandling();
         
        $this->siginIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => 'General Notes'

        ];
        // to route post
        $response = $this->post('/projects',$attributes);
        
        $project = \App\Project::where($attributes)->first();
        
        $response->assertRedirect($project->path());



        // $this->assertDatabaseHas('projects',$attributes);

        $this->get($project->path())
             ->assertSee($attributes['title'])
             ->assertSee($attributes['description'])
             ->assertSee($attributes['notes']);
    }

    /** @test */
    public function a_user_can_update_a_project()
    {
        // $this->siginIn();
        // $this->withoutExceptionHandling();
        // $project = factory('App\Project')->create(['owner_id'=>auth()->id(),'notes'=>'hello']);
        $project = ProjectFactory::create();
        $this->actingAs($project->owner)->patch($project->path(),$attributes = [
            'title' => 'changed',
            'description' => 'changed',
            'notes' => 'changed'
        ])->assertRedirect($project->path());
        $this->get($project->path().'/edit')->assertOk();
        $this->assertDatabaseHas('projects', $attributes);
    }

    /**
      * @test
      */

      public function only_authenticated_users_cannot_update_the_projects_of_others()
      {
            $this->siginIn();
            // $this->withoutExceptionHandling();
            $project = factory('App\Project')->create();
          
            $this->patch($project->path(),[])->assertStatus(403);
      }
    /**
     * @test
     */

     public function a_project_requires_a_title()
     {
      
        $this->siginIn();
        $attributes = factory('App\Project')->raw(['title' => '']);
         $this->post('/projects',$attributes)->assertSessionHasErrors('title');
     }

      /**
     * @test
     */


     public function a_project_requires_a_description()
     {
         
        $this->siginIn();

        $attributes = factory('App\Project')->raw(['description' => '']);
         $this->post('/projects',[])->assertSessionHasErrors('description');
     }


     /**
      * @test
      */

      public function a_user_can_view_a_project()
      {
        
            $project = ProjectFactory::create();
            $this->actingAs($project->owner)
                 ->get($project->path())
                 ->assertSee($project->title)
                 ->assertSee($project->description);
      }

      /**
      * @test
      */

      public function only_authenticated_users_cannot_view_the_projects_of_others()
      {
            $this->siginIn();
            // $this->withoutExceptionHandling();
            $project = factory('App\Project')->create();
          
            $this->get($project->path())->assertStatus(403);
      }

     

}
