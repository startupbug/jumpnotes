<h1>Welcome to ROD!</h1>
<p>Hi, {{ $tutor }}</p>
<p>A student({{$user}}) requested to study from you for <b>"{{$request['hours']}}"</b>
having email address: <b>{{$request['contact_email']}}</b> and skypeID: <b>{{$request['contact_skype']}}</b>
</p>
<br>
<a href="{{ route('home') }}">ROD Jumpnotes</a>
