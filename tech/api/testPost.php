<?php
  $url = 'http://127.0.0.1/tech/api/post.php';
  $data = array('poid' => '3', 'temperature' => '20', 'humidite' => '8', 'id_emplacement' => '3005');
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  if ($result === FALSE) { }
  var_dump($result);

?>