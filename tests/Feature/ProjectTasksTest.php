<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
 
	public function test_it_project_can_have_tasks()
	{
		$this->withoutExceptionHandling();

		//  login
		$this->siginIn();

		$project = auth()->user()->projects()->create(factory(Project::class)->raw());
		$this->post($project->path(). '/tasks',['body'=>'ahmed tasks']);

		$this->get($project->path())
			->assertSee('ahmed tasks');
	}

	public function a_project_requires_a_description()
	{
		
		$this->siginIn();
		$project = auth()->user()->projects()->create(factory(Project::class)->raw());
		$attributes = factory('App\Task')->raw(['body' => '']);
		$this->post('/projects',[])->assertSessionHasErrors('body');
	}




}
