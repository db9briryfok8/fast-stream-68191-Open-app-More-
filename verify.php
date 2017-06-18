<?php
$access_token = 'YtEkqziWr+71D8rmrS6dcUIvCJ7klheaY8Nsl58kYAWNyVbkWcFZfK0ovOE0K5e3KvR+9UMBrJ9Sdo5nmd4IhfnGeWFzlBjNCbFGL3XjOqDqmf0T0FwvX5zCeMI37401E3zNPT2BBshLMuqZhlXDpwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

