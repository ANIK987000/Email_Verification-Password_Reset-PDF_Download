
@extends('layouts/navbar')
@section('contents')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
            <hr>
            <h4 style="text-align:center;font-family: myFirstFont;">{{$user->First_Name}} {{$user->Last_Name}}</h4>
            <hr>


            <div class="container" style="padding: 30px 0">
                    <div class="row">
                
                            <div class="col-sm-4 ">
                            <img src="{{asset('UserImages/'.$user->Image)}}" height="200px" width="260px">
                            </div>

                            <div class="col-sm-8">


                                        <table class="table table-striped  table-hover table-dark" height="130px" width="240px">
                                            
                                            <tr>
                                                
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Status</th>



                                            </tr>
                                            
                                            <tr>
                                        
                                                <td>{{$user->First_Name}}</td>
                                                <td>{{$user->Last_Name}}</td>
                                                <td>{{$user->Email}}</td>
                                                <td>{{$user->Password}}</td>
                                                <td>{{$user->Phone}}</td>
                                                <td>{{$user->Address}}</td>
                                                <td>{{$user->Status}}</td>
                                            
                    
                                            </tr>

                                        </table>
            

                                        <div>
                                        
                                        <form action="{{route('admin.toggleStatus')}}" method="post">
                                            @csrf
                                            <input type="text" name="Email" value="{{$user->Email}}" class="form-control" hidden>
                                            <button class="btn btn-primary" type="submit">Toggle Status</button>
                                        
                                        </form>
                                        <!-- <a href="{{route('admin.dashboard')}}"><button type="button" class="btn btn-info">Back to dashboard</button></a> -->
                                        </div>      

                        </div>
                    </div>
            </div>
</body>
</html>

@endsection