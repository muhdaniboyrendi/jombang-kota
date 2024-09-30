<x-layout-auth>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>
    
                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
    
                        <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                        <p>{{ __('If you did not receive the email') }},</p>
    
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">{{ __('Click here to request another') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout-auth>