<?php

namespace App\Jobs;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Mail\UserRegistered as UserRegisteredMail;

class SendUserMailJob extends Job
{

    
    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->queue(new UserRegisteredMail($this->user) );
    }
}
