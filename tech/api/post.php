<?php
  // Se connecter à la base de données
  include("db_connect.php");
  $request_method = $_SERVER["REQUEST_METHOD"];
  switch($request_method){
      case 'POST':
        addInfo();
        break;
    default:
      header("HTTP/1.0 405 Method Not Allowed");
      break;
  }
  function addInfo(){
    global $bdd;
    $poid=$_POST['poid'];
    $temperature=$_POST['temperature'];
    $humidite=$_POST['humidite'];
    $id_emplacement=$_POST['id_emplacement'];
    $correct=$bdd->exec("INSERT INTO information (tt,poid,temperature,humidite) VALUES( CURRENT_TIMESTAMP, ".$poid.",". $temperature.",".$humidite.")");
    $id_info= $bdd->lastInsertId();
    $correct=$bdd->exec('INSERT into posseder values ('.$id_emplacement.','.$id_info.')') && $correct;
  if($correct){
    $response=array(
      'status' => 1,
      'status_message' =>'info ajoute avec succes.'
    );
  }
  else{
    $response=array(
      'status' => 0,
      'status_message' =>'ERREUR!'. mysqli_error($dbb)
    );
  }
  header('Content-Type: application/json');
  echo json_encode($response);
}

  
?>
