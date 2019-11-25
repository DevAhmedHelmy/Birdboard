<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
//  /**@test */ 
 public function test_it_project_can_have_tasks()
 {
   $this->withoutExceptionHandling();

    //  login
    $this->siginIn();

    $project = factory(Project::class)->create(['owner_id'=>auth()->id()]);

    $this->post($project->path(). '/tasks',['body'=>'ahmed tasks']);

    $this->get($project->path())
         ->assertSee('ahmed tasks');
 }


}
