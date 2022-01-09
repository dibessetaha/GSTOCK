<?php
    session_start() ; 
    setcookie(
    'LOGGED_USER',
    '',
    [
        'expires' => time() + 365*24*3600,
        'secure' => true,
        'httponly' => true,
    ]
    );
    session_destroy();

    header('location:index.php');



?>