@extends('layouts.homeNavbar')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
            <div class="w-25 p-3 justify-content-center">


            <form action="{{route('submit.registration')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <h3>Registration</h3>
                <hr>
                <br>
                @if (Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
              
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                @if (Session::has('verify'))
                    <div class="alert alert-warning">{{Session::get('verify')}}</div>
                @endif

                <label>First Name</label>
                <input type="text" name="fname" value="{{old('fname')}}" class="form-control" placeholder="Enter Your First Name">
                @error('fname')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <br><br>
                <label>Last Name</label>
                <input type="text" name="lname" value="{{old('lname')}}" class="form-control" placeholder="Enter Your Last Name">
                @error('lname')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <br><br>
                <label>Email</label>
                <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter Your Email">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <br><br>
                <label for="exampleFormControlSelect1">Account Type</label>
                <select class="form-control" name="type">
                  <option>admin</option>
                  <option>user</option>
                </select>
                @error('type')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <br><br>
                <label>Phone</label>
                <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Enter your phone number">
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <br><br>

                <label>Address</label>
                <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Enter your present address">
                @error('address')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <br><br>

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
                <br><br>

                <label>Profile Picture</label>
                <input type="file" name="pro_pic"><br><br>
                @error('pro_pic')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <br><br>
                
                <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>
              </form>
            </div>
</body>
</html>
@endsection