<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ServiceUpdatedNotification extends Notification
{
    use Queueable;

    public $service;
    /**
     * Create a new notification instance.
     */
    public function __construct($service)
    {
        $this->service = $service;
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
        return (new MailMessage)
                    ->greeting("Hello {$notifiable->name}")
                    ->line("Your service request with detail below, has an update")
                    ->line("Name: {$this->service->device->name}.")
                    ->line("Model: {$this->service->device->model}.")
                    ->line("Issue as described:")
                    ->line(new HtmlString($this->service->issue))
                    ->line("Status: {$this->service->status}");
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
