<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <br>
    <div class="p-3">
        <a href="{{route('home')}}"><button type="button" class="btn btn-outline-info">Demo</button></a>
        <a href="{{route('login')}}"><button type="button" class="btn btn-outline-primary">Sign In</button></a>

        <a href="{{route('registration')}}"><button type="button" class="btn btn-outline-success">Sign Up</button></a>
    </div>
    @yield('content')
</body>
</html>