<form method="POST" action="/login" style="background: #f5e8c7; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    @csrf
    <h2 style="color: #264d29; font-family: Roboto, sans-serif;">Sign In</h2>
    <div>
        <label>Email</label>
        <input type="email" name="email" required style="margin: 10px 0; padding: 5px; border-radius: 5px;">
    </div>
    <div>
        <label>Password</label>
        <input type="password" name="password" required style="margin: 10px 0; padding: 5px; border-radius: 5px;">
    </div>
    <button type="submit" style="background: #f4861f; color: white; padding: 5px 10px; border-radius: 5px;">Login</button>
    <a href="{{ route('password.request') }}" style="color: #264d29; font-family: Roboto, sans-serif; display: block; margin-top: 10px;">Forgot Password?</a>
</form>