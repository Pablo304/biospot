<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendWhatsappMessage //implements ShouldQueue
{
    use Queueable;

    protected string $sendUrl;
    protected bool $enabled;
    protected string $securityToken;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $phone,
        public string|array $message
    )
    {
        $this->sendUrl = config('services.whatsapp.send_url');
        $this->enabled = config('services.whatsapp.enabled');
        $this->securityToken = config('services.whatsapp.security_token');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->enabled) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->sendUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $this->message,
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/json",
                    "Client-Token: " . $this->securityToken
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
        }
    }
}
