<?php

namespace App\Mail;

use App\DTO\Admin\User\UpdateUserDTO;
use App\Models\ProposalPrice;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProposalPriceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly ProposalPrice $proposalPrice,
        private readonly User $user,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Заявка на прайс',
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
                'subject' => 'Заявка на прайс',
                'level' => 'success',
                'greeting' => 'Здравствуйте, ' . $this->user->surname . ' ' . $this->user->name . '!',
                'introLines' => [
                    'Заявка на прайс от: ' . $this->proposalPrice->surname . ' ' . $this->proposalPrice->name,
                    'телефон: ' . $this->proposalPrice->phone,
                    'email: ' . $this->proposalPrice->email,
                    'компания: ' . $this->proposalPrice->organization,
                    'город: ' . $this->proposalPrice->city,
                    ],
                'outroLines' => [
                    'Что интересует: ' . $this->proposalPrice->interest,
                    'Вопросы: ' . $this->proposalPrice->questions,
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
