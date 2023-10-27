<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\VerificationEmailNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendVerificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public User $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $hashed = md5($this->user->id . env('JWT_ALGO'));
        $expire = strtotime(Carbon::now()->addDay());
        $query = "code=$hashed&expire=$expire";
        $this->user->notify(new VerificationEmailNotification($query));
        // <------ add notify admin via discord webhook
    }
}
