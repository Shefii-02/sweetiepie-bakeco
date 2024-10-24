<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Log;
use Mail;
use App\Mail\ExceptionOccured;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

        $this->reportable(function (Throwable $e) {
            
            $this->sendEmail($e);
        });
    }
    
   
    
     public function sendEmail(Throwable $exception)
    {
       try {
            $content['message'] = $exception->getMessage();
            $content['file'] = $exception->getFile();
            $content['line'] = $exception->getLine();
            $content['trace'] = $exception->getTrace();
  
            $content['url'] = request()->url();
            $content['body'] = request()->all();
            $content['ip'] = request()->ip();
   
                $sendEmailTo =  env('MAIL_TO_DEV') ?? 'shefii.indigital@gmail.com';
                Mail::to($sendEmailTo)->send(new ExceptionOccured($content));
            
 
        } catch (Throwable $exception) {
            Log::error($exception);
        }
        
        
    }
}
