<?php

namespace App\Console\Commands;

use App\Models\InclusiveApplication;
use App\Models\Store;
use App\Notifications\InclusiveExpiredNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class CheckInclusiveExpiry extends Command
{
    protected $signature = 'inclusive:check-expiry';

    protected $description = 'Downgrade expired inclusive sellers to Free plan';

    public function handle(): int
    {
        $this->info('Checking expired inclusive sellers...');

        $expiredStores = Store::where('is_inclusive_seller', true)
            ->where('plan', 'pro')
            ->where('plan_expires_at', '<=', now())
            ->get();

        if ($expiredStores->isEmpty()) {
            $this->info('No expired inclusive sellers found.');
            return self::SUCCESS;
        }

        foreach ($expiredStores as $store) {
            $this->info("Downgrading store: {$store->name} (ID: {$store->id})");

            $store->update([
                'is_inclusive_seller' => false,
                'plan' => 'free',
                'plan_expires_at' => null,
            ]);

            if ($store->user) {
                Notification::send($store->user, new InclusiveExpiredNotification($store));
            }
        }

        $this->info("Downgraded {$expiredStores->count()} expired inclusive seller(s).");
        return self::SUCCESS;
    }
}