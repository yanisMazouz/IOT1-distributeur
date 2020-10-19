<?php 
include("db_connect.php");
$res=$bdd->query("select * from posseder");
var_dump($res->fetchAll());
?>