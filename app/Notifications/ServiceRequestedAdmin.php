<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ServiceRequestedAdmin extends Notification
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
        ->subject('Service Requested')
                    ->line("Hello {$notifiable->name},")
                    ->line("There is a new service request, with details below:")
                    ->line("Device: {$device->name}.")
                    ->line("Model: {$device->model}.")
                    ->line("Issue as described:")
                    ->line(new HtmlString($service->issue))
                    ->line("From user:")
                    ->line("Name: {$user->name}")
                    ->line("Email: {$user->email}")
                    ->line("Phone: {$user->phone_number}");
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
