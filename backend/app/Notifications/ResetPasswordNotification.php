<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;


use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Config_model;

class ResetPasswordNotification extends ResetPassword
{
    use Queueable;

    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $token )
    {
        $this->token = $token;
        $configs = Config_model::all();
        
        $x = [];
        foreach ($configs as $conf) {
            
            config( [ $conf->key => $conf->value ]);
        }

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

        
        return (new MailMessage)
            ->subject('Recuperar contraseña')
            ->greeting('Hola')
            ->line('Estás recibiendo este email porque se ha solicitado un cambio de contraseña para tu cuenta.')
            ->action('Recuperar contraseña', route('password.reset', [$this->token]))
            ->line('Si no has solicitado un cambio de contraseña, puedes ignorar o eliminar este e-mail.')
            ->salutation('Saludos,')
            ->salutation(config('app_name'));
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
