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


header("Content-Type: application/json");

$parameters = array('chat_id' => $chatId, "text" => $text);

$parameters["method"] = "sendMessage";
$keyboard = ['inline_keyboard' => [[['text' =>  '🎬Film🎬', 'url' => 'https://www.mediasetplay.mediaset.it/video/treuominieunagamba/tre-uomini-e-una-gamba_F007938601000101']]]];
$keyboard = ['inline_keyboard' => [[['text' =>  '🎭Sketch🎭', 'url' => 'https://www.youtube.com/user/aggcanaleufficiale']]]];
$parameters["reply_markup"] = json_encode($keyboard, true);
echo json_encode($parameters);

$response = "";
if(strpos($text, "/start") === 0 ) {
	$response = "Ciao $firstname! \nBenvenuto nel bot di Aldo Giovanni e Giacomo. Qui potrai trovare film, sketch e la biografia del trio comico più famoso d'Italia.";
	sendMsg($chatId, $response);
}


function sendMsg($id, $msg) {
	$token = "1260201015:AAEI-9jc-CEZwyhaMKWTGdSZgPipgysnErk";

	$data = [
		'text' => $msg,
		'chat_id' => $id
	];

	file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
}
