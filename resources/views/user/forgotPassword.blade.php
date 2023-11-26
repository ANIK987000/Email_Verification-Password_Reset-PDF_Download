<!-- auth.verify-email.blade.php -->

@extends('layouts.homeNavbar')  {{-- Assuming you have a main layout file --}}

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Forgot your password ?') }}</div>

                            <div class="card-body">
                                    @if (Session::has('resetpasswordlink'))
                                    <div class="alert alert-success">{{Session::get('resetpasswordlink')}}</div>
                                    @endif
                                    @if (Session::has('NotValid'))
                                        <div class="alert alert-danger">{{Session::get('NotValid')}}</div>
                                    @endif

                                {{ __('No problem. Let us know your email address, we will send you a link to your email address for reset your password.') }}
                                {{ __('Now provide your email address for the link.') }} <br><br>

                                <form class="d-inline" method="POST" action="{{ route('reset.password.mail') }}">
                                    @csrf
                                    <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter Your Email">
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <br>
                                    <button type="submit" class="btn btn-outline-info">{{ __('EMAIL PASSWORD RESET LINK') }}</button>.
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>
</html>

@endsection
