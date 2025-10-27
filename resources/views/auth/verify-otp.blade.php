<form method="POST" action="{{ route('verify.otp.submit') }}">
    @csrf
    <div class="form-group">
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Verify OTP</button>
</form>
