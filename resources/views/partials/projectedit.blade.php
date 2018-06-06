<br>
<div class="contentdiv centerx">
    <h2>{{ $title }}</h2>
    <br>
    <p>Description: {!! $description !!}</p>
    <br>
    <p>Project Link: {{ $href }}</p>
    <br>
    <p>Github Link:{{ $githublink }}</p>
    <form action="{{env('APP_URL')}}projects/{{$id}}" method="post" onsubmit="return confirm('Are you sure?');">
        <input name="_method" type="hidden" value="DELETE">
        <input class="crispbutton" style="margin-top:3px" type="submit" value="Delete">
        {{csrf_field()}}
    </form>
    <form action="{{env('APP_URL')}}projects/{{$id}}/edit" method="post">
        <input name="_method" type="hidden" value="get">
        <input class="crispbutton" style="margin-top:3px" type="submit" value="Edit">
        {{csrf_field()}}
    </form>
</div>
<br>