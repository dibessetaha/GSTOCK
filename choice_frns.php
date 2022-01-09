<?php
session_start() ; 

    require_once "config/connect.php" ; 

    $fournisseur = $db->query("SELECT * FROM fournisseur");
    $fournisseur = $fournisseur->fetchAll() ; 

    
    $del = $db->prepare("DELETE  FROM achats") ; 
    $del->execute() ; 

    $del = $db->prepare("DELETE  FROM approvisionnement") ; 
    $del->execute() ; 
     

      


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
            <form action="appro.php" method="POST">
                <table class="table table-striped">
                        <thead>
                            <th>La Date</th>
                            <th>Fournisseur</th>
                        </thead>
                        <tbody>
                            <tr>                                
                                <td>
                                <input type="date" class="form-control" name="date"  required>
                                </td>
                                <td>
                                    <select class="form-select" name="idFrns" id="frns">
                                        <? foreach($fournisseur as $frns) : ?>
                                            <option value="<? echo $frns['idFrns'] ?>">
                                                <? echo $frns['nomFrns'] ; ?>
                                            </option>
                                        <? endforeach ?>
                                    </select>
                                </td>    
                                
                            </tr>
                        </tbody>
                    </table>
                <button type="submit" name="appro" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Achat</button>
            </form> 
                
            </div>
            
        </div>
      
    </div>
</body>
</html>


