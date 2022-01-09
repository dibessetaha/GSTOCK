<?php
session_start() ; 
    require_once "config/connect.php" ; 


    

    $idPdr = $_POST['idPdr'] ; 
    $idCli = $_POST['idCli'] ; 
    $date = $_POST['date'] ; 
   // $produitID = $_POST['produitID']  ;
  

    $prod = $db->prepare("SELECT * FROM produit p JOIN categorie c WHERE idPdr = :idPdr AND p.idCat_categorie = c.idCat ") ;
    $prod->execute([
        'idPdr' => $idPdr,
    ]);
    $prod = $prod->fetch(PDO::FETCH_ASSOC) ; 
 

    $cli = $db->prepare("SELECT * FROM client WHERE idCli = :idCli") ; 
    $cli->execute([
        'idCli' => $idCli ,
    ]);
    $cli = $cli->fetch(PDO::FETCH_ASSOC) ; 

    

    
    //insertion du commande dans la table commande ; 

    $selectFromCmd = $db->query("SELECT * FROM commande") ; 
    $selectFromCmd = $selectFromCmd->fetchAll() ;

    if(empty($selectFromCmd)){
        if(isset($idCli)){
            $commande = $db->prepare('INSERT INTO commande(dateCmd,idCli_Client) VALUES(:dateCmd,:cli)  ') ; 
            $commande->execute([
                    'dateCmd' => $date,
                    'cli' => $idCli,
                    
            ]);
    
        }

    }
    

    
 

    //$Taille = ['M','XS','S','XL','XXL'] ; 

 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site- Gestion de Stock</title>
    <style>
        .content{
            width: 70%;
            height : 20%;
            margin : auto ;
        }
    </style>
</head>
<body>
    <?php require_once('navbar.php') ;?>
    <div class="content">
        <br>
            <div class="row">
            <form action="panier.php" method = post>
                <input type="hidden" name="idPdr" value="<? echo $prod['idPdr'] ?>">
                <input type="hidden" name="idCli" value="<? echo $cli['idCli'] ?>">
                <input type="hidden" name="date" value="<? echo $date ?>">
                <div class="card mb-3">
                    <img class="card-img-top" style="height:900px" src="<?php echo $prod['screenshot']; ?>" alt="image product">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $prod['nom_produit']; ?> </h5>
                        <p class="card-text"><? echo $prod['discription'] ?> </p>
                        <p class="card-text">Etat en stock : 
                            <?php if(($prod['qte']) > 0 ) :?>
                                <span class="badge bg-success"><? echo 'En stock' ;  ?></span>
                            <?else : ?>
                                <span class="badge bg-danger"><? echo 'epuisee' ;  ?></span>
                            <? endif ;?> 
                        </p>
                        <p class="card-text"><small class="text-muted"><?php echo $prod['designation'].'--'.(date('Y/m/d h:i:s a ', time())) ?></small></p>
                        <p class="card-text">Prix : <?php echo $prod['prixVente'] ?> DHs</p>
                        <label for="qteVente" class="form-label">Quantite : </label>
                        <input type="number" class="form-control" name="qteVente" min=1 max="<? echo($prod['qte']) ?>"  required >
                        <br>
                        <a href="panier.php"><button type="submit" name="panier" class="btn btn-outline-success"> <i class='fas fa-cart-plus'></i> Ajouter au panier !</button></a>
                    </div>

                    </div>

            </form>
            <br><br><br>
            <a href="choice_clients.php"><button type="submit" name="retour" class="btn btn-outline-danger"> <i class='fas fa-prescription-bottle-alt'></i> Supprimer la Commande</button></a>

</body>
</html>