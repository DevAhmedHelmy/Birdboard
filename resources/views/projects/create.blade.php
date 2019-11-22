<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Document</title>
</head>
<body>
    <form action="{{url('/projects')}}" method="post" class="container" style="padding-top:40px;">
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
            </div>
        </div>
        
    </form>
</body>
</html>