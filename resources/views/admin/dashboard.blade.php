@extends('layouts/navbar')
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
            <h4 style="text-align:center;font-family: myFirstFont;">Choose Your User </h4>
            <hr> 
            <div class="container">
              <div class="row">
                <div class="col-sm-2 ">
                
                    

                </div>
                <div class="col-sm-8">
            
                        <table class="table table-striped table-dark" >
                                <th>
                                    <td>Profile Picture</td>
                                    <td>First Name</td>
                                    <td>Last Name</td>
                                    <td>Email</td>
                                    <td>Phone</td>
                                    <td>Address</td>
                                    <td>Status</td>
                                    <td></td>
                                </th>
                                @foreach($user as $u)
                                <tr >
                                    <td></td>
                                    <td><a href="{{route('user.userDetails',['Email'=>$u->Email])}}"><img src="{{asset('UserImages/'.$u->Image)}}" style="border-radius:10px"height="120px" width="120px"></a></td>               
                                  
                                    <td>{{$u->First_Name}}</td>

                                    <td>{{$u->Last_Name}}</td>
                            
                                    <td>{{$u->Email}}</td>
                                    
                            
                                    <td>{{$u->Phone}}</td>
                            
                                    <td>{{$u->Address}}</td>

                                    <td>{{$u->Status}}</td>
                                    <td></td>

                                    
                                </tr>
                            
                                    
                  
                            
                                @endforeach
                        </table>
                        <br>
                        <div class="row">
                                {{ $user->links() }}
                                
                                <style>
                                        
                                    .w-5{
                                        display:none;
                                        
                                    }
                                </style>
                        </div>
              
                      

                </div>
                <div class="col-sm-2">
                  
                


                </div>
              </div>
            </div>



</body>
</html>

@endsection