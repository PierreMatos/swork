@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
        <h5 class="title">Recuperar password</h5>
        <h6 class="text-dark text-description">Insira o seu e-mail para fazer a recuperação da password</h6>

                <!-- <h5>{{ __('Reset Password') }}</h5> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror form-control-lg" name="EMAIL" value="{{ old('email') }}" required placeholder="E-mail" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <!-- {{ __('Send Password Reset Link') }} -->
                                    Recuperar password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        <!-- <div class="col-md-6">ffff</div> -->
    </div>
</div>
@endsection
