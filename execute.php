<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$text = trim($text);
$text = strtolower($text);

$response = "";
if(strpos($text, "/start") === 0 ) {
	$response = "Ciao $firstname! \nBenvenuto nel bot di Aldo Giovanni e Giacomo. Qui potrai trovare film, sketch e la biografia del trio comico più famoso d'Italia.";
	sendMsg($chatId, $response);
}

function keyboard($tasti, $text, $cd){
$tasti2 = $tasti;
    
$tasti3 = json_encode($tasti2);
    
    if(strpos($text, "\n")){
        $text = urlencode($text);
    }

apiRequest("sendMessage?text=$text&parse_mode=Markdown&chat_id=$cd&reply_markup=$tasti3");
}

function inlinekeyboard($menud, $chat, $text){
$menu = $menud;
    
    if(strpos($text, "\n")){
        $text = urlencode($text);
    }
    
    $d2 = array(
    "inline_keyboard" => $menu,
    );
    
    $d2 = json_encode($d2);
    
    return apiRequest("sendMessage?chat_id=$chat&parse_mode=Markdown&text=$text&reply_markup=$d2");
}

function sendMsg($id, $msg) {
	$token = "1260201015:AAEI-9jc-CEZwyhaMKWTGdSZgPipgysnErk";

	$data = [
		'text' => $msg,
		'chat_id' => $id
	];

	file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
}
