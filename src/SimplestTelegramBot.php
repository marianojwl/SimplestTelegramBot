<?php
namespace marianojwl {
    class SimplestTelegramBot {
        private $token;
        
        public function __construct($token) {
            $this->token = $token;
        }

        public function receiveMessage() {
            $data = file_get_contents("php://input");
            file_put_contents("log/data.txt",$data);
            $json = json_decode($data,true);
            
            $chat_id = $json["message"]["chat"]["id"];
            $text = $json["message"]["text"];

            return $json;
        }


        public function sendMessage($chat_id, $message_text) {
            $telegram_token = $this->token;
            //$max_message_length = 4096;
            //$message_text = '<b>Bold Text</b> and <i>Italic Text</i> <a href="https://example.com">Visit Example</a>';
            
            $url = 'https://api.telegram.org/bot' . $telegram_token . '/sendMessage';
            $data = [
                'chat_id' => $chat_id,
                'text' => $message_text,
                'parse_mode' => 'HTML',
            ];
            
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => http_build_query($data),
                ],
            ];
            
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            file_put_contents("log/sendMessageResult.txt", serialize($result) );
        }
    }

}