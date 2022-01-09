
<?php
      session_start() ; 
      // faire appel a la base de donnees

        require_once 'config/connect.php';

        if(isset($_POST['ajouter']))
        { 
            
            
            $discription = $_POST['discription'];
            $designation = $_POST['designation'];
          
    

                
            $sqlQuery = "INSERT INTO categorie (designation, discription) VALUES(:designation, :discription)" ;

            $mysqlStatment = $db->prepare($sqlQuery) ; 
            $dataAjouter = $mysqlStatment->execute([
            'designation' => $designation ,
            'discription' => $discription, 
            
            ]);

        }

        
  
        if(isset($_REQUEST['del'])){
            $id = $_GET['del'] ; 
            $categorie = $db->prepare('DELETE FROM categorie WHERE idCat = :id ');
            $categorie->execute([
                'id' => $id ,
            ]); 
    
        }
        $categories = $db->query('SELECT * FROM categorie ');
        $categories = $categories->fetchAll() ; 
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
                <form action="categorie.php" method ="POST" class="form-group mt-3"  >
                    <label for="designation">Désignation :</label>
                    <input type="text" class="form-control mt-3" name="designation" id="designation" required>
                    <label for="discription">Description :</label>
                    <input type="text" class="form-control mt-3" name="discription" required>

                    <button type="submit" class="btn btn-primary mt-3" name="ajouter"><i class="fa fa-plus-square"></i> Categorie</button>

                </form>

            </div>
            <div class="col-10 mt-3">
                <table class="table table-striped">
                        <thead>
                    
                            <th>Désignation</th>
                            <th>Description</th>
                            <th>Action</th>

                        </thead>
                        <tbody>
                            <?php foreach($categories as $cat) :?>
                            <tr>
                                <td><?php echo $cat['designation']; ?> </td>
                                <td><?php echo $cat['discription']; ?> </td>
                                <td>
                                    <a href="categorie.php?del=<?echo $cat['idCat']?>"><button class="btn btn-danger"><i  class="fa fa-trash-o"></i></button></a>
                                     <a href="update_categorie.php?edit=<?echo$cat['idCat']?>"><button class="btn btn-primary"><i  class="fa fa-edit "></i></button></a>           
                                </td>
                            </tr>
                            <? endforeach ?>
                        </tbody>
                    </table>
                    <form action="recherche_categorie.php" class="form-group mt-3"  method="Post">
                        <div class="input-group rounded">
                            <input type="search" class="form-control rounded" name = "categorie" placeholder="Rechercher" required />
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
