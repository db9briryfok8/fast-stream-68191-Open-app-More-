<?php
$access_token = 'YtEkqziWr+71D8rmrS6dcUIvCJ7klheaY8Nsl58kYAWNyVbkWcFZfK0ovOE0K5e3KvR+9UMBrJ9Sdo5nmd4IhfnGeWFzlBjNCbFGL3XjOqDqmf0T0FwvX5zCeMI37401E3zNPT2BBshLMuqZhlXDpwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data


$ch1 = file_get_contents('https://api.thingspeak.com/channels/287070/fields/2/last.txt');
$ch2 = file_get_contents('https://api.thingspeak.com/channels/287070/fields/3/last.txt');
$ch3 = file_get_contents('https://api.thingspeak.com/channels/287070/fields/4/last.txt');
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
	
}
echo "OK";
