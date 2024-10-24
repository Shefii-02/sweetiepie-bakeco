<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendDataCron extends Command
{
    
    use \App\Service\SendDataTNG;
    use \App\Service\SendOrderEmail;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'senddata:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
          $this->SendDataTrait();
            
          $this->SendEmailTrait();
        //
       
        
    }
}
