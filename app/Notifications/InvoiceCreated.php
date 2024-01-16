<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceCreated extends Notification
{
    use Queueable;


    public $invoice;
    /**
     * Create a new notification instance.
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $invoice = $this->invoice;
        $amount = number_format($invoice->amount,2);
        $app_name = config('app.name');
        $device = $invoice->item_type == 'device' ? $invoice->item : $invoice->item->device;
        return (new MailMessage)
                    ->subject('New Invoice')
                    ->line("Dear {$notifiable->name}")
                    ->line("you are receiving this because you have a new invoice with details below,")
                    ->line("Amount: NGN {$amount}.")
                    ->line("Device: {$device->name}.")
                    ->line("Description: {$invoice->description}")
                    ->line("Generated on {$invoice->created_at->format('y-m-d h:ia')}")
                    ->line("Click the button below to view invoice and make payment")
                    ->action('View Invoice', url("/user/invoices/{$invoice->id}"))
                    ->line("Thank you for choosing {$app_name}!");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
