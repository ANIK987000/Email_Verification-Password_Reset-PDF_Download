@component('mail::message')

Hello {{$user->First_Name}},

@component('mail::button', ['url'=>route('reset.password', $user-> email_verification_code)])
Click here to reset your password

@endcomponent

<p>Copy paste the following link on your web browser to reset your password</p>

<p><a href="{{route('reset.password', $user-> email_verification_code)}}">
    {{route('reset.password', $user-> email_verification_code)}}</a></p>

Thanks <br>
{{config('app.name')}}

@endcomponent