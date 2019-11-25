<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
 /**@test */ 
 public function it_project_can_have_tasks()
 {
    //  login
    $this->actingAs(factory('App\User')->create());
 }


}
