<?php

namespace App\Mail;

use App\DTO\Admin\User\UpdateUserDTO;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly Order $order,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новый заказ',
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
                'subject' => 'Новый заказ',
                'level' => 'success',
                'greeting' => 'Новый заказ',
                'actionText' => 'Посмотреть заказ',
                'actionUrl' => route('admin.order.show', $this->order->number),
                'introLines' => ['Создан новый заказ на сумму ' . $this->order->formatted_total],
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
