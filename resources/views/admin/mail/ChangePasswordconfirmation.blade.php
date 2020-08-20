@component('mail::message')
# Done

Your order has been Changed!


if you do not changed your password...
@component('mail::button', ['url' => 'http://127.0.0.1:8000/password/reset'])
Forget Password link
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
