<?php

namespace Tests\Unit;

use App\Task;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    function it_belongsTo_a_project()
    {
        $task = factory(Task::class)->create();
        $this->assertInstanceOf(Project::class, $task->project);
    }

    /** @test */

    function it_has_a_path()
    {

        $task = factory(Task::class)->create();
        $this->assertEquals('/tasks/' . $task->id, $task->path());
    }
    /** @test */
    function it_be_completed()
    {
        $task = factory(Task::class)->create();
        $this->assertFalse($task->completed);

        $task->completed();

        $this->assertTrue($task->fresh()->completed);
    }

    /** @test */
    function it_be_incompleted()
    {
        $task = factory(Task::class)->create(['completed' => true]);

        $this->assertTrue($task->completed);

        $task->incompleted();

        $this->assertFalse($task->fresh()->completed);
    }
}
