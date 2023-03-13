@component('mail::message')
<div class="text-center">
    <h4>Hello {{$user->name}},</h4>
    <p>Please verify your email by clicking in the button bellow</p>
    @component('mail::button', ['url' =>route('verfication', ['lang'=>App::currentLocale(), 'token'=>$user->email_token])])
        Verify
    @endcomponent
</div>
@endcomponent
