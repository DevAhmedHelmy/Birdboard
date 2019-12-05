<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecordActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function creating_a_project()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $this->assertCount(1, $project->activity); 
        $this->assertEquals('created',$project->activity[0]->description);
    }


    /** @test */ 

    function updating_a_project()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $project->update(['title' => 'chanaged']);
        $this->assertCount(2, $project->activity); 
        $this->assertEquals('updated',$project->activity->last()->description);
    }

    /** @test */ 

    function creating_a_new_task()
    {
        // $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $project->addTask('some task');
        $this->assertCount(3, $project->activity); 
        $this->assertEquals('created_task',$project->activity->last()->description);
    }

     /** @test */ 

     function completing_a_task()
     {
        //  $this->withoutExceptionHandling();
         $project = ProjectFactory::withTasks(1)->create();
         $this->actingAs($project->owner)->patch($project->tasks[0]->path(),[
             'body' => 'foobar',
             'completed' => true
         ]);
         $this->assertCount(3, $project->activity); 
         $this->assertEquals('completed_task',$project->activity->last()->description);
     }

     /** @test */ 

     function incompleting_a_task()
     {
        //  $this->withoutExceptionHandling();
         $project = ProjectFactory::withTasks(1)->create();
         $this->actingAs($project->owner)->patch($project->tasks[0]->path(),[
             'body' => 'foobar',
             'completed' => true
         ]);
         $this->assertCount(3, $project->activity); 
         $this->patch($project->tasks[0]->path(),[
            'body' => 'foobar',
            'completed' => false
        ]);

         $this->assertCount(4, $project->fresh()->activity); 
         $this->assertEquals('incompleted_task',$project->fresh()->activity->last()->description);
     }

     /** @test */ 

     function deleting_a_task()
     {
         $this->withoutExceptionHandling();
         $project = ProjectFactory::withTasks(1)->create();


         $project->tasks[0]->delete();
        

         $this->assertCount(3, $project->fresh()->activity); 
         $this->assertEquals('deleting_task',$project->fresh()->activity->last()->description);
     }


}
