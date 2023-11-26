<!-- auth.verify-email.blade.php -->

@extends('layouts.homeNavbar')  {{-- Assuming you have a main layout file --}}

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address !') }}</div>

                    <div class="card-body">
                            @if (Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            @if (Session::has('verify'))
                                <div class="alert alert-warning">{{Session::get('verify')}}</div>
                            @endif
                            <!-- <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div> -->
                            @if (Session::has('verify-success'))
                                <div class="alert alert-success">{{Session::get('verify-success')}}</div>
                            @endif

                            @if (Session::has('fail'))
                                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                            @endif
                            @if (Session::has('NotValid'))
                                <div class="alert alert-danger">{{Session::get('NotValid')}}</div>
                            @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},

                        <form class="d-inline" method="POST" action="{{ route('resend.mail') }}">
                            @csrf
                            <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter Your Email">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            <button type="submit" class="btn btn-outline-info">{{ __('click here to request another') }}</button>.
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
