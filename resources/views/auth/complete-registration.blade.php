<form action="{{ route('register.complete', ['email' => $user->email]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Complete Registration</button>
</form>
