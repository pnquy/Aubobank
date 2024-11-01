<?php

namespace App\Domains\Auth\Notifications\Frontend;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class ResetPasswordNotification.
 */
class ResetPasswordNotification extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->subject(__('Reset Password Notification'))
    //         ->line(__('You are receiving this email because we received a password reset request for your account.'))
    //         ->action(__('Reset Password'), route('frontend.auth.reset_password_view', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()]))
    //         ->line(__('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
    //         ->line(__('If you did not request a password reset, no further action is required.'));
    // }
    public function toMail($notifiable)
    {
        $resetPasswordUrl = route('frontend.auth.reset_password_view', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()]);

        return (new MailMessage)
            ->subject(__('Yêu cầu reset mật khẩu tài khoản'))
            ->markdown('frontend.auth.email.reset_password_email', [
                'token' => $this->token,
                'resetPasswordUrl' => $resetPasswordUrl,
            ])
            ->line(__('You are receiving this email because we received a password reset request for your account.'))
            ->line(__('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
            ->line(__('If you did not request a password reset, no further action is required.'));
    }
}
