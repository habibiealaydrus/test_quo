<?php

namespace App\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Quotation;
use Illuminate\Http\Request;


class SendQuotationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = \PDF::loadView('content.email.quotation', ['data' => $this->data]);
        
        return $this
                ->to($this->data['receiver'])
                ->subject($this->data['subjekEmail'])
                ->html($this->data['pesanEmail'])
                ->attachData($pdf->output(), $this->data['fileName'], [
                    'mime' => 'application/pdf',
                ]);
    }
}
