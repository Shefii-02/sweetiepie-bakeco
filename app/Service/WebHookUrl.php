<?php
namespace App\Service;

trait WebHookUrl{

      public function GetDataTrait(){
          
           $apiDomain = env('TNG_API_DOMAIN'); 
            $url = $apiDomain.'/api/website/action-activity';
            $post = [];
            
            try{
                $data = CurlSendPostRequest($url,$post);
                $data_check = json_decode($data);
               
                    if(count($data_check->data) > 0){
                        action_activity_getdata($data);
                        return response()->json(['success' => true,'message' => 'Successfully Updated'], 200);
                    }
                    else
                    {
                      return response()->json(['success' => true,'message' => 'No more data for updation'], 200);
                    }

                return response()->json(['success' => false,'message' => 'Somthing Wrong Data'], 500);
            }
            catch(Exception $e){
                print_r($e);
                die();
            }
      }
}