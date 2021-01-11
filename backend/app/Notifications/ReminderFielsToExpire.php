<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
class ReminderFielsToExpire extends Notification implements ShouldQueue
{
    use Queueable;
    public $fiels;
    /**
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct( $fiels )
    {
        $this->fiels = $fiels;
    }
    /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function via($notifiable)
    {
        return ['mail'];
    }
    /**
    * Get the mail representation of the notification.
    *
    * @param  mixed  $notifiable
    * @return \Illuminate\Notifications\Messages\MailMessage
    */
    public function toMail($notifiable)
    {
        $conf = (new MailMessage)
            ->subject('Fiels por expirar JGRP!')
            ->greeting('Hola!.')
            ->line('Le informamos que tiene '.$this->fiels->count().' fiels por vencer dentro de 30 días.');

        $conf->salutation('Saludos, '.env('APP_NAME'));
        return $conf;

    }
/**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
