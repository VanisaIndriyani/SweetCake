<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User; // Pastikan model User kamu sesuai dengan tabel tb_users

class VerifySweetCakeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verifyUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;

        // Buat URL verifikasi, misalnya: http://localhost/verify/1/abc123token
        $this->verifyUrl = url('/verify/' . $this->user->id . '/' . $this->user->verification_token);
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Verifikasi Akun Anda di SweetCake')
                    ->from(config('mail.from.address'), config('mail.from.name'))
                    ->view('emails.verify')
                    ->with([
                        'user' => $this->user,
                        'verifyUrl' => $this->verifyUrl,
                    ]);
    }
}
