<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\LowStockReport;

class SendLowStockReport extends Command
{
    protected $signature = 'stock:low-report';

    protected $description = 'Send a daily report to administrators of articles with stock less than 10';

    public function handle(): void
    {
        $lowStockArticles = Article::where('stock', '<', 10)->get();

        if ($lowStockArticles->isEmpty()) {
            $this->info('No articles with low stock.');
            return;
        }

        $admins = User::where('is_admin', true)->get();

        if ($admins->isEmpty()) {
            $this->info('No administrators found.');
            return;
        }

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new LowStockReport($lowStockArticles));
        }

        $this->info('Low stock report sent successfully to administrators.');
        return;
    }
}
