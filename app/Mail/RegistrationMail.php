<?php

namespace App\Mail;

use App\DTO\Admin\User\CreateUserDTO;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly CreateUserDTO $user,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Регистрация в Fadvis',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'notifications.email',
            with: [
                'subject' => 'Регистрация в Fadvis',
                'level' => 'success',
                'greeting' => 'Здравствуйте, ' . $this->user->surname . ' ' . $this->user->name . '!',
                'actionText' => 'Перейти на сайт',
                'actionUrl' => config('app.url').'8080',
                'introLines' => ['Вы получили это письмо потому, что запрашивали регистрацию на нашем сайте.'],
                'outroLines' => [
                    'Ваш логин для личного кабинета: ' . $this->user->email,
                    'Ваш пароль от личного кабинета: ' . $this->user->password,
                    'Пароль можно сменить в личном кабинете.'
                ],
                'salutation' => 'С уважением, Команда '. config('app.name') . '!',
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
