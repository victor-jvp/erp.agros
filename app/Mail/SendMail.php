<?php

namespace App\Mail;

use App\Especiales;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        $especiales = Especiales::all()->first();
        return $this->from($especiales->mail_username)->subject('Notificación')->view('dynamic_email_template')->with('data', $this->data);
    }
}
