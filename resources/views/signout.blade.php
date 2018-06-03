@extends("adminlayout")

@section('content')

<div class="centerxy">
    <div class="contentdiv">
        <p>You have been signed out.</p>
        <a href="{{config('constants.HOME')}}">Return to Home</a>
    </div>
</div>

@endsection