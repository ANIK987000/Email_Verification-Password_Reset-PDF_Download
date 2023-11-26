<!-- resources/views/pdf/profile.blade.php -->

<h1>User Profile</h1>

<table style="width:300px; height:170px ; color:white; background-color: gray">
    <tr>
        <td>First Name</td>
        <td>:</td>
        <td>{{ $user->First_Name }}</td>
    </tr>
    <tr>
        <td>Last Name</td>
        <td>:</td>
        <td>{{ $user->Last_Name }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>:</td>
        <td>{{ $user->Email }}</td>
    </tr>
    <tr>
        <td>Password</td>
        <td>:</td>
        <td>{{ $user->Password }}</td>
    </tr>
    <tr>
        <td>Phone</td>
        <td>:</td>
        <td>{{ $user->Phone }}</td>
    </tr>
    <tr>
        <td>Address</td>
        <td>:</td>
        <td>{{ $user->Address }}</td>
    </tr>

    <tr>
        <td>Status</td>
        <td>:</td>
        <td>{{ $user->Status }}</td>
    </tr>

</table>

<img src="UserImages/{{$user->Image}}" width="300px" height="200px" alt="">           
 
<!-- Add other profile information as needed -->
