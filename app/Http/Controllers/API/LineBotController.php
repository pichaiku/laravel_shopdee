<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class LineBotController extends Controller
{
    public function chatbot(Request $request)
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
