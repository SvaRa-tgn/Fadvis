<?php

namespace App\Mail;

use App\DTO\Admin\User\UpdateUserDTO;
use App\Models\ProposalPrice;
use App\Models\ProposalProthesis;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProposalProthesesMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly ProposalProthesis $proposalProthesis,
        private readonly User $user,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Заявка на протез',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $program = $this->proposalProthesis->is_program ? 'Да' : 'Нет';

        return new Content(
            markdown: 'notifications.email',
            with: [
                'subject' => 'Заявка на протез',
                'level' => 'success',
                'greeting' => 'Здравствуйте, ' . $this->user->surname . ' ' . $this->user->name . '!',
                'introLines' => [
                    'Заявка на протез от: ' . $this->proposalProthesis->surname . ' '
                    . $this->proposalProthesis->name . ' ' . $this->proposalProthesis->patronymic,
                    'телефон: ' . $this->proposalProthesis->phone,
                    'email: ' . $this->proposalProthesis->email,
                    'город: ' . $this->proposalProthesis->city,
                    ],
                'outroLines' => [
                    'возраст: ' . $this->proposalProthesis->age_period->caption(),
                    'Есть ли ИПРА или ПРП: ' . $program,
                    'Тип функциональности: ' . $this->proposalProthesis->prothesis_function->caption(),
                    'Тип протеза: ' . $this->proposalProthesis->prothesis_type->caption(),
                    'Вопросы: ' . $this->proposalProthesis->questions,
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
