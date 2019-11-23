@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <h1 class="text-gray-500 no-underline">My Projects</h1>
            <button href="/projects/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">New Project</button>
        </div>
        
    </header>
    

    <main class="lg:flex flex-wrap -mx-3">
        @forelse($projects as $project)
        <div class="lg:w-1/3 px-4 pb-6">
            <div class="card">
            
                <h3 class="font-normal text-xl py-6 -ml-5 border-solid border-l-4 border-blue-300 pl-4"><a href="{{$project->path()}}">{{$project->title}}</a></h3>
                <div class="text-gray-500">{{str_limit($project->description)}}</div>
                    
            </div>
        </div>
        
            
            @empty
        <div>No Projects Yet.</div>
        @endforelse
    </main>
   
@endsection