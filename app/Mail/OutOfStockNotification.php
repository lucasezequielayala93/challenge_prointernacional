<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OutOfStockNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Article $article)
    {
        $this->article = $article;
    }

    public function build(): self
    {
        return $this->subject('Artículo sin stock: ' . $this->article->name)
            ->view('emails.out_of_stock');
    }
}