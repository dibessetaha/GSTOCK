<?php
session_start() ; 

    require_once "config/connect.php" ; 


if(isset($_POST['ajouter']))
{
            $name = $_POST['name'] ;
            $email = $_POST['email']; 
            $numTele = $_POST['numTele'];
            $adresse = $_POST['adresse'] ; 

            $sqlQuery = "INSERT INTO client (nomCli, emailCli, adresseCli, numTelCli ) VALUES(:nomCli, :emailCli, :adresseCli, :numTelCli)" ;

            $mysqlStatment = $db->prepare($sqlQuery) ; 
            $data = $mysqlStatment->execute([
                'nomCli' => $name,
                'emailCli'  => $email,
                'adresseCli' => $adresse,
                'numTelCli' => $numTele  , 

            ]);
            header('Location:client.php');
}

 

        if(isset($_REQUEST['del'])){
            $id = $_GET['del'] ; 
            $clients = $db->prepare('DELETE FROM client WHERE idCli = :idCli ') ; 
            $clients->execute([
                'idCli' => $id ,
            ]);

            header('Location:client.php');

        }

        $clients  = $db->query('SELECT * FROM client') ; 
        $clients = $clients->fetchAll() ; 
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
                <form action="client.php" method ="post" class="form-group mt-3"  enctype="multipart/form-_POST" >
                    <label for="">Nom du Client :</label>
                    <input type="text" class="form-control mt-3" name="name"  required>
                    <label for="">Adresse du Client :</label>
                    <textarea class="form-control mt-3" name="adresse" id="adresse" cols="30" rows="5"></textarea>
                    <label for="">email du Client :</label>
                    <input type="email" class="form-control mt-3" name="email" required >
                    <label for="">Numero de Telephone :</label>
                    <input type="tel" class="form-control mt-3" name="numTele" required>
                    <button type="submit" class="btn btn-primary mt-3" name="ajouter"><i class="fa fa-plus-square"></i> Client</button>

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
                        <?php foreach($clients as $client) : ?>
                        <tr>
                            <td><? echo($client['nomCli']) ;?></td>
                            <td><? echo($client['adresseCli']) ;  ?></td>
                            <td><? echo($client['emailCli']) ;  ?></td>
                            <td><? echo($client['numTelCli']) ;  ?></td>
                            <td>
                                    <a href="client.php?del=<?echo $client['idCli']?>"><button class="btn btn-danger"><i  class="fa fa-trash-o"></i></button></a>
                                     <a href="update_client.php?edit=<?echo$client['idCli']?>"><button class="btn btn-primary"><i  class="fa fa-edit "></i></button></a>           
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <form action="recherche_client.php" class="form-group mt-3"  method="Post">
                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded" name = "client_rechercher" placeholder="Rechercher"  />
                        <button class="input-group-text border-0" name="rechercher">
                        <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

            </div>
            
        </div>
      
    </div>
</body>
</html>
