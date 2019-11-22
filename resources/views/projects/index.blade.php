@extends('layouts.app')
@section('content')
    <div style="display:flex; align-items:center;">
        <h1 style="margin-right:auto;">Birdboad</h1>
        <a href="/projects/create" class="button is-info">Create a New Project</a>
    </div>
    

    <div class="flex">
        @forelse($projects as $project)
        <div class="bg-white mr-4">
             
            <h3><a href="{{$project->path()}}">{{$project->title}}</a></h3>
            <div>{{$project->description}}</div>
             
        </div>
            
            @empty
        <div>No Projects Yet.</div>
        @endforelse
    </div>
   
@endsection