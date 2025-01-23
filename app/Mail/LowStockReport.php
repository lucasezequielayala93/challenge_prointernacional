<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LowStockReport extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $articles)
    {
        $this->articles = $articles;
    }

    public function build(): self
    {
        return $this->subject('Reporte de Artículos con Bajo Stock')
            ->view('emails.low_stock_report');
    }
}
