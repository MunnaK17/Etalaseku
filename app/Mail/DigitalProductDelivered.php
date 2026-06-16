<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DigitalProductDelivered extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public string $downloadUrl;
    public string $productName;
    public string $customerName;
    public string $orderNumber;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->downloadUrl = $order->product->digital_product_link ?? '';
        $this->productName = $order->product->name ?? 'Produk Digital';
        $this->customerName = $order->customer_name ?? 'Pelanggan';
        $this->orderNumber = $order->order_number ?? '';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Produk Digital Anda Sudah Siap - ' . $this->orderNumber,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.digital-product-delivered',
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
