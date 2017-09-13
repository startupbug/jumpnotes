<h1>Welcome to ROD!</h1>
<p>Hi, {{ $request['username'] }}</p>
<p>Kindly Click on the below link to Verify your Email address</p>
<br>
<a href="{{ route('verifyemail', ['token' => $token]) }}">Link</a>
