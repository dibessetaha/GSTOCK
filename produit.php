
<?php
    session_start() ;

        // faire appel a la base de donnees

        require_once 'config/connect.php';
   

        $produits = $db->query('SELECT * FROM produit p INNER JOIN categorie c WHERE p.idCat_categorie = c.idCat');
        $produits = $produits->fetchAll() ; 


        if(isset($_REQUEST['del'])){
            $id = $_GET['del'] ; 
         
            $query = $db->prepare("DELETE FROM produit WHERE idPdr = :id") ; 
            $query->execute([
                'id' => $_GET['del'],
            ]);
            header('Location:produit.php');
           
        }
/*
        if(!isset($loggedUser['email'])){
            header('Location:index.php') ; 
        } 
     */
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site- Gestion de Stock</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#table').DataTable({
                "scrollY":  "400px",
                "scrollCollapse": true,
                "paging":  false
            } );
        });
    </script>
    
</head>
<body>
    <?php require_once('navbar.php') ;?>
  
    <div class="container">
        <br>
        <div class="row">
                <!--
               <form action="recherche_produit.php" class="form-group mt-3"  method="Post">
                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded" name = "produit_rechercher" placeholder="Rechercher"  />
                        <button class="input-group-text border-0" name="rechercher">
                        <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                -->
                <table class="table table-striped " id="table">
                        <thead>
                            <th>Image</th>
                            <th>Code Article</th>
                            <th>Nom du Produit</th>
                            <th>Quantite</th>
                            <th>Prix d'achat</th>
                            <th>Prix de vente</th>
                            <th>Etat en stock</th>
                            <th>Categorie</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php foreach($produits as $prod) :?>
                            <tr>
                                <td><img src="<?php echo $prod['screenshot']; ?>" alt="image du produit"  class="image_product "></td>
                                <td><?php echo $prod['reference']; ?> </td>
                                <td><?php echo $prod['nom_produit']; ?> </td>
                                <td><?php if($prod['qte']<0){ $prod['qte'] = 0;}echo $prod['qte'];?> </td>
                                <td><?php echo $prod['prixAchat']; ?> DHs </td>
                                <td><?php echo $prod['prixVente']; ?> DHs </td>
                                <td>
                                    <?php if(($prod['qte']) > 0 ) :?>
                                        <span class="badge bg-success"><? echo 'En stock' ;  ?></span>
                                        <?else : ?>
                                            <span class="badge bg-danger"><? echo 'epuisee' ;  ?></span>
                                    <? endif ;?>
                                </td>
                                <td><?php echo $prod['designation'].'/'.$prod['discription']; ?> </td>
                                <td>
                                    <a href="produit.php?del=<?echo $prod['idPdr']?>"><button class="btn btn-danger"><i  class="fa fa-trash-o "></i></button></a>
                                     <a href="update_produit.php?edit=<?echo$prod['idPdr']?>"><button class="btn btn-primary"><i  class="fa fa-edit "></i></button></a>           
                                </td>
                            </tr>
                            <? endforeach ?>
                        </tbody>
                </table>


                
        </div>

     
   
    </div>


  

 
</body>

<?php require_once "footer.php" ; ?>

</html>


