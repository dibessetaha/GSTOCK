<?php
    session_start() ; 

    require_once "config/connect.php" ; 

    if(isset($_POST['produit_rechercher'])){
        $recherch = $_POST['produit_rechercher'] ; 

        $prod = $db->prepare("SELECT * FROM produit p INNER JOIN categorie c WHERE (nom_produit = :nom OR reference = :ref) AND p.idCat_categorie = c.idCat ") ; 
        $prod->execute([
            'nom' => $recherch , 
            'ref' => $recherch,
        ]);
        $prod = $prod->fetch(PDO::FETCH_ASSOC) ; 

        if(empty($prod)){
            $errorMessage = "Le produit n'existe pas" ; 
        }
    }

    if(isset($_REQUEST['del'])){
        $id = $_GET['del'] ; 
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
                    'id'  => $_GET['del'] , 
                ]) ; 
                header('Location:produit.php');
            }else if (($produit['qte']) == 0 ){
                $query = $db->prepare("DELETE FROM produit WHERE idPdr = :id") ; 
                $query->execute([
                    'id' => $_GET['del'],
                ]);
                header('Location:produit.php');
            }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site- Gestion de Stock</title>
</head>
<body>
    <?php require_once('navbar.php') ;?>
    <div class="container">
    <?php if(isset($errorMessage)) : ?>
        <div class="row mt-3">
                <div class="alert alert-warning" role="alert">
                    <?php echo $errorMessage ;  ?>
                </div>
                <a href="produit.php"><button type="button"  class="btn btn-outline-dark"><i class="fa fa-mail-reply"></i></button></a> 
        </div>
        <?php else : ?>
            <div class="row mt-3">
                    <table class="table table-striped ">
                            <thead>
                                <th>Image</th>
                                <th>Code Article</th>
                                <th>Nom du Produit</th>
                                <th>Quantite</th>
                                <th>Prix d'achat</th>
                                <th>Prix de vente</th>
                                <th>Etat en stock</th>
                                <th>Categorie</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="<?php echo $prod['screenshot']; ?>" alt="image du produit"  class="image_product "></td>
                                    <td><?php echo $prod['reference']; ?> </td>
                                    <td><?php echo $prod['nom_produit']; ?> </td>
                                    <td><?php echo $prod['qte']; ?> </td>
                                    <td><?php echo $prod['prixAchat']; ?> </td>
                                    <td><?php echo $prod['prixVente']; ?> </td>
                                    <td>
                                        <?php if(($prod['qte']) > 0 ) :?>
                                            <span class="badge bg-success"><? echo 'En stock' ;  ?></span>
                                            <?else : ?>
                                                <span class="badge bg-danger"><? echo 'epuisee' ;  ?></span>
                                        <? endif ;?>
                                    </td>
                                    <td><?php echo $prod['designation'].'/'.$prod['discription']; ?> </td>
                                    <td>
                                        <a href="recherche_produit.php?del=<?echo $prod['idPdr']?>"><button class="btn btn-danger"><i  class="fa fa-trash-o "></i></button></a>
                                        <a href="update_produit.php?edit=<?echo$prod['idPdr']?>"><button class="btn btn-primary"><i  class="fa fa-edit "></i></button></a>           
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                    <a href="produit.php"><button type="button"  class="btn btn-outline-dark"><i class="fa fa-mail-reply"></i></button></a> 

                </div>
                    
            </div>

        <?php endif ; ?>
    </div>

 
</body>
</html>