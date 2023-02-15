<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;

use Illuminate\Support\Facades\Log;
use DB;

class LineBotController extends Controller
{   

    public function pushBot(Request $request)
    {
        //Define access token and chanel scret
        $access_token = "nMG7V+hlPWK+9iZAu+fp6ITOZugvpV6D2mxFqtpbd3FDHlW4x25pTo+6ydMOFrGEeQRNLLt2aXQNykt2WLHxOv7RZiLsCuiVzK3UNEh08JmGzHBjcntwSRqt/6EwQRVKcaXA2zwNT6tazsCmQ2ReFgdB04t89/1O/w1cDnyilFU=";
        $channel_secret = "c3cc836abbc74e85377d551f6b8cf3d2";

        //Connect Line API
        $httpClient = new CurlHTTPClient($access_token);
        $bot = new LINEBot($httpClient, ['channelSecret' => $channel_secret]);
                
        //User ID ของคนที่ต้องการให้ bot ส่งข้อความไปหา
        $users = array();
        $users[0] = "U1cf02018781388e0e28ba58444456bd6";
        //$users[1] = ""; 
        //$users[2] = "";
        
        //ข้อความที่ bot ส่งหา users
        $text1 = "ช้อปดี มีโปรโมชันพิเศษสำหรับคุณ";
        $text2 = "ซื้อเสื้อแขนสั้นวันนี้ รับฟรีอีก 1 ตัว";
        $messageData = new TextMessageBuilder($text1, $text2);        
                
        //Push messages to a user
        //$bot->pushMessage("U1cf02018781388e0e28ba58444456bd6",$messageData);  
        $bot->multicast($users,$messageData);                  
                
    }  

    public function AIChatbot(Request $request)
    {
        //Define access token and chanel scret
        $access_token = "nMG7V+hlPWK+9iZAu+fp6ITOZugvpV6D2mxFqtpbd3FDHlW4x25pTo+6ydMOFrGEeQRNLLt2aXQNykt2WLHxOv7RZiLsCuiVzK3UNEh08JmGzHBjcntwSRqt/6EwQRVKcaXA2zwNT6tazsCmQ2ReFgdB04t89/1O/w1cDnyilFU=";
        $channel_secret = "c3cc836abbc74e85377d551f6b8cf3d2";

        //Connect Line API
        $httpClient = new CurlHTTPClient($access_token);
        $bot = new LINEBot($httpClient, ['channelSecret' => $channel_secret]);

        $signature = $request->header('X-Line-Signature');
        $body = $request->getContent();
        try {
            $events = $bot->parseEventRequest($body, $signature);
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
        
        //Check type of message [ text, image, video, etc.]
        foreach ($events as $event) {
            if ($event instanceof TextMessage) {
                                
                $replyToken = $event->getReplyToken();//Token ที่ใช้ส่งข้อความกลับ
                $message = $event->getText();//ข้อความที่ส่งมาจาก users    
                
                if($message == "สวัสดี" || $message == "สวัสดีครับ" || $message == "สวัสดีค่ะ"){
                    //Get user profile
                    $profile = $bot->getProfile($event->getUserId());                        
                    $userData = $profile->getJSONDecodedBody();                
                                        
                    $text1 = "สวัสดีครับคุณ ".$userData['displayName'];
                    $text2 = "กรุณาระบุ ปีที่สร้าง-อายุบ้าน-ระยะทางจาก BTS-จำนวนมินิมาร์ต";
                    $replyData = new TextMessageBuilder($text1, $text2); 

                }else{                                
                    list($year,$age,$distance,$minimart) = explode("-",$message);                        
                    $path = "C:\\xampp\\htdocs\\shopdee\\app\\python\\house_price_predict.py";                    
                            
                    ob_start();
                    passthru("python $path $year $age $distance $minimart");         
                    $result = preg_replace('~[\r\n]+~', '', ob_get_clean());   
                    $replyData = new TextMessageBuilder("ราคาประเมินบ้าน คือ $result บาท");                                
                }

                //Reply a message to a user                
                $response = $bot->replyMessage($replyToken, $replyData);         
                
            }
        }    
                
    }  

    public function databaseChatbot(Request $request)
    {
        //Define access token and chanel scret
        $access_token = "nMG7V+hlPWK+9iZAu+fp6ITOZugvpV6D2mxFqtpbd3FDHlW4x25pTo+6ydMOFrGEeQRNLLt2aXQNykt2WLHxOv7RZiLsCuiVzK3UNEh08JmGzHBjcntwSRqt/6EwQRVKcaXA2zwNT6tazsCmQ2ReFgdB04t89/1O/w1cDnyilFU=";
        $channel_secret = "c3cc836abbc74e85377d551f6b8cf3d2";

        //Connect Line API
        $httpClient = new CurlHTTPClient($access_token);
        $bot = new LINEBot($httpClient, ['channelSecret' => $channel_secret]);

        $signature = $request->header('X-Line-Signature');
        $body = $request->getContent();
        try {
            $events = $bot->parseEventRequest($body, $signature);
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
        
        //Check type of message [ text, image, video, etc.]
        foreach ($events as $event) {
            if ($event instanceof TextMessage) {
                
                //Token ที่ใช้ส่งข้อความกลับ
                $replyToken = $event->getReplyToken();

                //Cet data from a user
                $userID = $event->getUserId();//Line user id
                $message = $event->getText();//ข้อความที่ส่งมาจาก users    
                $timestamp = substr($event->getTimestamp(),0,10);
                
                //Change timestamp to datetime
                $date = new \DateTime("now", new \DateTimeZone("Asia/Bangkok"));
                $date->setTimestamp($timestamp);
                $logDate = $date->format("Y-m-d H:i:s");            
                            
                //Insert received message to database
                $sql = "INSERT INTO chatlog(userID,message,logDate) 
                VALUES ('$userID','$message','$logDate')";
                DB::insert($sql);  

                //Reply a message to a user
                $replyData = new TextMessageBuilder("บันทึกข้อมูลเรียบร้อยแล้ว");
                $bot->replyMessage($replyToken, $replyData);         
                
            }
        }    
                
    }  

    public function imageChatbot(Request $request)
    {        
        $access_token = "nMG7V+hlPWK+9iZAu+fp6ITOZugvpV6D2mxFqtpbd3FDHlW4x25pTo+6ydMOFrGEeQRNLLt2aXQNykt2WLHxOv7RZiLsCuiVzK3UNEh08JmGzHBjcntwSRqt/6EwQRVKcaXA2zwNT6tazsCmQ2ReFgdB04t89/1O/w1cDnyilFU=";
        $channel_secret = "c3cc836abbc74e85377d551f6b8cf3d2";
        
        $httpClient = new CurlHTTPClient($access_token);
        $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));

        $content = $request->getContent();
        $signature = $request->header('X-Line-Signature');        
        $events = $bot->parseEventRequest($content, $signature);
                  

        $replyToken = $events[0]->getReplyToken();        
        $typeMessage = $events[0]->getMessageType();  
        $idMessage = $events[0]->getMessageId(); 

        if($typeMessage == "image"){
                
            $python_file_path = "C:\\xampp\\htdocs\\shopdee\\app\\python\\line_save_image.py";                    
            $image_file_path = "C:\\xampp\\htdocs\\shopdee\\public\\assets\\line\\";
                        
            ob_start();
            passthru("python $python_file_path $access_token $idMessage $image_file_path");
            $result = preg_replace('~[\r\n]+~', '', ob_get_clean());   
            
            if($result=="true"){
                $replyData = new TextMessageBuilder("บันทึกไฟล์ภาพเรียบร้อยแล้ว");  
            }else{
                $replyData = new TextMessageBuilder("ไม่สามารถบันทึกไฟล์รูปภาพได้");
            }
                                    
        }else{            
            $replyData = new TextMessageBuilder("กรุณาเลือกรูปสินค้า".$idMessage);
        }

            
        //Reply a message to a user
        $bot->replyMessage($replyToken,$replyData);
        
    }   


    public function textChatbot(Request $request)
    {
        //Define access token and chanel scret
        $access_token = "nMG7V+hlPWK+9iZAu+fp6ITOZugvpV6D2mxFqtpbd3FDHlW4x25pTo+6ydMOFrGEeQRNLLt2aXQNykt2WLHxOv7RZiLsCuiVzK3UNEh08JmGzHBjcntwSRqt/6EwQRVKcaXA2zwNT6tazsCmQ2ReFgdB04t89/1O/w1cDnyilFU=";
        $channel_secret = "c3cc836abbc74e85377d551f6b8cf3d2";

        //Connect Line API
        $httpClient = new CurlHTTPClient($access_token);
        $bot = new LINEBot($httpClient, ['channelSecret' => $channel_secret]);

        $signature = $request->header('X-Line-Signature');
        $body = $request->getContent();
        try {
            $events = $bot->parseEventRequest($body, $signature);
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
        
        //Check type of message [ text, image, video, etc.]
        foreach ($events as $event) {
            if ($event instanceof TextMessage) {

                $replyToken = $event->getReplyToken();//Token ที่ใช้ส่งข้อความกลับ
                $message = $event->getText();//ข้อความที่ส่งมาจาก users

                if($message == "สวัสดี" || $message == "สวัสดีครับ" || $message == "สวัสดีค่ะ"){                    
                    //ส่งกลับเป็นข้อความ
                    $text = "สวัสดีคร้าบบ";
                    $textMessage = new TextMessageBuilder($text);
        
                    //ส่งกลับเป็นภาพ             
                    $url = str_replace("http","https", $request->root());
                    $originalContentUrl = $url."/assets/product/shirt.png";
                    $previewImageUrl = $url."/assets/product/shirt.png";
                    $imageMessage = new ImageMessageBuilder($originalContentUrl, $previewImageUrl);
        
                    //ส่งกลับสติกเกอร์
                    //https://developers.line.biz/en/docs/messaging-api/sticker-list/#sticker-definitions
                    $packageId = "1070";
                    $stickerId = "17839";
                    $stickerMessage = new StickerMessageBuilder($packageId, $stickerId);                                
        
                    //ส่งกลับเป็นพิกัดละติจูด-ลองจิจูด
                    $placeName = "ที่ตั้งร้าน";
                    $placeAddress = "ร้านช้อปดี";
                    $latitude = 13.778365013248951;
                    $longitude = 100.55670575421117;
                    $locationMessage = new LocationMessageBuilder($placeName, $placeAddress, $latitude ,$longitude);                
        
                    //Create multiple replying messages
                    $replyData =  new MultiMessageBuilder;
                    $replyData->add($textMessage);                
                    $replyData->add($imageMessage);   
                    $replyData->add($stickerMessage); 
                    $replyData->add($locationMessage);                    
                }else{                                
                    $replyData = new TextMessageBuilder("ไม่เข้าใจคำถาม กรุณาสอบถามอีกครั้ง");                    
                }
                                                
                //Reply a message
                $response = $bot->replyMessage($replyToken, $replyData); 
                

            }//if ($event instanceof TextMessage)
            
        }//foreach    

    }    

    
    public function profileChatbot(Request $request){

        //Define access token and chanel scret
        $access_token = "nMG7V+hlPWK+9iZAu+fp6ITOZugvpV6D2mxFqtpbd3FDHlW4x25pTo+6ydMOFrGEeQRNLLt2aXQNykt2WLHxOv7RZiLsCuiVzK3UNEh08JmGzHBjcntwSRqt/6EwQRVKcaXA2zwNT6tazsCmQ2ReFgdB04t89/1O/w1cDnyilFU=";
        $channel_secret = "c3cc836abbc74e85377d551f6b8cf3d2";

        //Connect Line API
        $httpClient = new CurlHTTPClient($access_token);
        $bot = new LINEBot($httpClient, ['channelSecret' => $channel_secret]);

        $signature = $request->header('X-Line-Signature');
        $body = $request->getContent();
        try {
            $events = $bot->parseEventRequest($body, $signature);
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
        
        //Check type of message [ text, image, video, etc.]
        foreach ($events as $event) {
            if ($event instanceof TextMessage) {

                $replyToken = $event->getReplyToken();//Get reply token
                $message = $event->getText();//Get a message from a user

                if($message == "สวัสดี" || $message == "สวัสดีครับ" || $message == "สวัสดีค่ะ"){                    

                    //Get user profile
                    $profile = $bot->getProfile($event->getUserId());                        
                    $userData = $profile->getJSONDecodedBody();
                    // $userData['userId']
                    // $userData['displayName']
                    // $userData['pictureUrl']
                    // $userData['statusMessage']
                    $textReplyMessage = 'สวัสดีครับ คุณ '.$userData['displayName'];             
                    $replyData = new TextMessageBuilder($textReplyMessage);                              
                    
                }else{                                
                    $replyData = new TextMessageBuilder("ไม่เข้าใจคำถาม กรุณาสอบถามอีกครั้ง");                    
                }                

                //Reply message
                $bot->replyMessage($replyToken,$replyData);
             

            }//if ($event instanceof TextMessage)         
        }//foreach
    }


    public function simpleChatbot(Request $request)
    {
        $access_token = "nMG7V+hlPWK+9iZAu+fp6ITOZugvpV6D2mxFqtpbd3FDHlW4x25pTo+6ydMOFrGEeQRNLLt2aXQNykt2WLHxOv7RZiLsCuiVzK3UNEh08JmGzHBjcntwSRqt/6EwQRVKcaXA2zwNT6tazsCmQ2ReFgdB04t89/1O/w1cDnyilFU=";
        $channell_secret = "c3cc836abbc74e85377d551f6b8cf3d2";

        $httpClient = new CurlHTTPClient($access_token);
        $bot = new LINEBot($httpClient, ['channelSecret' => $channell_secret]);

        $signature = $request->header('X-Line-Signature');
        $body = $request->getContent();
        try {
            $events = $bot->parseEventRequest($body, $signature);
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }

        foreach ($events as $event) {
            if (!($event instanceof \LINE\LINEBot\Event\MessageEvent)) {
                continue;
            }
            if (!($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage)) {
                continue;
            }

            $message = $event->getText();

            if($message == "สวัสดี" || $message == "สวัสดีครับ" || $message == "สวัสดีค่ะ"){
                $text = "สวัสดี Shopdee ยินดีต้อนรับ มีอะไรให้ช่วยมั๊ยครับ";
            }else if($message == "ต้องการซื้อเสื้อ" || $message == "เสื้อ" || $message == "ซื้อเสื้อ"){
                $text = "เราขอแนะนำเสื้อแขนยาว ราคา 199 บาท จะ F เลยมั๊ย";
            }else if($message == "ok" || $message == "ได้" || $message == "ครับ"){
                $text = "ขอบคุณที่ซื้อสินค้าเราครับ";
            }
            
            $response = $bot->replyMessage(
                $event->getReplyToken(),
                new TextMessageBuilder($text)
            );
            if (!$response->isSucceeded()) {
                return response('Failed!', 400);
            }
        }


        
        return response('OK', 200);
    }    
}
