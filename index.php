<h1>Eval</h1>

<?php

session_start();

spl_autoload_register(function ($className){
    require_once './classes/' . $className . '.php';
    });
    


$_SESSION['message'] = "Il fait chaud";


require_once './functions/autoLoad.php';
autoLoad("*.php");

require __DIR__ . '/vendor/autoload.php';


date_default_timezone_set('Europe/Paris');


if (verifierAdmin()) 
    require_once './includes/headerAdmin.php';
else 
    require_once './includes/header.php';


require_once './includes/main.php';
require_once './includes/footer.php';
