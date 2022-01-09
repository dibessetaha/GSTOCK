<?php
 
try{
    $db = new PDO('mysql:host=localhost;dbname=GESTION_DE_STOCK;charset=utf8','root','root',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]) ; 
}catch(Exception $e){
    die('Erreur : '.$e->getMessage()) ; 

}

?>