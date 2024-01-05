<h2>Password Reset Link</h2>
   
{{-- You can reset password from below link:
<a href="{{ route('password.reset', $token) }}">Reset Password</a> --}}

<p>Hello!</p>
<p>You are receiving this email because we received a password reset request for your account.</p>
<p>
    <a href="{{ route('password.reset', $token) }}">Reset Password</a>
</p>
<p>If you did not request a password reset, no further action is required.</p>