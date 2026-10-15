<?php

namespace App\Jobs;

use App\Mail\MailForClientCredentials;
use App\Mail\MailForContactUs;
use App\Mail\MailForUserInvitation;
use App\Mail\MailForUserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessSendEMailContactUsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 20;
    public $tries = 3;

    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->data['emails'], $this->data['name'])->send(new MailForContactUs($this->data));
    }
}
