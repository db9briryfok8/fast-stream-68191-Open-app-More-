<?php
 
$strAccessToken = "YtEkqziWr+71D8rmrS6dcUIvCJ7klheaY8Nsl58kYAWNyVbkWcFZfK0ovOE0K5e3KvR+9UMBrJ9Sdo5nmd4IhfnGeWFzlBjNCbFGL3XjOqDqmf0T0FwvX5zCeMI37401E3zNPT2BBshLMuqZhlXDpwdB04t89/1O/w1cDnyilFU=";
 
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
 
$strUrl = "https://api.line.me/v2/bot/message/reply";
$ch1 = file_get_contents('https://api.thingspeak.com/channels/287070/fields/2/last.txt'); 
$ch2 = file_get_contents('https://api.thingspeak.com/channels/287070/fields/3/last.txt'); 
&ch3 = file_get_contents('https://api.thingspeak.com/channels/287070/fields/4/last.txt'); 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 
if($arrJson['events'][0]['message']['text'] == "help"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "Funtion1 เช็คสถานะ : status \n
  Funtion2 เปิด/ปิด : ch+ช่อง+on, ch+ช่อง+off";
}else if($arrJson['events'][0]['message']['text'] == "status"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "Ch1 : \n Ch2 : \n Ch3";

}else if($arrJson['events'][0]['message']['text'] == "allon"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "Ch1 : On \n
  Ch2 : On \n
  Ch3 : On";
}else{
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ไม่มีคำสั่งต้องการ\n เปิดดูคำสั่งทั้งหมด พิมพ์ help";
}
 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
 
?>
