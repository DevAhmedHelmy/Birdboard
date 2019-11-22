@extends('layouts.app')
@section('content')
    <div>
        <h2>{{$project->title}}</h2>


        <p>{{$project->description}}</p>
    </div>
    <div>
        <a href="/projects" class="button is-info">Go Back</a>
    </div>
    
@endsection