<x-guest-layout>
    <h4 class="text-center mb-3 fw-semibold">Verify Email</h4>
    
    <p class="text-muted text-center small mb-4">
        Thanks for signing up! Please verify your email address by clicking the link we sent you.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Resend Verification Email</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-muted">Log Out</button>
        </form>
    </div>
</x-guest-layout>
