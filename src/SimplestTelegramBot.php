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


private function containsHtml($inputString) {
    $pattern = "/<[^>]*>/";
    if (preg_match($pattern, $inputString))
        return true; 
    else
        return false;
}

public function sendMessage($chat_id, $message_text) {
    $telegram_token = $this->token;
    $parse_mode = $this->containsHtml($message_text)?'HTML':'Markdown';

    $url = 'https://api.telegram.org/bot' . $telegram_token . '/sendMessage';
    $data = [
        'chat_id' => $chat_id,
        'text' => $message_text,
        'parse_mode' => $parse_mode 
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