@include("partials.header")

<div class="contentdiv">
    <p>Your message was not for the following reasons:
        <br><br>
        {!! $strInvalidReasons !!}
        <br>
        <a href="{{ config('constants.CONTACT')}}">Please try again</a>.
    </p>
</div>

@include("partials.footer")