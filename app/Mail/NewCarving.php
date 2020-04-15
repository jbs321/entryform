<?php

namespace App\Mail;

use App\Carving;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewCarving extends Mailable
{
    use Queueable, SerializesModels;

    protected $carving;

    /**
     * NewCarving constructor.
     *
     * @param Carving $carving
     */
    public function __construct(Carving $carving)
    {
        $this->carving = $carving;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('emails.newcarving', ['carving' => $this->carving, 'user' => $this->carving->user]);
    }
}
