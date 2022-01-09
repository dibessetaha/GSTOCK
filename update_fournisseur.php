<?php     
    session_start() ; 

    require_once "config/connect.php" ; 

    if(isset($_REQUEST['edit'])){
        $id = $_GET['edit'] ; 

        $update = $db->prepare("SELECT * FROM fournisseur WHERE idFrns = :id") ; 
        $update->execute([
            'id' => $id ,
        ]);
        $update = $update->fetch(PDO::FETCH_ASSOC) ; 
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
            <div class="col-10 mt-3">
            <h1>Modifier le client : <?php echo($update['nomFrns']); ?></h1>
            <form action="post_update_frns.php" method="POST">
                <table class="table table-striped">
                        <thead>
                            <th>Nom Complet</th>
                            <th>Adresse</th>
                            <th>Email</th>
                            <th>Numero De Telephone</th>

                        </thead>
                        <tbody>
                                <tr>
                                    <td>
                                    <input type="text" class="form-control mt-3" name="name" value="<? echo($update['nomFrns']) ?>" required>
                                    <input type="hidden" class="form-control" id="edit" name="edit" value="<?php echo($_GET['edit']); ?>">  
                                    </td>
                                    <td>
                                    <textarea name="adresse" id="adresse" cols="30" rows="5" required>
                                    <? echo($update['adresseFrns']) ?>
                                    </textarea>
                                    </td>
                                    <td>
                                    <input type="email" class="form-control mt-3" name="email" value="<? echo($update['emailFrns']) ?>"  required>
                                    </td>
                                    <td>
                                    <input type="text" class="form-control mt-3" name="numTele" value="<? echo($update['numTeleFrns']) ?>"  required>
                                    </td>
                                   
        
                                </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                
            </form>

            </div>
            
        </div>
      
    </div>
</body>
</html>