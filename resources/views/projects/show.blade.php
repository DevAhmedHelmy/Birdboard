@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-gray-500 no-underline">
                <a href="/projects"> My Projects </a> / {{$project->title}}
            </p>
            
            <a href="{{ $project->path().'/edit' }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit Project</a>
        </div>
        
    </header>
    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-gray-500 no-underline mb-3">Tasks</h2>
                    {{-- tasks --}}
                    @foreach ($project->tasks as $task)
                        <div class="card mb-2">
                            <form action="{{$task->path()}}" method="post">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                    <input name="body" value="{{$task->body}}" class="w-full {{$task->completed ? 'text-gray-600' : ''}}">
                                    <input type="checkbox" name="completed" onclick="this.form.submit()" {{$task->completed ? 'checked' : ''}}>
                                </div>
                                
                            </form>
                        </div>
                    @endforeach
                    <div class="card mb-2">
                        <form action="{{$project->path().'/tasks'}}" method="post">
                            @csrf   
                            <input placeholder="Add a New Task...." name="body" class="w-full" autocomplete="off">
                        
                        </form>
                    </div>
                      
                </div>
                
                {{-- general notes --}}
                <div>
                    <h2 class="text-lg text-gray-500 no-underline mb-3">General Notes</h2>
                    <form method="POST" action="{{$project->path()}}"> 
                        @method('PATCH')
                        @csrf
                        <textarea class="card w-full" name="notes" style="min-height:200px" placeholder="Anything special that you want to make a note of?">{{$project->notes}}</textarea>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                    </form>
                </div>
                @include('errors')
                
            </div>
            
            <div class="lg:w-1/4 px-3 lg:py-8">
                 @include('projects.card')
                 {{-- @include ('projects.activity.card') --}}
                <div class="card mt-3">
                    <ul class="text-xs">

                
                        @foreach($project->activity as $activity)
                        <li class="{{$loop->last ? '' : 'mb-1'}}">
                           @if( $activity->description == 'created_project')
                               you created Project
                               
                           @elseif($activity->description == 'updated_project')
                               you updated Project
                           @elseif($activity->description == 'created_task')
                               you created task
                           @elseif($activity->description == 'completed_task')
                               you completed Task
                           @endif
                       </li>
                        @endforeach
                       </ul>
                </div>
                
            </div>
        </div>
    
    
         
    
        <div>
            <a href="/projects" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Go Back</a>
        </div>
    </main>
    
    
@endsection