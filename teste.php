<?php


$mensagem = "Lorem *ipsum dolor sit amet*, consectetur adipiscing elit. Integer suscipit erat quis tristique scelerisque. Vivamus posuere fermentum elit, eu interdum urna. Praesent tristique viverra iaculis. Integer vehicula augue at leo elementum, vitae suscipit eros ullamcorper. ";

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "v4.chatpro.com.br/chatpro-uh926l6cl9/api/v1/send_message",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\r\n  \"menssage\": \"".$mensagem."\",\r\n  \"number\": \"17981251907\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "Authorization: 09t63pvr704gs0mcz6x5vliw6bj4cr",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}


?> 