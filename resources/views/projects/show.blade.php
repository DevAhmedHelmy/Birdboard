@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <h1 class="text-gray-500 no-underline">My Projects</h1>
            <button href="/projects/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">New Project</button>
        </div>
        
    </header>
    <main>
        <div class="flex">
            <div>
                <h2 class="text-gray-500 no-underline">Tasks</h2>
                {{-- tasks --}}


                <h2 class="text-gray-500 no-underline">General Notes</h2>
                <div class="card">lorem ipsum</div>
            </div>
                
             <div>{{$project->description}}</div>
    
    
         
        </div>
        <div>
            <a href="/projects" class="button is-info">Go Back</a>
        </div>
    </main>
    
    
@endsection