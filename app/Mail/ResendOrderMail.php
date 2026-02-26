<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResendOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public string $pdfContent;
    public string $pdfName;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, $pdfContent, $pdfName = null)
    {
        $this->order = $order;
        $this->pdfContent = $pdfContent;
        $this->pdfName = $pdfName ?: "order-{$order->id}.pdf";
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Заказ на протезы в Fadvis',
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
                'subject' => 'Заказ на протезы в Fadvis',
                'level' => 'success',
                'greeting' => 'Здравствуйте.',
                'introLines' => ['Вы получили это письмо потому, что '
                    . $this->order->user->surname . ' ' . $this->order->user->name
                    . ' переслал вам заказ сделанный им в Fadvis.'],
                'outroLines' => [
                    'PDF с заказом находится во вложении.'
                ],
                'salutation' => 'С уважением, Команда '. config('app.name') . '!',
            ],

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfContent, $this->pdfName)
                ->withMime('application/pdf'),
        ];
    }
}
