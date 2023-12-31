<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<marquee behavior="alternate" direction="right"><b>|--- Welcome {{Session::get('LoggedInFirstName')}} {{Session::get('LoggedInLastName')}} ---|</b></marquee>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height:80px">
  <a class="navbar-brand">Demo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      
      <li class="nav-item">
        <a class="nav-link" href="{{route('user.dashboard')}}">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('user.profile')}}">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('user.updateProfile')}}">Update Profile</a>
      </li>
      
        <a class="nav-link" href="{{route('logout')}}">Logout</a>
      </li>
      
    </ul>


    
              
              <h3 class="text-white" style="margin-left:700px"><i class="fa fa-solid fa-user"></i></h3>
              <b class="text-white" style="margin-left:10px">{{Session::get('LoggedInFirstName')}} {{Session::get('LoggedInLastName')}}</b>
      </form>
      
  </div>
</nav>
    
@yield('contents')
</body>
</html>