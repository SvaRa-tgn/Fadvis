<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('cyrillic', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[\p{Cyrillic}\d\s\-]+$/u', $value);
        });

        validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^\+7\\d{10}$/', $value);
        });

        ResetPassword::toMailUsing(function (User $user, string $token) {
            $url = url(route('password.reset', ['token' => $token, 'email' => $user->getEmailForPasswordReset()], false));

            return (new MailMessage)
                ->subject(subject: 'Инструкции для сброса пароля')
                ->level(level: 'success')
                ->greeting(greeting: 'Здравствуйте, ' . $user->surname . ' ' . $user->name . '!')
                ->line(line: 'Вы получили это письмо потому, что был запрошен сброс пароля для вашей учетной записи.')
                ->action(text: 'Сбросить пароль', url: $url)
                ->line(line:'Срок действия ссылки для сброса пароля истечет через ' . config('auth.passwords.'.config('auth.defaults.passwords').'.expire') . ' минут.')
                ->line(line:'Если вы не запрашивали сброс пароля, никаких дополнительных действий не требуется.')
                ->salutation(salutation: 'С уважением, Команда '. config('app.name') . '!');
        });
    }
}
