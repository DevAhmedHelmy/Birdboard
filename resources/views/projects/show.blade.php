@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-gray-500 no-underline">
                <a href="/projects"> My Projects </a> / {{$project->title}}
            </p>
            <a href="/projects/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">New Project</a>
        </div>
        
    </header>
    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-gray-500 no-underline mb-3">Tasks</h2>
                    {{-- tasks --}}
                    @forelse ($project->tasks as $task)
                        <div class="card mb-2">{{$task->body}}</div>
                    @empty
                        <div class="card mb-2">No Tasks</div>
                    @endforelse
                    <div class="card mb-2">
                        <form action="{{$project->path().'/tasks'}}" method="post">
                            @csrf   
                            <input placeholder="Begin Adding Tasks...." name="body" class="w-full" autocomplete="off">
                        
                        </form>
                    </div>
                      
                </div>
                
                {{-- general notes --}}
                <div>
                    <h2 class="text-lg text-gray-500 no-underline mb-3">General Notes</h2>
                    <textarea class="card w-full" style="min-height:200px">lorem ipsum</textarea>
                </div>

                
            </div>
            
            <div class="lg:w-1/4 px-3">
                 @include('projects.card')
             
            </div>
        </div>
    
    
         
    
        <div>
            <a href="/projects" class="button is-info">Go Back</a>
        </div>
    </main>
    
    
@endsection