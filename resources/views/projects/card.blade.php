<div class="card flex flex-col" style="height: 200px">
                        
    <h3 class="font-normal text-xl py-6 -ml-5 border-solid border-l-4 border-blue-300 pl-4"><a href="{{$project->path()}}">{{$project->title}}</a></h3>
    <div class="text-gray-500">{{str_limit($project->description)}}</div>

	@can('manage',$project)
	    <footer>
	        <form method="POST" action="{{ $project->path() }}" class="text-right">
	            @method('DELETE')
	            @csrf
	            <button type="submit" class="text-xs">Delete</button>
	        </form>
	    </footer>
    @endcan
                
</div>

 