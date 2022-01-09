<?php
    session_start() ; 

    require_once "config/connect.php" ; 

    if(!isset($_REQUEST['edit'])){
        echo "Produit not found" ; 

    }else{
        $id = $_GET['edit'] ; 
        $update = $db->prepare('SELECT * FROM produit p INNER JOIN categorie c WHERE idPdr = :id AND p.idCat_categorie = c.idCat ');
        $update->execute([
            'id' => $id ,
        ]); 
        $update = $update->fetch(PDO::FETCH_ASSOC) ;

    }

    $categorie = $db->query("SELECT * FROM categorie") ; 
    $categorie = $categorie->fetchAll() ; 

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
        <div class="row">
            <h1>Mettre à jour <?php echo($update['nom_produit']); ?></h1>
            <form action="post_update_produit.php" method="POST" enctype="multipart/form-data">
                <table class="table table-striped">
                            <thead>
                                <th>Image</th>
                                <th>Code Article</th>
                                <th>Nom du Produit</th>
                                <th>Prix d'achat</th>
                                <th>Prix de vente</th>
                                <th>Categorie</th>

                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    <input type="file" class="form-control mt-3" id="profile" name="screenshot"  >
                                    <input type="hidden" class="form-control mt-3" id="imgPrd" name="profile" value=<? echo ($update['screenshot']) ?>  >

                                    <input type="hidden" class="form-control" id="edit" name="edit" value="<?php echo($_GET['edit']); ?>">  
                                    </td>
                                    <td>
                                    <input type="text" class="form-control mt-3" name="reference" value="<? echo($update['reference']) ?>" required>
                                    </td>
                                    <td>
                                    <input type="text" class="form-control mt-3" name="nom_produit" value="<? echo($update['nom_produit']) ?>"  required>
                                    </td>
                                    <td>
                                    <input type="number" class="form-control mt-3" name="prixAchat" value="<? echo($update['prixAchat']) ?>"  required>
                                    </td>
                                    <td>
                                    <input type="number" class="form-control mt-3" name="prixVente" value="<? echo($update['prixVente']) ?>"  required>
                                    </td>
                                    <td>
                                    <select class="form-select mt-3" name="idCat" id="idCat">
                                                <?foreach($categorie as $cat) : ?>
                                                 <option value="<?echo($cat['idCat']) ?>">
                                                    <?echo($cat['discription']) ?>
                                                </option>
                                                <? endforeach ?>
                                    </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Envoyer</button>

            </form>

        
      
    </div>
</body>
</html>
