<?php

namespace App\Notifications;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ConsultationReceived extends Notification
{
    use Queueable;

    public function __construct(public Consultation $consultation)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Consultation Request — ' . $this->consultation->full_name)
            ->greeting('New consultation request')
            ->line('Name: ' . $this->consultation->full_name)
            ->line('Email: ' . $this->consultation->email)
            ->line('Phone: ' . ($this->consultation->phone ?? '—'))
            ->line('Company: ' . ($this->consultation->company ?? '—'))
            ->line('Service interest: ' . ($this->consultation->service_interest ?? '—'))
            ->line('Preferred date: ' . ($this->consultation->preferred_date ?? '—'))
            ->line('Message: ' . ($this->consultation->message ?? '—'));
    }
}
