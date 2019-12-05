<div class="card mt-6">
    <ul class="text-xs list-reset">
        @foreach ($project->activity as $activity)
            <li class="{{ $loop->last ? '' : 'pb-2' }}">
                <p>ahmed</p>
                @include ("projects.activity.{$activity->description}")
                
            </li>
        @endforeach
    </ul>
</div>