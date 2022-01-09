<?php
session_start() ; 
    require_once "config/connect.php" ; 



    

if(isset($_POST['ajouter']))
{ 
    
        $reference = $_POST['reference'];
        $nom_produit = $_POST['nom_produit'];
        $quantite = $_POST['qte'];
        $prixAchat = $_POST['prixAchat'];
        $prixVente = $_POST['prixVente'];
        $idCat = $_POST['idCat'] ; 

            
             // pour l'image ya bouceaup de chose a jouter 
        
            // creer un dossier nommer le uploads 
            // pour stocker nos images
            if(isset($_FILES['screenshot']) && $_FILES['screenshot']['error']==0){

                //Testons si le fich n'est pas trop gros
                if($_FILES['screenshot']['size'] <= 2000000){
                    $fileInfo = pathinfo($_FILES['screenshot']['name']) ; 
                    $extension = $fileInfo['extension'] ; 
                    $allowedExtension = ['jpg', 'png', 'jpeg', 'gif'] ; 
                    if(in_array($extension, $allowedExtension)){
                        //stockage definitif du fichier 
                        move_uploaded_file($_FILES['screenshot']['tmp_name'], 'uploads/'.basename($_FILES['screenshot']['name'])) ; 
                        echo 'L\'envoi a bien été effectué !' ; 
                    }
                }
            }
                
            


        $categorie = $db->prepare("SELECT * FROM categorie WHERE idCat = :id") ; 
        $categorie->execute([
            'id' => $idCat , 
        ]);
        $cat = $categorie->fetch(PDO::FETCH_ASSOC);
        $id = $cat['idCat'] ; 
        
        $sqlQuery = "INSERT INTO produit (reference, nom_produit, qte, prixAchat, prixVente, screenshot, idCat_categorie ) VALUES(:reference, :nom_produit, :qte, :prixAchat, :prixVente, :screenshot, :idCat_categorie)" ;

        $mysqlStatment = $db->prepare($sqlQuery) ; 
        $dataAjouter = $mysqlStatment->execute([
        'reference' => $reference ,
        'nom_produit' => $nom_produit, 
        'qte'        => $quantite  ,   
        'prixAchat' => $prixAchat,
        'prixVente' => $prixVente,
        'screenshot' =>'uploads/'.basename($_FILES['screenshot']['name']),
        'idCat_categorie' => $id,
        ]);

    }
  

    header('Location:index.php'); 



?>