<?php
session_start() ; 
    require_once "config/connect.php" ; 

    $name = $_POST['name'] ; 
    $adresse = $_POST['adresse'] ; 
    $numTele = $_POST['numTele'] ; 
    $email = $_POST['email'] ; 
    $id = $_POST['edit'] ; // id est passer hidden dans une input pr garder le client 

    $insertclient = $db->prepare("UPDATE client SET nomCli = :nom, emailCli = :email, adresseCli = :adresse, numTelCli = :numTele WHERE IdCli = :id") ;
    $insertclient->execute([
        'nom' => $name , 
        'email' => $email , 
        'adresse' => $adresse , 
        'numTele' => $numTele , 
        'id' => $id,

    ]);

    header('Location:client.php');

?>