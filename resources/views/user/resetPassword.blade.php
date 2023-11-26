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
                            <div class="card-header">{{ __('Reset your password !') }}</div>

                            <div class="card-body">
                                    @if (Session::has('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}</div>
                                    @endif
                                    @if (Session::has('fail'))
                                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                                    @endif

                            
                                <form class="d-inline" method="POST" action="{{route('reset.password.main.page',$user->email_verification_code)}}">
                                    @csrf
                                    <label>Password</label>
                                    <input type="password" name="psw" value="{{old('psw')}}" class="form-control" placeholder="Enter Password">
                                    @error('psw')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <br><br>
                                    <label>Repeat Password</label>
                                    <input type="password" name="psw_repeat" value="{{old('psw_repeat')}}" class="form-control" placeholder="Re-entry Password">
                                    @error('psw_repeat')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <br>
                                    <button type="submit" class="btn btn-outline-info">{{ __('RESET PASSWORD') }}</button>.
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>
</html>

@endsection
