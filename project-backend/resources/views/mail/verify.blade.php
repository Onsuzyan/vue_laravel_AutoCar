<h1> Hello<b>
        <i>{{$user->name}}</i></b>
</h1>
<p> Please verify your email with this link
    <button><a href="{{env('APP_FRONT_URL','http://localhost:8080/verify')."/$user->email"."/$token"}}">Link</a></button>
</p>
