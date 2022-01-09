<?php
session_start() ; 
    require_once "config/connect.php" ; 

    if(isset($_POST['choice'])){
        $idCli = $_POST['idCli'] ; 
        $date = $_POST['date'] ; 
    }
   
    if(isset($_REQUEST['cli'])){
        $idCli = $_GET['cli'] ; 
        $date = $_POST['date'];
       // $produitID = $_POST['produitID'] ; 
       // echo $produitID ;
    }

    //affichage des listes des produits
    $produits = $db->prepare("SELECT * FROM produit p JOIN categorie c WHERE p.idCat_Categorie = c.idCat ") ;
    $produits->execute() ;  
    $produits = $produits->fetchAll() ; 


      


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site- Gestion de Stock</title>
    <style>
       
        .content{
            width : 70% ; 
            height : 70%;
            display: flex;
            margin : auto ; 
            margin-top : 40px;
            flex-wrap : wrap ; 
            justify-content : space-between ; 
        }
       
    </style>
</head>
<body>
    <?php require_once('navbar.php') ;?>
    <div class="content">
    <?php foreach($produits as $prod) : ?>
        <?php if($prod['qte']>0) : ?>
            <div class="colonne">
                <div class="card" style="width: 18rem;">
                <form action="post_commander.php" method="POST">
                    <input type="hidden" value="<? echo $prod['idPdr'] ?>" name ="idPdr">
                    <input type="hidden" value="<? echo $idCli ?>" name ="idCli">
                    <input type="hidden" value="<? echo $date ?>" name ="date">
                    <img class="card-img-top" src="<?echo $prod['screenshot'] ?>" alt="image product">
                    <div class="card-body">
                        <h5 class="card-title"><? echo $prod['nom_produit'] ; ?></h5>
                        <p class="card-text"><?php echo $prod['designation'].'--'.$prod['discription'] ; ?></p>
                </form>
                 <button type="submit"  class="btn btn-outline-dark"><i class="fa fa-plus-circle"></i> Commande</button>
                            </div>
                        </div>
                </div>
            <?php endif; ?>
    <?php endforeach ?>  
         
            </div>
    </div>

</body>
</html>


