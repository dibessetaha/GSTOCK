

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <style>
        img{
            width: 40px;
            height : 40px;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="card">
            <div class="card-body">
                <h3 class="card-title">Facture Num : <?echo rand(10,15000000) ;?> le : <?echo (date('Y/m/d h:i:s a ', time()));?> </h3>
                <p class="text-muted" >Validation de vente .</p>
                <!-- les infoemations du client -->
                <p class="card-text"><b>Client : </b><? echo $fullTables['nomCli'];?></p>
                <p class="card-text"><b>Email du Client</b> : <? echo $fullTables['emailCli'];?></p>
                <p class="card-text"><b>Adresse Du Client</b> : <? echo $fullTables['adresseCli'];?></p>
                <p class="card-text"><b>numero de telephone</b> : <? echo $fullTables['numTelCli'];?></p>
                <p class="card-text"><b>Commande Effectuer en</b> : <? echo $fullTables['dateCmd'];?></p>
                <!-- about product afficher -->
                <? $i = 1;  $total = 0 ; ?>
                <h3 class="card-title">Les Produits :</h3>
                <? foreach($produit as $produit) :?>
                    <p class="card-text"><b>    Le <?echo 'Produit '.$i?></b> : <? echo $produit['nom_produit'];?></p>
                    <p class="card-text"><b>    reference</b> : <? echo $produit['reference'];?></p>
                    <p class="card-text"><b>    categorie</b> : <? echo $produit['discription'];?></p>
                    <p class="card-text"><b>    quantite</b> : <? echo $produit['qteVente'] ;?></p>
                    <p class="card-text"><b>    Prix</b> : <? echo ($produit['prixVente'] * $produit['qteVente']);?> DHs</p>
                    <?php $total += $produit['prixVente'] * $produit['qteVente'] ; ?>
                    <? $i++ ;?>
                <? endforeach ?>  
                    <strong class="text-muted">Total = <? echo $total ?> DHs</strong>
                    <p class="text-muted">Merci Mr/Mdm. <?echo $fullTables['nomCli']; ?></p>
                    
            </div>
        </div>
            
        </div>
      
    </div>

    <?php

            $del = $db->prepare("DELETE  FROM vente") ; 
            $del->execute() ; 
            
            $del = $db->prepare("DELETE  FROM commande") ; 
            $del->execute() ; 

    ?>
</body>
</html>