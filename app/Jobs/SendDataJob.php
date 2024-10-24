<?php
    namespace App\Jobs;
    
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Queue\SerializesModels;
    
    class SendDataJob implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
        use \App\Service\SendDataTNG;
        use \App\Service\WebHookUrl;
        use \App\Service\SendEmailStatus;
        
        public function __construct()
        {
            //
        }
    
        public function handle()
        {
            // Call the sendData function
            $this->SendDataTrait();
            $this->GetDataTrait();  //webhook
            $this->SendEmailStatusTrait();
        }
    }
