@extends('layouts.app')
@section('content')
    <form action="{{url('/projects')}}" method="post">
        @csrf
        <h1 class="heading is-1">Create a Project</h1>
        <div class="field">
            <div class="control">
                <input class="input is-info" name="title" type="text" placeholder="Info input">
            </div>
        </div>
        <div class="field">
            <div class="control">
                <textarea class="textarea is-info" name="description" placeholder="Info textarea"></textarea>
            </div>
        </div>
        <div class="field">
            <div class="control">
                    <button type="submit" class="button is-info">Create Project</button>
                    <a href="/projects" class="button is-danger">Cancel</a>
            </div>
        </div>
        
    </form>
@endsection