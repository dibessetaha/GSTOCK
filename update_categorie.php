<?php 
    session_start() ; 

    require_once "config/connect.php" ; 

    if(isset($_REQUEST['edit'])){
        $id = $_GET['edit'] ; 
    }

    $sql = "SELECT * FROM categorie WHERE idCat = :id" ; 
    $update = $db->prepare($sql) ; 
    $update->execute([
        'id' => $id , 
    ]);
    $update = $update->fetch(PDO::FETCH_ASSOC) ; 

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
            <h1>Modifier la : <?php echo($update['designation']); ?></h1>
            <form action="post_update_categorie.php" method="POST">
                <table class="table table-striped">
                        <thead>
                            <th>Désignation</th>
                            <th>Description</th>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>
                                    <input type="text" class="form-control mt-3" name="designation" value="<? echo($update['designation']) ?>" required>
                                    <input type="hidden" class="form-control" id="edit" name="edit" value="<?php echo($_GET['edit']); ?>">  
                                    </td>                                
                                    <td>
                                    <input type="text" class="form-control mt-3" name="discription" value="<? echo($update['discription']) ?>"  required>
                                    </td>
        
                                </tr>
                        </tbody>
                    </table>
                    <button type="submit" name="envoyer" class="btn btn-primary">Envoyer</button>
                
            </form>

            </div>
            
        </div>
      
    </div>
</body>
</html>