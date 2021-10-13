@component('mail::message')
    @component('mail::panel')
    {{ trans('mail_happybirthday.header', ['name' => $user->name,]) }}
    @endcomponent
    {{ trans('mail_happybirthday.content', ['app_name' => config('app.name'), 'username' => $user->name,]) }}

    {{ trans('mail_happybirthday.footer') }}
@endcomponent
