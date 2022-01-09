<?php
session_start() ; 
    require_once 'config/connect.php' ; 
    $getdata = $_GET ; 


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
            <h1>Supprimer le produit ?</h1>
                <form action="post_delete_produit.php" method="POST">
                    <div class="mb-3 visually-hidden">
                        <label for="id" class="form-label">Identifiant de la recette</label>
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($getData['idPdr']); ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-danger">La suppression est définitive</button>
                </form>
        </div>
        
    </div>
</body>
</html>
