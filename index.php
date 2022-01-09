
<?php
    session_start() ; 



        // faire appel a la base de donnees

        require_once 'config/connect.php';

     
      
         
        $categorie = $db->prepare("SELECT * FROM categorie") ; 
        $categorie->execute() ; 
        $categorie = $categorie->fetchAll() ; 
    
        $produits = $db->query('SELECT * FROM produit p INNER JOIN categorie c WHERE p.idCat_categorie = c.idCat');
        $produits = $produits->fetchAll() ; 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site- Gestion de Stock</title>
    <style>
        .link{
            color: #000;
            text-decoration: none;
            font-size: 17px;
            font-weight : bold ; 
            padding-left : 900px;
        }
    </style>
</head>
<body>
<?php require_once "login.php"; ?>

    <?php if(isset($loggedUser)): ?>
                <?php require_once('navbar.php') ;?>  
                <div class="alert alert-secondary " id="section" role="alert">
                     Bonjour <?php echo($loggedUser['email']).' et bienveunu dans <strong>G-STOCK</strong>'; ?>
                     <a class="link" href="logout.php">Deconnexion</a>
                </div> 
                <div class="container">
                    <div class="row">
                        <div class="col-2 mt-3">
                            <form action="post_index.php" method ="POST" class="form-group mt-3" enctype="multipart/form-data" >
                                    <label class="form-label" for="reference">reference :</label>
                                    <input type="text" class="form-control mt-3" name="reference" id="reference" required>
                                    <label class="form-label" for="">Nom du Produit :</label>
                                    <input type="text" class="form-control mt-3" name="nom_produit" required>
                                    <label class="form-label" for="idCat">Categorie :</label>
                                    <select class="form-select mt-3" name="idCat" id="idCat">
                                        <? foreach($categorie as $cat) : ?>
                                        <option value="<?echo $cat['idCat']?>"><? echo $cat['discription'] ; ?></option>
                                        <? endforeach ?>
                                    </select>
                                    <label class="form-label" for="">Quantite :</label>
                                    <input type="number" class="form-control mt-3" name="qte" required >
                                    <label class="form-label" for="">Prix d'Achat :</label>
                                    <input type="number" class="form-control mt-3" name="prixAchat" required>
                                    <label class="form-label" for="">Prix de vente :</label>
                                    <input type="number" class="form-control mt-3" name="prixVente" required>
                                    <label class="form-label" for="profile" class="form-label">Image du produit :</label>
                                    <input class="form-control mt-3" type="file" class="form-control" id="profile" name="screenshot" />

                                    <button type="submit" class="btn btn-primary mt-3" name="ajouter"><i class="fa fa-plus-square"></i> Produit</button>

                            </form>

                        </div>
                        <div class="col-10 mt-3">
                        <table class="table table-striped">
                                <thead>
                                    <th>Image</th>
                                    <th>Code Article</th>
                                    <th>Nom du Produit</th>
                                    <th>Quantite</th>
                                    <th>Prix d'achat</th>
                                    <th>Prix de vente</th>
                                    <th>Categorie</th>

                                </thead>
                                <tbody>
                                    <?php foreach($produits as $prod) :?>
                                    <tr>
                                        <td><img src="<?php echo $prod['screenshot']; ?>" alt="image du produit"  class="image_product "></td>
                                        <td><?php echo $prod['reference']; ?> </td>
                                        <td><?php echo $prod['nom_produit']; ?> </td>
                                        <td>
                                        <?php

                                        if($prod['qte']<0){
                                            $prod['qte'] = 0 ; 
                                            }
                                            echo $prod['qte'] ; 
                                        
                                        ?> 
                                    
                                        </td>
                                        <td><?php echo $prod['prixAchat']; ?> </td>
                                        <td><?php echo $prod['prixVente']; ?> </td>
                                        <td><?php echo $prod['designation'].'/'.$prod['discription']; ?> </td>


                                    </tr>
                                    <? endforeach ?>
                                </tbody>
                            </table>

                        </div>
                        
                    </div>
                
                </div>
                
            </body>
            <?php require_once "footer.php" ; ?>
    <?endif ; ?>

</html>
