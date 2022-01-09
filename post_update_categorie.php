<?php 
session_start() ; 

    require_once "config/connect.php" ; 

    if(isset($_POST['envoyer'])){

        $designation = $_POST['designation'] ; 
        $discription = $_POST['discription'] ; 
        $id = $_POST['edit'] ; 
        //echo $designation ;
        /*
        $prod = $db->prepare("UPDATE produit p JOIN categorie c SET c.designation = :desi AND c.discription = :disc WHERE  p.idCat_Categorie = c.idCat AND idCat = :idCat") ;
        $prod->execute([
            'desi' => $designation, 
            'disc' => $discription,
            'idCat' => $id, 
        ]);

        */
        
        $categorie = $db->prepare("UPDATE categorie SET designation = :desi , discription = :disc WHERE idCat = :idCat") ; 
        $categorie->execute([
            'desi' => $designation, 
            'disc' => $discription,
            'idCat' => $id, 
        ]);
        header('Location:categorie.php') ;


    }


?>