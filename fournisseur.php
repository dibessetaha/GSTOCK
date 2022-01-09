<?php
session_start() ; 
    require_once "config/connect.php" ; 


if(isset($_POST['ajouter']))
{
            $name = $_POST['name'] ;
            $email = $_POST['email']; 
            $numTele = $_POST['numTele'];
            $adresse = $_POST['adresse'] ; 

            $sqlQuery = "INSERT INTO fournisseur (nomFrns, emailFrns, adresseFrns, numTeleFrns ) VALUES(:nom, :email, :adresse, :tele)" ;

            $mysqlStatment = $db->prepare($sqlQuery) ; 
            $data = $mysqlStatment->execute([
                'nom' => $name,
                'email'  => $email,
                'adresse' => $adresse,
                'tele' => $numTele  , 

            ]);
}

        $fournisseur  = $db->query('SELECT * FROM fournisseur') ; 
        $fournisseur = $fournisseur->fetchAll() ; 

        if(isset($_REQUEST['del'])){
            $id = $_GET['del'] ; 
            $frns = $db->prepare('DELETE FROM fournisseur WHERE idFrns = :id ') ; 
            $frns->execute([
                'id' => $id ,
            ]);

            header('Location:fournisseur.php');

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
        <div class="row">
            <div class="col-2 mt-3">
                <form action="fournisseur.php" method ="post" class="form-group mt-3"  enctype="multipart/form-_POST" >
                    <label for="">Nom du Fournisseur :</label>
                    <input type="text" class="form-control mt-3" name="name"  required>
                    <label for="">Adresse du fournisseur :</label>
                    <textarea class="form-control mt-3" name="adresse" id="adresse" cols="30" rows="5"></textarea>
                    <label for="">email du fournissuer :</label>
                    <input type="email" class="form-control mt-3" name="email" required >
                    <label for="">Numero de Telephone :</label>
                    <input type="tel" class="form-control mt-3" name="numTele" required>
                    <button type="submit" class="btn btn-primary mt-3" name="ajouter"><i class="fa fa-plus-square"></i> Fournisseur</button>

                </form>

            </div>
            <div class="col-10 mt-3">
            <table class="table table-striped">
                    <thead>
                        <th>Nom Complet</th>
                        <th>Adresse</th>
                        <th>Email</th>
                        <th>Numero De Telephone</th>
                        <th>Action</th>

                    </thead>
                    <tbody>
                        <?php foreach($fournisseur as $frns) : ?>
                        <tr>
                            <td><? echo($frns['nomFrns']) ;?></td>
                            <td><? echo($frns['adresseFrns']) ;  ?></td>
                            <td><? echo($frns['emailFrns']) ;  ?></td>
                            <td><? echo($frns['numTeleFrns']) ;  ?></td>
                            <td>
                                    <a href="fournisseur.php?del=<?echo $frns['idFrns']?>"><button class="btn btn-danger"><i  class="fa fa-trash-o"></i></button></a>
                                     <a href="update_fournisseur.php?edit=<?echo$frns['idFrns']?>"><button class="btn btn-primary"><i  class="fa fa-edit "></i></button></a>           
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <form action="recherche_fournisseur.php" class="form-group mt-3"  method="Post">
                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded" name = "frns_rechercher" placeholder="Rechercher"  />
                        <button class="input-group-text border-0" name="rechercher">
                        <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

            </div>
            
        </div>
      
    </div>

    <?php require_once "footer.php" ; ?>

</body>
</html>
