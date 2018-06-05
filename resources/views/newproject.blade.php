@extends("adminlayout")

@section('content')

<div class="contentdiv centerxy">  
    <form action="project" method="post" onsubmit="return validateProject();">
        <label class="label" for="title">Project Title:</label>
        <input type="text" name="title" autofocus autocomplete="name" placeholder="John Doe" required>
        <label class="label" for="code-link">Code Link (Optional):</label>
        <input type="text" name="code-link" placeholder="https://github.com/example">
        <label class="label"  for="project-link">Project Link (Optional):</label>
        <input type="text" name="project-link" placeholder="https://github.com/example">
        <label class="label" for="description">Project Description:</label>
        <textarea type="text" rows="4" name="description" placeholder="It does a thing." required></textarea><br>
        <input class="crispbutton" style="margin-top:3px" type="submit" value="Create">
        {{csrf_field()}}
    </form>
</div>

@endsection