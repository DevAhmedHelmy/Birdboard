@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
  
        <a href="/projects/create" class="button is-info">Create a New Project</a>
    </header>
    

    <main class="flex flex-wrap -mx-3">
        @forelse($projects as $project)
        <div class="w-1/3 px-4 pb-6">
            <div class="bg-white p-5 rounded shadow">
            
                <h3 class="font-normal text-xl py-6"><a href="{{$project->path()}}">{{$project->title}}</a></h3>
                <div class="text-gray-500">{{str_limit($project->description)}}</div>
                    
            </div>
        </div>
        
            
            @empty
        <div>No Projects Yet.</div>
        @endforelse
    </main>
   
@endsection