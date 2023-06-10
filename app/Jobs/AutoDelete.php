<?php

namespace App\Jobs;

use App\Models\Consult;
use App\Models\Reference;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoDelete implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        foreach (User::all() as $user) {
            if ($user->hasExpired()) {
                $user->delete();
            }
        }
        foreach (Reference::all() as $ref){
            if($ref->hasExpired()){
                $ref->delete();
            }
        }
        foreach (Consult::all() as $consult){
            if($consult->hasEpired()){
                $consult->delete();
            }
        }
    }
}
