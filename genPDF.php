<?php

session_start(); 

    use Dompdf\Dompdf ; 
    use Dompdf\Options ; 


    
    
    
    
    require_once 'config/connect.php' ; 

    $ventes = $db->query("SELECT * FROM vente"); 
    $ventes = $ventes->fetchAll();

    foreach($ventes as $v){
        $idPdr = $v['idPrd_Produit'] ; 
        $prod = $db->prepare("SELECT * FROM produit WHERE idPdr=:id") ; 
        $prod->execute([
            'id'=> $idPdr,
        ]);
        $prod = $prod->fetch(PDO::FETCH_ASSOC);
        $idPdr = $prod['idPdr'] ; 
        $qteInitial = $prod['qte'];
        $sql = "UPDATE produit SET qte = :qte WHERE idPdr = :id" ; 
        $update = $db->prepare($sql) ; 
        $update->execute([
            'qte' =>  (($qteInitial - $v['qteVente']) <= 0) ? 0 : ($qteInitial - $v['qteVente']) , 
            'id' => $idPdr , 
        ]);

     //   $qte = 0 ; 



    }







    $idCmd = $_POST['idCmd'] ; 

    

        $sql1 = "SELECT * FROM commande cmd JOIN client cli WHERE cmd.idCli_client = cli.idCli  AND cmd.idCmd = :idCmd" ; 
        
        $fullTables = $db->prepare($sql1);
        $fullTables->execute([
            'idCmd' => $idCmd , 
        ]) ; 
        $fullTables = $fullTables->fetch(PDO::FETCH_ASSOC) ; 


        // Selection des champs du table produit pour les afficher dans la formulaire
        
        $produit = $db->prepare('SELECT * FROM vente v JOIN produit p  JOIN categorie c  WHERE v.idPrd_produit = p.idPdr AND c.idCat = p.idCat_categorie') ; 
        $produit->execute();
        $produit = $produit->fetchAll() ; 

  
        ob_start() ; 
        require_once 'facture.php' ; 
        $html = ob_get_contents() ; 
        ob_end_clean(); 
    
        require_once "config/dompdf/autoload.inc.php" ;
        
        
        
        $option = new Options();
        $option->set('defaultFont', 'Calibri') ; 
        $pdf = new Dompdf($option) ; 
    
        $pdf->loadHtml($html) ; 
        $pdf->setPaper("A4", 'portrait' );
        $pdf->render() ; 
    
        $fichier = 'facture.pdf' ;

      //  header('location:commander.php');

        $pdf->stream($fichier) ; 



?>




