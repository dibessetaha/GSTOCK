<?php
session_start() ; 
    require_once "config/connect.php" ; 

    if(isset($_POST['categorie'])){
        $recherch = $_POST['categorie'] ; 

        $cat = $db->prepare("SELECT * FROM categorie WHERE (designation = :desi OR discription = :disc) ") ; 
        $cat->execute([
            'desi' => $recherch , 
            'disc' => $recherch,
        ]);
        $cat = $cat->fetch(PDO::FETCH_ASSOC) ; 

        if(empty($cat)){
            $errorMessage = "La categorie n'existe pas" ; 
        }
    }

    if(isset($_REQUEST['del'])){
        $id = $_GET['del'] ; 
        $categorie = $db->prepare('DELETE FROM categorie WHERE idCat = :id ');
        $categorie->execute([
            'id' => $id ,
        ]); 
        header('Location:categorie.php');

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
                <a href="categorie.php"><button type="button"  class="btn btn-outline-dark"><i class="fa fa-mail-reply"></i></button></a> 
        </div>
        <?php else : ?>
            <div class="row">
                     <table class="table table-striped">
                        <thead>
                    
                            <th>Désignation</th>
                            <th>Description</th>
                            <th>Action</th>

                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $cat['designation']; ?> </td>
                                <td><?php echo $cat['discription']; ?> </td>
                                <td>
                                    <a href="recherche_categorie.php?del=<?echo $cat['idCat']?>"><button class="btn btn-danger"><i  class="fa fa-trash-o "></i></button></a>
                                    <a href="update_categorie.php?edit=<?echo$cat['idCat']?>"><button class="btn btn-primary"><i  class="fa fa-edit "></i></button></a>           
      
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="categorie.php"><button type="button"  class="btn btn-outline-dark"><i class="fa fa-mail-reply"></i></button></a> 

                    
            </div>

        <?php endif ; ?>
    </div>

 
</body>
</html>