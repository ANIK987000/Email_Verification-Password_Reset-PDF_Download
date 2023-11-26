
@extends('layouts/navbar1')
@section('contents')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
            <hr>
            <h4 style="text-align:center;font-family: myFirstFont;">Profile</h4>
            <hr>
            <div>
                <div class="container" style="padding: 30px 0">
                    <div class="row">
                
                            <div class="col-sm-4 ">
                                @if($user->Image=="null")
                                
                                    <img src="dummy/dummy.jpg" width="300px" alt="">
                                
                                @else
                                
                                    <img src="{{asset('UserImages/'.$user->Image)}}" width="300px" height="300px" alt="">
                                
                                @endif
                                
                            </div>
                            <div class="col-sm-8">
                                <table  class="table table-striped table-dark table-responsive-sm" style="width:500px; height:300px">
                                    <tr>
                                        <td><b>First Name</b></td>
                                        <td><b>:</b></td>
                                        <td><b>{{$user->First_Name}}</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Last Name</b></td>
                                        <td><b>:</b></td>
                                        <td><b>{{$user->Last_Name}}</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email</b></td>
                                        <td><b>:</b></td>
                                        <td><b>{{$user->Email}}</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Password</b></td>
                                        <td><b>:</b></td>
                                        <td><b>{{$user->Password}}</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone</b></td>
                                        <td><b>:</b></td>
                                        <td><b>{{$user->Phone}}</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Address</b></td>
                                        <td><b>:</b></td>
                                        <td><b>{{$user->Address}}</b></td>
                                    </tr>
                                </table>
                                <a href="{{route('user.updateProfile')}}"><button type="button" class="btn btn-success">Update Profile</button></a>
                                <a href="{{ route('download.profile') }}" class="btn btn-primary">Print PDF</a>
                            </div>
                
                        

                    
                    </div>
                </div>
            </div>
</body>
</html>

@endsection