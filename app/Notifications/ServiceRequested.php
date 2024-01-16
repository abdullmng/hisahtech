<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ServiceRequested extends Notification
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
        $service = $this->service;
        $user = $service->user;
        $device = $service->device;
        return (new MailMessage)
                    ->line("Hello {$user->name},")
                    ->line("You have submitted a service request for device:")
                    ->line("Name: {$device->name}.")
                    ->line("Model: {$device->model}.")
                    ->line("Issue as described:")
                    ->line(new HtmlString($service->issue))
                    ->line("you will receive a response from our team via this channel.")
                    ->line('Thank you for using our application!');
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
