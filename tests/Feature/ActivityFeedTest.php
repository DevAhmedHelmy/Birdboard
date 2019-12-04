<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function creating_a_project_records_activity()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $this->assertCount(1, $project->activity); 
        $this->assertEquals('created',$project->activity[0]->description);
    }


    /** @test */ 

    function updating_a_project_records_activity()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $project->update(['title' => 'chanaged']);
        $this->assertCount(2, $project->activity); 
        $this->assertEquals('updated',$project->activity->last()->description);
    }

    /** @test */ 

    function creating_a_task_records_project_activity()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $project->addTask('some task');
        $this->assertCount(2, $project->activity); 
        // $this->assertEquals('updated',$project->activity->last()->description);
    }
}
