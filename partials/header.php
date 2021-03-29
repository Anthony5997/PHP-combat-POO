<?php
 
        session_start();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Norican&family=Playball&display=swap">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Street Facteur</title>
</head>
<body>
<nav>
    <div class="topnav">
    <h3>Street Facteur</h3>
    <br>
    <?php  if(empty($_SESSION["connect"])){
            echo "Crée ou selectionné un personnage";
    }else{
        echo "<div class='d-flex flex-row-reverse'>
                <a href="."partials/deco.php".">Déconnexion</a>"; ?>
            </div>
   <?php } ?>
    </div>
    </div>
 </nav>
<br><br> 
