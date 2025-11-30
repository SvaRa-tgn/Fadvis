<?php

namespace App\Mail;

use App\DTO\Admin\User\UpdateUserDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChangePasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly UpdateUserDTO $dto,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новый пароль в Fadvis',
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
                'subject' => 'Новый пароль в Fadvis',
                'level' => 'success',
                'greeting' => 'Здравствуйте, ' . $this->dto->user->surname . ' ' . $this->dto->user->name . '!',
                'actionText' => 'Перейти на сайт',
                'actionUrl' => config('app.url'),
                'introLines' => ['Вы получили это письмо потому, что был изменен пароль.'],
                'outroLines' => [
                    'Ваш логин для личного кабинета: ' . $this->dto->user->email,
                    'Ваш новый пароль от личного кабинета: ' . $this->dto->password,
                    'Если вы не меняли пароль срочно свяжитесь с администрацией сайта!!!'
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
