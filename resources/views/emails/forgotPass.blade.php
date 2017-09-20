<h1>Welcome to JumpNotes!</h1>
<p>Hi, {{ $user['username'] }}</p>
<p>Kindly Click on the below link to update your password</p>
<br>
<a href="{{ route('updatePassView', ['token' => $token]) }}">Update Password</a>
