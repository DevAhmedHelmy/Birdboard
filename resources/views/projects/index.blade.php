@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <h1 class="text-gray-500 no-underline">My Projects</h1>
            <a href="/projects/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">New Project</a>
        </div>
        
    </header>
    

    <main class="lg:flex flex-wrap -mx-3">
        @forelse($projects as $project)
        <div class="lg:w-1/3 px-4 pb-6">
            @include('projects.card')
        </div>
        
            
            @empty
        <div>No Projects Yet.</div>
        @endforelse
    </main>
   
@endsection