@extends('layouts.app')
@section('content')
    <div class="flex items-center mb-3">
  
        <a href="/projects/create" class="button is-info">Create a New Project</a>
    </div>
    

    <div class="flex">
        @forelse($projects as $project)
        <div class="bg-white mr-4 p-5 rounded shadow w-1/3">
             
            <h3 class="font-normal text-xl py-6"><a href="{{$project->path()}}">{{$project->title}}</a></h3>
            <div class="text-grey">{{str_limit($project->description)}}</div>
             
        </div>
            
            @empty
        <div>No Projects Yet.</div>
        @endforelse
    </div>
   
@endsection