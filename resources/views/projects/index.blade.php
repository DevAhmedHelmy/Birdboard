@extends('layouts.app')
@section('content')
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