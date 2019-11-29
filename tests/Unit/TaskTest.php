<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /** @test */

    function it_has_a_path()
    {

        $task = factory(\App\Task::class)->create();
        $this->assertEquals('/projects/'. $task->project->id . '\/tasks/' . $task->id, $task->path());
    }
}
