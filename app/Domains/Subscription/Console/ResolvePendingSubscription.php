<?php

namespace App\Domains\Subscription\Console;

use App\Domains\Subscription\Actions\FindPendingSubscriptions;
use Illuminate\Console\Command;

class ResolvePendingSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:pending-subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pendingSubscription = app()->make(FindPendingSubscriptions::class);
        dd($pendingSubscription);
    }
}
