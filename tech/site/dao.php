<?php
include("db_connect.php");

function recupInfo ($id_emplacement){
    global $bdd;
    $query="SELECT  poid, temperature, humidite 
            from emplacement natural join posseder natural join information 
            where id_emplacement=$id_emplacement order by tt desc limit 1";
    $sth = $bdd->prepare($query);
    $sth->execute();
    $result = $sth->fetchAll();
    return $result;
}

function recupFrigo(){
    global $bdd;
    $query = "SELECT * from frigo natural join emplacement";
    $reponse=$bdd->query($query);
    $result=array();
    while($row=$reponse->fetch()){
        $infos=recupInfo($row['id_emplacement']);
        $result[$row['id_emplacement']]['adresse']=$row['adresse'];
        $result[$row['id_emplacement']]['aliment']=$row['aliment'];
        $result[$row['id_emplacement']]['latitude']=$row['latitude'];
        $result[$row['id_emplacement']]['longitude']=$row['longitude'];
        if(!empty($infos)){
            $result[$row['id_emplacement']]['poid']=$infos[0]['poid'];
            $result[$row['id_emplacement']]['temperature']=$infos[0]['temperature'];
            $result[$row['id_emplacement']]['humidite']=$infos[0]['humidite'];
        }
    }
    return $result;
}

function classer($frigos){
    $res=array();
    foreach($frigos as $val){
        $res[$val['adresse']][]=$val;
    }
    return $res;
}


function frigos(){
    global $bdd;
    $emplacement = array();
    $query="select * from frigo";
    $reponse = $bdd->query($query);
    while ($row = $reponse->fetch()){
        $emplacement[] = $row;
    }
    $reponse->closeCursor();
    return $emplacement;
}
function adresse($id_frigo){
  global $bdd;
  $query="select adresse from frigo where id_frigo =$id_frigo";
  $reponse = $bdd->query($query);
  $reponse=$reponse->fetchAll();
  return $reponse[0]['adresse'];
}


function infosGraphe($id_frigo,$type){
    global $bdd;
    $resultat=array();
    if($type=="true"){
      $reponse=$bdd->query("SELECT id_emplacement from frigo natural join emplacement where id_frigo=$id_frigo");
      $boxes=$reponse->fetchAll();
        for($i=24; $i>0; $i--){
          $resultat[date('D H:00', strtotime("$i hour ago" ))]['total']=0;
          $j=$i+2;
          foreach($boxes as $boxe){
            $reponse=$bdd->query("SELECT poid,tt,aliment from emplacement natural join posseder natural join information 
                                  where id_emplacement=".$boxe['id_emplacement']." 
                                  and tt >= \"".date('Y-m-d H', strtotime("$j hour ago" ))."\"
                                  and tt < \"".date('Y-m-d H', strtotime("$i hour ago" ))."\"
                                  ORDER by tt ASC");
            $row=$reponse->fetch();
            $pt=$row['poid'];
            $resultat[date('D H:00', strtotime("$i hour ago" ))][$row['aliment']]=0;
            while($row=$reponse->fetch()){
              $tmp=$pt-$row['poid'];
              $pt=$row['poid'];
              if($tmp>0){
                $resultat[date('D H:00', strtotime("$i hour ago" ))]['total']+=$tmp;
                $resultat[date('D H:00', strtotime("$i hour ago" ))][$row['aliment']]+=$tmp;
              }
            }
          }
        }
      }
      else{
        $reponse=$bdd->query("SELECT id_emplacement from frigo natural join emplacement where id_frigo=$id_frigo");
        $boxes=$reponse->fetchAll();
          for($i=7; $i>0; $i--){
            $resultat[date('D', strtotime("$i day ago" ))]['total']=0;
            $j=$i+1;
            foreach($boxes as $boxe){
              $reponse=$bdd->query("SELECT poid,tt,aliment from emplacement natural join posseder natural join information 
                                    where id_emplacement=".$boxe['id_emplacement']." 
                                    and tt >= \"".date('Y-m-d H', strtotime("$j day ago" ))."\"
                                    and tt < \"".date('Y-m-d H', strtotime("$i day ago" ))."\"
                                    ORDER by tt ASC");
              $row=$reponse->fetch();
              $pt=$row['poid'];
              $resultat[date('D', strtotime("$i day ago" ))][$row['aliment']]=0;
              while($row=$reponse->fetch()){
                $tmp=$pt-$row['poid'];
                $pt=$row['poid'];
                if($tmp>0){
                  $resultat[date('D', strtotime("$i day ago" ))]['total']+=$tmp;
                  $resultat[date('D', strtotime("$i day ago" ))][$row['aliment']]+=$tmp;
                }
              }
            }
          }
        }
    return $resultat;
  }
?>