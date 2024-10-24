<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmailStatusCron extends Command
{
    
    use \App\Service\SendEmailStatus;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendemailstatus:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command descriptions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
          $this->SendEmailStatusTrait();
            
        
    }
}
