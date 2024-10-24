<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Mail\EmailCampaign;
use Mail;

class UtilityController extends Controller
{
    
    public function emailCampaign() {
        
        $users = $this->addresses();
        return view('frontend.email-campaign',compact('users'));
    }

    
    public function sendEmail(Request $request) {

        $send_users = [];
        
        if($request->has('users') && count($request->users)) {
            foreach($request->users as $key=>$val) {
                
                list($email,$name) = explode('|',$val);
                
                if(!isset($email) || !isset($name) || trim($name) == '' || !filter_var(trim($email), FILTER_VALIDATE_EMAIL)) 
                    continue;
                    
                $message = str_replace('[NAME]', trim($name), str_replace("\n","<br/>",$request->message));
                
                try {
                    Mail::to(trim($email))->send(new EmailCampaign($message));
                    $send_users[] = ['email'=>trim($email),'name'=>trim($name)];
                }
                catch(\Exception $e) {
                    echo $e->getMessage();
                }
                
            }
        }
        
        $users = $this->addresses();
        
        return view('frontend.email-campaign',compact('send_users','users'));
        
    }
    
    
    public function addresses() {
        
        /*$users = [['email'=>'bijuys@gmail.com','name'=>'Biju Yohannan'],
                    ['email'=>'biju@indigitalgroup.ca','name'=>'Biju Indigital'],
                    ['email'=>'bjooos@gmail.com','name'=>'Bjooos'],
                    ['email'=>'bijuyn@gmail.com','name'=>'Bijuyn'],
                    ['email'=>'cesario@sweetiepiebakeco.ca','name'=>'Cesario Ginjo']
                ];*/
        
        $users = [['email'=>'shelenda@hotmail.com','name'=>'Blenda Wade'],
                    ['email'=>'gurpreetspall@gmail.com','name'=>'Gurpreet Pall'],
                    ['email'=>'saraco1@live.com','name'=>'Anthony Saraco'],
                    ['email'=>'assadihossein1@gmail.com','name'=>'Hossein Nazary'],
                    ['email'=>'hoang_tran81@hotmail.com','name'=>'Tran Huynh'],
                    ['email'=>'isurusidd@gmail.com','name'=>'Isuru Siddiaratchchi'],
                    ['email'=>'mohini.watave@gmail.com','name'=>'Mohini Watave'],
                    ['email'=>'ghassan53@gmail.com','name'=>'Gus Bedaywi'],
                    ['email'=>'gprabhat47@gmail.com','name'=>'Prabhat Gupta'],
                    ['email'=>'rumsha3@gmail.com','name'=>'Rumsha Javaid'],
                    ['email'=>'suranimalfernando@yahoo.com','name'=>'Ukwattge Fernando'],
                    ['email'=>'wirelessdealer@hotmail.com','name'=>'Tony Yammine'],
                    ['email'=>'wuhaibin73@yahoo.com','name'=>'Haibin Wu'],
                    ['email'=>'atiqajav@gmail.com','name'=>'Atiqa Javaid'],
                    ['email'=>'mfadimaskoun@gmail.com','name'=>'Fadi Maskoun'],
                    ['email'=>'saima.kashif04@gmail.com','name'=>'Saima Kashif'],
                    ['email'=>'pranavschadha@gmail.com','name'=>'Vatsala Chadha'],
                    ['email'=>'navid.m@aol.com','name'=>'Navid Mokhtarizadeh'],
                    ['email'=>'kerawallacherag@gmail.com','name'=>'A Kerawalla'],
                    ['email'=>'cesario@indigitalgroup.ca','name'=>'Cesario Ginjo'],
                ];
        
        return $users;
    }
    
}