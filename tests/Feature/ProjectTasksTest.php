<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
 
	public function test_it_project_can_have_tasks()
	{
		// $this->withoutExceptionHandling();

		//  login
		// $this->siginIn();

		// $project = auth()->user()->projects()->create(factory(Project::class)->raw());
		$project = ProjectFactory::create();
		$this->actingAs($project->owner)
			 ->post($project->path(). '/tasks',['body'=>'ahmed tasks']);

		$this->get($project->path())
			->assertSee('ahmed tasks');
	}

	/** @test */

	public function a_task_can_be_updated()
	{
		$this->withoutExceptionHandling();

		$project = ProjectFactory::withTasks(1)->create();

		 
		 
		$this->actingAs($project->owner)
			 ->patch($project->tasks[0]
			 ->path(), 
			 [
			'body' => 'chanaged',
			'completed' => true
		]);
		$this->assertDatabaseHas('tasks',[
			'body' => 'chanaged',
			'completed' => true
		]);
	}

	/**
	 * @test
	 */
	public function only_the_owner_of_a_project_may_add_tasks()
	{
		$this->siginIn();

		$project = factory(Project::class)->create();
		 
		$this->post($project->path() . '/tasks', ['body' => 'Ahmed Helmy']);

		$this->assertDatabaseMissing('tasks',['body'=>'Ahmed Helmy']);

	}

	/**
	 * @test
	 */
	public function a_project_requires_a_body()
	{
		 
		 
		$project = ProjectFactory::create();
		// $project = auth()->user()->projects()->create(factory(Project::class)->raw());
		$attributes = factory('App\Task')->raw(['body' => '']);
		$this->actingAs($project->owner)->post($project->path() . '/tasks',$attributes)->assertSessionHasErrors('body');
	}

	/**
	 * @test
	 */
	public function only_the_owner_of_a_project_may_update_a_task()
	{
		 
		$this->siginIn();

		$project = ProjectFactory::withTasks(1)->create();
		 
		$this->patch($project->tasks[0]->path(), ['body' => 'chanaged' , 'completed' => true ])->assertStatus(403);

		$this->assertDatabaseMissing('tasks',['body' => 'chanaged' , 'completed' => true ]);

	}




}
