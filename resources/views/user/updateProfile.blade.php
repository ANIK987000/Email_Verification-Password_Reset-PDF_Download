
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
            <h4 style="text-align:center;font-family: myFirstFont;">Update Profile</h4>
            <hr>


            @if(session('profileUpdated'))
                            <div class="alert alert-success" role="alert">
                                <b>{{session('profileUpdated')}}</b>
                                
                            </div>
            @endif
            @if(session('profileNotUpdated'))
                            <div class="alert alert-danger" role="alert">
                                <b>{{session('profileNotUpdated')}}</b>
                                
                            </div>
            @endif



            <div>
                <div class="container" style="padding: 30px 0">
                <form action="" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                
                            <div class="col-sm-4">
                                
                            @if($user->Image=="null")
                                
                                    <img src="dummy/dummy.jpg" width="300px" alt="">
                                
                                @else
                                
                                    <img src="{{asset('UserImages/'.$user->Image)}}" width="300px" height="300px" alt="">
                                
                                @endif


                            <br><br>
                                <input type="file" name="pro_pic"><br><br>
                                        @error('pro_pic')
                                                <span class="text-danger">{{$message}}</span><br><br>
                                        @enderror
                                <!-- <button type="Submit" class="btn btn-primary">Change Photo</button> -->
                            </div>
                            <div class="col-sm-8">
                                <table  class="table table-striped table-dark table-responsive-sm" style="width:500px; height:300px">
                                    <tr>
                                        <td><b>First Name</b></td>
                                        <td><b>:</b></td>
                                        <td><b><input type="text" class="form-control" name="fname" value="{{$user->First_Name}}"></b>
                                        @error('fname')
                                                <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><b>Last Name</b></td>
                                        <td><b>:</b></td>
                                        <td><b><input type="text" class="form-control" name="lname" value="{{$user->Last_Name}}"></b>
                                        @error('lname')
                                                <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><b>Email</b></td>
                                        <td><b>:</b></td>
                                        <td><b><input type="text" class="form-control " name="email" value="{{$user->Email}}" disabled></b>
                                        @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><b>Password</b></td>
                                        <td><b>:</b></td>
                                        <td><b><input type="text" class="form-control" name="psw" value="{{$user->Password}}"></b>

                                        @error('psw')
                                                <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </td>
                                    </tr>


                                    <tr>
                                        <td><b>Phone</b></td>
                                        <td><b>:</b></td>
                                        <td><b><input type="text" class="form-control" name="phone" value="{{$user->Phone}}"></b>

                                        @error('phone')
                                                <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </td>
                                    </tr>



                                    <tr>
                                        <td><b>Address</b></td>
                                        <td><b>:</b></td>
                                        <td><b><input type="text" class="form-control" name="address" value="{{$user->Address}}"></b>

                                        @error('address')
                                                <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </td>
                                    </tr>



                                </table>
                                <button type="Submit" class="btn btn-success">Update</button>
                            </div>
                
                            

                    
                    </div>
                </form>
                </div>
            </div>
</body>
</html>

@endsection