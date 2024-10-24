<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderInquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $order_details;
    public $reason;
    public $messages;
    /**
     * Create a new message instance.
     */
    public function __construct($order_details,$reason,$messages)
    {
        //
        $this->order_details = $order_details;
        $this->reason = $reason;
        $this->messages = $messages;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
                    subject: 'Order Inquiry',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
                  view: 'emails.order-inquiry',
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