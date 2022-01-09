<?php
session_start() ; 
    require_once "config/connect.php" ; 

    $name = $_POST['name'] ; 
    $adresse = $_POST['adresse'] ; 
    $numTele = $_POST['numTele'] ; 
    $email = $_POST['email'] ; 
    $id = $_POST['edit'] ; // id est passer hidden dans une input pr garder le fournisseur 

    $insertclient = $db->prepare("UPDATE fournisseur SET nomFrns = :nom, emailFrns = :email, adresseFrns = :adresse, numTeleFrns = :numTele WHERE idFrns = :id") ;
    $insertclient->execute([
        'nom' => $name , 
        'email' => $email , 
        'adresse' => $adresse , 
        'numTele' => $numTele , 
        'id' => $id,

    ]);

    header('Location:fournisseur.php');

?>