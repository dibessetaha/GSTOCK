<?php



    
    
    
    
    require_once 'config/connect.php' ; 



    $achat = $db->query("SELECT * FROM achats"); 
    $achat = $achat->fetchAll();

    foreach($achat as $v){
        $idPdr = $v['idPrd_Produit'] ; 
        $prod = $db->prepare("SELECT * FROM produit WHERE idPdr=:id") ; 
        $prod->execute([
            'id'=> $idPdr,
        ]);
        $prod = $prod->fetch(PDO::FETCH_ASSOC);
        $idPdr = $prod['idPdr'] ; 
        $qteInitial = $prod['qte'];
        $sql = "UPDATE produit SET qte = :qte WHERE idPdr = :id" ; 
        $update = $db->prepare($sql) ; 
        $update->execute([
            'qte' =>   ($qteInitial + $v['qteAchat'] ) , 
            'id' => $idPdr , 
        ]);
    }

    $idAppro = $_POST['idAppro'] ; 
       

        
  
    


        $sql1 = "SELECT * FROM approvisionnement a JOIN fournisseur f WHERE a.idFrns_Frns = f.idFrns  AND a.idAppro = :id" ; 
        
        $fullTables = $db->prepare($sql1);
        $fullTables->execute([
            'id' => $idAppro , 
        ]) ; 
        $fullTables = $fullTables->fetch(PDO::FETCH_ASSOC) ; 


        // Selection des champs du table produit pour les afficher dans la formulaire
        
        $produit = $db->prepare('SELECT * FROM achats a JOIN produit p  JOIN categorie c  WHERE a.idPrd_produit = p.idPdr AND c.idCat = p.idCat_categorie') ; 
        $produit->execute();
        $produit = $produit->fetchAll() ; 

  
       

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site- Gestion de Stock</title>
    <style>
        img{
            width: 40px;
            height : 40px;
        }
    </style>
</head>
<body>
    <?php require_once('navbar.php') ;?>
    <div class="container">
    <div class="card">
            <div class="card-body">
                <h1><img src="images/logo.png" alt="logo"></h1>
                <h3 class="card-title">Facture Num : <?echo rand(10,15000000) ;?> le : <?echo (date('Y/m/d h:i:s a ', time()));?> </h3>
                <p class="text-muted" >Validation d'achat .</p>
                <!-- les infoemations du client -->
                <p class="card-text"><b>Fournisseur : </b><? echo $fullTables['nomFrns'];?></p>
                <p class="card-text"><b>Email </b> : <? echo $fullTables['emailFrns'];?></p>
                <p class="card-text"><b>Adresse </b> : <? echo $fullTables['adresseFrns'];?></p>
                <p class="card-text"><b>numero de telephone</b> : <? echo $fullTables['numTeleFrns'];?></p>
                <p class="card-text"><b>Achat Effectuer en</b> : <? echo $fullTables['dateAchat'];?></p>
                <!-- about product afficher -->
                <? $i = 1;  $total = 0 ; ?>
                <h3 class="card-title">Les Produits :</h3>
                <? foreach($produit as $produit) :?>
                    <p class="card-text"><b>    Le <?echo 'Produit '.$i?></b> : <? echo $produit['nom_produit'];?></p>
                    <p class="card-text"><b>    reference</b> : <? echo $produit['reference'];?></p>
                    <p class="card-text"><b>    categorie</b> : <? echo $produit['discription'];?></p>
                    <p class="card-text"><b>    quantite</b> : <? echo $produit['qteAchat'] ;?></p>
                    <p class="card-text"><b>    Prix</b> : <? echo ($produit['prixAchat'] * $produit['qteAchat']);?> DHs</p>
                    <?php $total += $produit['prixAchat'] * $produit['qteAchat'] ; ?>
                    <? $i++ ;?>
                <? endforeach ?>  
                    <strong class="text-muted">Total = <? echo $total ?> DHs</strong>
                    <p class="text-muted">Merci Mr/Mdm. <?echo $fullTables['nomFrns']; ?></p>
                    
            </div>
        </div>
            
        </div>
      
    </div>

    <?php

            $del = $db->prepare("DELETE  FROM achats") ; 
            $del->execute() ; 
            
            $del = $db->prepare("DELETE  FROM approvisionnement") ; 
            $del->execute() ; 

    ?>
</body>
</html>