<?php
session_start() ; 
    require_once "config/connect.php" ; 
    $postData = $_POST ; 

if (!isset($postData['id']))
{
	echo('Il faut un identifiant valide pour supprimer une recette.');
    return;
}	

    $id = $postData['id'] ; 
    $produit = $db->prepare('SELECT qte FROM produit WHERE idPdr = :id ');
    $produit->execute([
        'id' => $id ,
    ]); 
    $produit = $produit->fetch() ; 
    if(($produit['qte']) > 0 ){
            $qte = $produit['qte'] - 1 ; 
            $sql = "UPDATE produit SET qte = :qte WHERE idPdr = :id " ; 
            $query = $db->prepare($sql) ; 
            $query->execute([
                'qte' => $qte ,
                'id'  => $postData['id'] , 
            ]) ; 
            header('Location:produit.php') ;
    }else if (($produit['qte']) == 0 ){
            $query = $db->prepare("DELETE FROM produit WHERE idPdr = :id") ; 
            $query->execute([
                'id' => $postData['id'],
            ]);
            header('Location:produit.php') ;

    }

?>