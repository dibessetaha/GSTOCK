<?php


    require_once "config/connect.php" ; 
    
$postData = $_POST;


if (isset($postData['email']) &&  isset($postData['password'])) {

   // echo "blalal";
    
   // $postData['email'] = null ; 
    
        $sqlR = "SELECT * FROM admin WHERE email = :email AND password = :pass " ; 
    
        $loginStat = $db->prepare($sqlR) ; 
        $loginStat->execute([
            'email' => $postData['email'], 
            'pass' => $postData['password'],
        ]);
        $logins = $loginStat->fetchAll() ; 
        foreach($logins as $login){
            if(($postData['email'] === $login['email']) && ($postData['password'] === $login['password']) ){
                $loggedUser = [
                    'email' => $login['email']  ,
                    'password' => $login['password'] ,  
                ];

                setcookie(
                    'LOGGED_USER',
                    $loggedUser['email'],
                    [
                        'expires' => time() + 365*24*3600,
                        'secure' => true,
                        'httponly' => true,
                    ]
                );
    
                $_SESSION['LOGGED_USER'] = $loggedUser['email'];
            }
        }
        if(!isset($loggedUser['email']) || !isset($loggedUser['password'])){
            $errorMessage =sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)', $postData['email'],'*****');
        }
    }
    
    
// Si le cookie ou la session sont présentes


if (isset($_COOKIE['LOGGED_USER']) || isset($_SESSION['LOGGED_USER'])){
    $loggedUser = [
        'email' => $_COOKIE['LOGGED_USER'] ?? $_SESSION['LOGGED_USER'],
    ];
}



?>

<? if(!isset($loggedUser['password']) && !isset($loggedUser['email'])) :  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        *{
            padding : 0 ; 
            margin : 0 ; 
            box-sizing : border-box ; 
        }
        body{
            background : #e6eaf9 ;
        }
        .row{
            background : #fff;
            border-radius : 30px ; 
            
        }
        img{
            border-top-left-radius : 30px ;
            border-bottom-left-radius : 30px ;
        }
        .img-logo{
            width : 190px ; 
            height : 90px ; 

        }
        h1{
            font-weight : bold ; 
            padding-top : 5px ;
            padding-bottom : 5px ;

        }
        .btn1{
            border : none ; 
            outline : none ; 
            height : 50px ; 
            width : 100% ; 
            background-color : black ; 
            color : white ; 
            border-radius : 4px ; 
            font-weight : bold ; 
        }
        .btn1:hover{
            background-color : white ; 
            border : 1px solid ; 
            color : black ;
        }
        a{
            text-decoration : none ; 
            color : black;
        }
       
    </style>
    <title>Site- Gestion de Stock</title>
 

</head>
<body>
    <br><br>
   <section class="Form">
       <div class="container">
       <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo($errorMessage); ?>
        </div>
    <?php endif; ?>
           <div class="row no-gutters">
                    <div class="col-lg-5">
                        <img src="images/gestion.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-7 px-5 pt-5">
                                <form action="index.php" method="post">
                                    <h1><!--<img src="images/logo.png" class="img-logo" alt="logo">-->G-STOCK</h1>
                                    <div class="form-row">
                                        <div class="col-lg-7">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control my-2 p-3" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-lg-7">
                                                <label for="password" class="form-label ">Mot de passe</label>
                                                <input type="password" class="form-control my-2 p-3" placeholder="***********" id="password" name="password">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-lg-7">
                                            <button type="submit" class="btn1 mt-3 mb-5">Se Connecter</button>
                                        </div>
                                    </div>
                                    <div class="form-row mb-5">
                                        <a href="modifierPW.php">Mot de passe oublier ?</a>
                                    </div>
                                </form>
                    </div>     
            </div> 
           
       </div>
            
   </section>
</body>
</html>
<?php endif; ?>



