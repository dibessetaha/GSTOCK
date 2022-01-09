<?php
session_start() ; 
    require_once "config/connect.php" ; 

    if(isset($_POST['client_rechercher'])){
        $recherch = $_POST['client_rechercher'] ; 

        $client = $db->prepare("SELECT * FROM client WHERE nomCli = :nom OR numTelCli = :num OR emailCli = :email ") ; 
        $client->execute([
            'nom' => $recherch , 
            'num' => $recherch,
            'email' =>$recherch,
        ]);

        $client = $client->fetch(PDO::FETCH_ASSOC) ; 

        if(empty($client)){
            $errorMessage = "Le client n'existe pas" ; 
        }
    }

    if(isset($_REQUEST['del'])){
        $id = $_GET['del'] ; 
        $clients = $db->prepare('DELETE FROM client WHERE idCli = :idCli ') ; 
        $clients->execute([
            'idCli' => $id ,
        ]);

        header('Location:client.php');

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
            <div class="row mt-4">
                    <div class="alert alert-warning" role="alert">
                        <?php echo $errorMessage ;  ?>
                    </div>
                    <a href="client.php"><button type="button"  class="btn btn-outline-dark"><i class="fa fa-mail-reply"></i></button></a> 
            </div>
        <?php else : ?>
            <div class="row mt-4">
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
                            <td><? echo($client['nomCli']) ;?></td>
                            <td><? echo($client['adresseCli']) ;  ?></td>
                            <td><? echo($client['emailCli']) ;  ?></td>
                            <td><? echo($client['numTelCli']) ;  ?></td>
                            <td>
                                    <a href="recherche_client.php?del=<?echo $client['idCli']?>"><button class="btn btn-danger"><i  class="fa fa-trash-o"></i></button></a>
                                    <a href="update_client.php?edit=<?echo$client['idCli']?>"><button class="btn btn-primary"><i  class="fa fa-edit "></i></button></a>           
                            </td>
                        </tr>
                    </tbody>
                </table>
                    <a href="client.php"><button type="button"  class="btn btn-outline-dark"><i class="fa fa-mail-reply"></i></button></a> 

                </div>
                    
            </div>

        <?php endif ; ?>
    </div>

 
</body>
</html>