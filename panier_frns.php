<?php 
session_start() ; 
    require_once "config/connect.php";
   

        $idPdr = $_POST['idPdr'] ; 
        $idFrns = $_POST['idFrns'] ; 
        $date = $_POST['date'] ; 
        $qteAchat = $_POST['qteAchat'] ; 
      //  $produitID = $_POST['produitID'] ; 


    

    $sql = "SELECT * FROM approvisionnement WHERE idFrns_Frns = :id" ; 
    $appro = $db->prepare($sql) ; 
    $appro->execute([
        'id'=> $idFrns , 
    ]);
    $appro = $appro->fetch(PDO::FETCH_ASSOC) ; 
    $idAppro = $appro['idAppro'] ; 



    $selectFromAchat = $db->prepare("SELECT * FROM achats") ; 
    $selectFromAchat->execute() ; 
    $select = $selectFromAchat->fetchAll() ; 
    $ver = 0 ; 
    if(!empty($select)){
        foreach($select as $s){
           // echo $s['idPrd_Produit'] ; 
            if(($s['idPrd_Produit']==$_POST['idPdr'])){
                $qteIni = $s['qteAchat'] ; 
                $updateAchat = $db->prepare("UPDATE achats SET  qteAchat = :qte WHERE idPrd_Produit = :id ") ; 
                $updateAchat->execute([
                    'qte' => $qteAchat + $qteIni,  
                    'id'=> $idPdr , 
                ]);
                 $ver += 1 ; 
            
             }
        }
    }
    if($ver==0){
        $achat = $db->prepare("INSERT INTO achats(qteAchat,idPrd_produit,idAppro_approvi ) VALUES (:qte,:idPdr,:idAppro)");
        $achat->execute([
              'qte' => $qteAchat , 
              'idPdr' => $idPdr, 
              'idAppro' => $idAppro , 
          ]);

    }


    


    $productResults = $db->prepare("SELECT * FROM achats a JOIN produit p JOIN categorie c WHERE a.idPrd_produit = p.idPdr AND p.idCat_categorie = c.idCat ") ; 
    $productResults->execute() ; 
    $productResults = $productResults->fetchAll() ; 



    
    


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
            <form action="facture_frns.php" method = post>
                <input type="hidden" name="idPdr" value="<? echo $prod['idPdr'] ?>">
                <input type="hidden" name="qteAchat" value="<? echo $qteAchat ?>">
                <input type="hidden" name="idFrns" value="<? echo $idFrns ?>">
                <input type="hidden" name="date" value="<? echo $date ?>">
                <input type="hidden" name="idAppro" value="<? echo $idAppro ?>">
                <table class="table table-striped ">
                        <thead>
                            <th>Image</th>
                            <th>Code Article</th>
                            <th>Nom du Produit</th>
                            <th>Quantite</th>
                            <th>Prix d'achat</th>
                            <th>Etat en stock</th>
                            <th>Categorie</th>
                        </thead>
                        <tbody>
                            <?php foreach($productResults as $r) :?>
                            <tr>
                    
                                <td><img src="<?php echo $r['screenshot']; ?>" alt="image du produit"  class="image_product "></td>
                                <td><?php echo $r['reference']; ?> </td>
                                <td><?php echo $r['nom_produit']; ?> </td>
                                <td><?php echo $r['qteAchat'] ?>  </td>
                                <td><?php echo $r['prixAchat']; ?> DHs </td>
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
                <a href="facture_frns.php"><button type="submit" class="btn btn-outline-info"><i class='fas fa-cart-plus'></i> J'ACHETTE</button></a>
                </form> 
                
            <form method="post" action="appro.php?frns=<?echo $idFrns?>">
            <input type="hidden" name="date" value=<?echo $date?>>
            <a href="appro.php?frns=<?echo $idFrns?>"><button type="submit" class="btn btn-outline-info"> Autre achat</button></a>

            </form>

        </div>

</body>
</html>