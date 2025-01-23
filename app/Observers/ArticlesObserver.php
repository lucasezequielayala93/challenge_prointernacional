<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;
use App\Models\Article;
use App\Mail\OutOfStockNotification;
use Illuminate\Support\Facades\Mail;

class ArticlesObserver
{
    public function updated(Article $article): void
    {
        if ($article->isDirty('stock') && $article->stock == 0) {
            $admins = User::where('is_admin', true)->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new OutOfStockNotification($article));
            }
        }
    }
}
