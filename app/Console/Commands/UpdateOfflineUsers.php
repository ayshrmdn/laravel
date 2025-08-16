<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UpdateOfflineUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-offline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update users and admins to offline status if they have been inactive for more than 5 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fiveMinutesAgo = Carbon::now()->subMinutes(5);

        // Update users who have been inactive for more than 5 minutes
        $updatedUsers = User::where('is_online', true)
            ->where('last_seen_at', '<', $fiveMinutesAgo)
            ->update(['is_online' => false]);

        // Update admins who have been inactive for more than 5 minutes
        $updatedAdmins = Admin::where('is_online', true)
            ->where('last_seen_at', '<', $fiveMinutesAgo)
            ->update(['is_online' => false]);

        $this->info("Updated {$updatedUsers} users and {$updatedAdmins} admins to offline status.");

        return 0;
    }
}
