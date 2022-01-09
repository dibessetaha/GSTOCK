<?php 
session_start() ; 
    require_once "config/connect.php";
   

        $idPdr = $_POST['idPdr'] ; 
        $idCli = $_POST['idCli'] ; 
        $date = $_POST['date'] ; 
        $qteVente = $_POST['qteVente'] ; 
      //  $produitID = $_POST['produitID'] ; 


    $sql = "SELECT * FROM commande WHERE idCli_Client = :idCli" ; 
    $cmd = $db->prepare($sql) ; 
    $cmd->execute([
        'idCli'=> $idCli , 
    ]);
    $cmd = $cmd->fetch(PDO::FETCH_ASSOC) ; 
    $idCmd = $cmd['idCmd'] ; 

    $selectFromVente = $db->prepare("SELECT * FROM vente") ; 
    $selectFromVente->execute() ;
    $select = $selectFromVente->fetchAll() ; 
    $ver = 0 ; 
    if(!empty($select)){
        foreach($select as $s){
           // echo $s['qteVente'] ; 
            if(($s['idPrd_Produit']==$_POST['idPdr'])){
                $qteIni = $s['qteVente'] ; 
                $updateVente = $db->prepare("UPDATE vente SET  qteVente = :qte WHERE idPrd_Produit = :id ") ; 
                $updateVente->execute([
                    'qte' => $qteVente + $qteIni,  
                    'id'=> $idPdr , 
                ]);
                 $ver += 1 ; 
            
             }
        }
    }
    if($ver==0){
    $vente = $db->prepare("INSERT INTO vente(qteVente,idPrd_produit,idCmd_Commande) VALUES (:qte,:idPdr,:idCmd)");
    $vente->execute([
            'qte' => $qteVente , 
            'idPdr' => $idPdr, 
            'idCmd' => $idCmd , 
        ]);
    }



        


    


    $productResults = $db->prepare("SELECT * FROM vente v JOIN produit p JOIN categorie c WHERE v.idPrd_produit = p.idPdr AND p.idCat_categorie = c.idCat ") ; 
    $productResults->execute() ; 
    $productResults = $productResults->fetchAll() ; 



    
    

  //  $qteVente = 0 ; 



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
            <form action="genPDF.php" method = post>
                <input type="hidden" name="idPdr" value="<? echo $prod['idPdr'] ?>">
                <input type="hidden" name="qteVente" value="<? echo $qteVente ?>">
                <input type="hidden" name="idCli" value="<? echo $cli['idCli'] ?>">
                <input type="hidden" name="date" value="<? echo $date ?>">
                <input type="hidden" name="idCmd" value="<? echo $idCmd ?>">
                <table class="table table-striped ">
                        <thead>
                            <th>Image</th>
                            <th>Code Article</th>
                            <th>Nom du Produit</th>
                            <th>Quantite</th>
                            <th>Prix de vente</th>
                            <th>Etat en stock</th>
                            <th>Categorie</th>
                        </thead>
                        <tbody>
                            <?php foreach($productResults as $r) :?>
                            <tr>
                    
                                <td><img src="<?php echo $r['screenshot']; ?>" alt="image du produit"  class="image_product "></td>
                                <td><?php echo $r['reference']; ?> </td>
                                <td><?php echo $r['nom_produit']; ?> </td>
                                <td><?php echo $r['qteVente'] ?>  </td>
                                <td><?php echo $r['prixVente']; ?> DHs </td>
                                <td>
                                    <?php if(($r['qte']) > 0 ) :?>
                                        <span class="badge bg-success"><? echo 'En stock' ;  ?></span>
                                        <?else : ?>
                                            <span class="badge bg-danger"><? echo 'epuisee' ;  ?></span>
                                    <? endif ;?>
                                </td>
                                <td><?php echo $r['designation'].'/'.$r['discription']; ?> </td>
                              
                            </tr>
                            <? endforeach ?>
                        </tbody>

                </table>
                <a href="genPDF.php"><button type="submit" class="btn btn-outline-info"><i class='fas fa-cart-plus'></i> J'ACHETTE</button></a>
                </form> 
                
            <form method="post" action="commander.php?cli=<?echo $idCli?>">
                <input type="hidden" name="date" value=<?echo $date?>>
                <a href="commander.php?cli=<?echo $idCli?>"><button type="submit" name="backToProduct" class="btn btn-outline-info mt-2"> Ajouter un autre produit !</button</a>
            </form>

        </div>

</body>
</html>