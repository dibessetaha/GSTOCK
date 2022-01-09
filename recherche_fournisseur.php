<?php
    session_start() ; 

    require_once "config/connect.php" ; 
    if(isset($_POST['frns_rechercher'])){
        $recherch = $_POST['frns_rechercher'] ; 

        $frns = $db->prepare("SELECT * FROM fournisseur WHERE nomFrns = :nom OR numTeleFrns = :num OR emailFrns = :email ") ; 
        $frns->execute([
            'nom' => $recherch , 
            'num' => $recherch,
            'email' =>$recherch,
        ]);

        $frns = $frns->fetch(PDO::FETCH_ASSOC) ; 

        if(empty($frns)){
            $errorMessage = "Le fournisseur n'existe pas" ; 
        }
    }

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
        <?php if(isset($errorMessage)) : ?>
            <div class="row mt-3">
                    <div class="alert alert-warning" role="alert">
                        <?php echo $errorMessage ;  ?>
                    </div>
                    <a href="fournisseur.php"><button type="button"  class="btn btn-outline-dark"><i class="fa fa-mail-reply"></i></button></a> 
            </div>
        <?php else : ?>
            <div class="row mt-3">
                <table class="table table-striped">
                    <thead>
                        <th>Nom Complet</th>
                        <th>Adresse</th>
                        <th>Email</th>
                        <th>Numero De Telephone</th>
                        <th>Action</th>

                    </thead>
                    <tbody>
                        <tr>
                            <td><? echo($frns['nomFrns']) ;?></td>
                            <td><? echo($frns['adresseFrns']) ;  ?></td>
                            <td><? echo($frns['emailFrns']) ;  ?></td>
                            <td><? echo($frns['numTeleFrns']) ;  ?></td>
                            <td>
                                    <a href="recherche_fournisseur.php?del=<?echo $frns['idFrns']?>"><button class="btn btn-danger"><i  class="fa fa-trash-o"></i></button></a>
                                    <a href="update_fournisseur.php?edit=<?echo$frns['idFrns']?>"><button class="btn btn-primary"><i  class="fa fa-edit "></i></button></a>           
                            </td>
                        </tr>
                    </tbody>
                </table>
                    <a href="fournisseur.php"><button type="button"  class="btn btn-outline-dark"><i class="fa fa-mail-reply"></i></button></a> 

                </div>
                    
            </div>

        <?php endif ; ?>
    </div>

 
</body>
</html>