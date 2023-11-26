@component('mail::message')

Hello {{$user->First_Name}},

@component('mail::button', ['url'=>route('verify.mail', $user-> email_verification_code)])
Click here to verify your email adress

@endcomponent

<p>Copy paste the following link on your web browser to verify your email address</p>

<p><a href="{{route('verify.mail', $user-> email_verification_code)}}">
    {{route('verify.mail', $user-> email_verification_code)}}</a></p>

Thanks <br>
{{config('app.name')}}

@endcomponent