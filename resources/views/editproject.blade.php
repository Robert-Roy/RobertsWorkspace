@extends("adminlayout")

@section('content')

<div class="contentdiv centerxy">  
    <form action="{{env('APP_URL')}}projects/{{$id}}" method="post" onsubmit="return validateProject();">
        <label class="label" for="title">Project Title:</label>
        <input type="text" name="title" autofocus autocomplete="name" value="{{$title}}" placeholder="John Doe" required>
        <label class="label" for="code-link">Code Link (Optional):</label>
        <input type="text" name="code-link" value="{{$githublink}}" placeholder="https://github.com/example">
        <label class="label"  for="project-link">Project Link (Optional):</label>
        <input type="text" name="project-link" value="{{$href}}" placeholder="https://github.com/example">
        <label class="label" for="description">Project Description:</label>
        <textarea type="text" rows="4" name="description" placeholder="It does a thing." required>{{$description}}</textarea><br>
        <input name="_method" type="hidden" value="patch">
        <input class="crispbutton" style="margin-top:3px" type="submit" value="Save">
        {{csrf_field()}}
    </form>
</div>

@endsection