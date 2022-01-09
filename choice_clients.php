<?php
session_start() ; 
    require_once "config/connect.php" ; 

    // afficher les listes des clients
    $clients  = $db->prepare('SELECT * FROM client') ; 
    $clients->execute() ;  
    $clients = $clients->fetchAll() ; 
    
    $del = $db->prepare("DELETE  FROM vente") ; 
    $del->execute() ; 

    $del = $db->prepare("DELETE  FROM commande") ; 
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
            <form action="commander.php" method="POST">
                <table class="table table-striped">
                        <thead>
                            <th>La Date</th>
                            <th>Clients</th>
                        </thead>
                        <tbody>
                            <tr>                                
                                <td>
                                <input type="date" class="form-control" name="date"  required>
                                </td>
                                <td>
                                    <select class="form-select" name="idCli" id="client">
                                            <?foreach($clients as $cli) : ?>
                                                <option value="<?echo($cli['idCli']) ?>">
                                                <?echo($cli['nomCli']) ?>
                                            </option>
                                            <? endforeach ?>
                                    </select>

                                </td>
    
                             
                        </tbody>
                    </table>
                <button name="choice" type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Commande</button>
            </form> 
                
            </div>
            
        </div>
      
    </div>
</body>

</html>


