@extends('layouts.app')
@section('content')
    <div>
        <h1>Birdbroad</h1>
        <a href="/projects/create" class="button is-info">Create a New Project</a>
    </div>
    
    <ul>
        @forelse ($projects as $project)
            <li>
                <a href="{{$project->path()}}">{{$project->title}}</a>
            </li>  

            @empty
            <li>No Projects Yet.</li>
        @endforelse
    </ul>
@endsection