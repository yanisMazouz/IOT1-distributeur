<?php
include("dao.php");
$res=$bdd->query("select id_emplacement from emplacement");
$poid =10000;
while($row=$res->fetch()){
    $poid =10000;
    $id_emplacement=$row['id_emplacement'];
    for($i=180;$i>0;$i--){
        $poid=$poid-rand(200,1000);
        if($poid<0){$poid=0;}
        $correct=$bdd->exec("INSERT INTO information (tt,poid,temperature,humidite) VALUES(\"".date('Y-m-d H:i:s', strtotime("$i hour ago"))."\", $poid, 8,85)");
        $id_info= $bdd->lastInsertId();
        $bdd->exec("INSERT into posseder values ($id_emplacement,$id_info)");
        if($poid==0){$poid=10000;}
    }

}
?>