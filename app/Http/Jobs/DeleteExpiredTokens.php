<?php

namespace App\Jobs;

use App\Models\PersonalAccessToken;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Exception;

class DeleteExpiredTokens implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Log::info('foi delete');
        // Deleta tokens expirados
        echo PersonalAccessToken::deleteExpiredTokens();
    }
}
