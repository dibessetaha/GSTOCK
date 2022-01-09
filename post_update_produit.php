<?php
session_start() ; 
    require_once "config/connect.php" ; 

    $edit = $_POST['edit'] ;
    $reference = $_POST['reference'];
    $nom_produit = $_POST['nom_produit'];
    $prixAchat = $_POST['prixAchat'];
    $prixVente = $_POST['prixVente'];
    $idCat = $_POST['idCat'] ; 
    $lastImg = $_POST['profile'] ; 
    //echo $lasImg ;

    if(isset($_FILES['screenshot']) && $_FILES['screenshot']['error']==0){

        //Testons si le fich n'est pas trop gros
        if($_FILES['screenshot']['size'] <= 2000000){
            $fileInfo = pathinfo($_FILES['screenshot']['name']) ; 
            $extension = $fileInfo['extension'] ; 
            $allowedExtension = ['jpg', 'png', 'jpeg', 'gif'] ; 
            if(in_array($extension, $allowedExtension)){
                //stockage definitif du fichier 
                move_uploaded_file($_FILES['screenshot']['tmp_name'], 'uploads/'.basename($_FILES['screenshot']['name'])) ; 
               // echo 'L\'envoi a bien été effectué !' ; 
            }
        }
    }

    $insertProdStatement = $db->prepare('UPDATE produit p SET p.reference = :reference, p.nom_produit = :nom_produit, p.screenshot = :scrn,
                                         p.prixAchat = :prixAchat, p.prixVente = :prixVente, p.idCat_categorie = :idCat WHERE idPdr = :idPdr');
    $insertProdStatement->execute([
       'reference' => $reference ,
       'nom_produit' => $nom_produit, 
       'scrn' => (!empty(basename($_FILES['screenshot']['name']))) ? ('uploads/'.basename($_FILES['screenshot']['name'])) : $lastImg,
       'prixAchat' => $prixAchat ,
       'prixVente' => $prixVente,
       'idCat' => $idCat,
       'idPdr'=> $edit
      
    ]);

   // echo "<script>alert('Vous avez modifier un produit')</script>" ; 
    header('Location:produit.php');



    



?>