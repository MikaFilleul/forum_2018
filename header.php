<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <title> Forum de Mika </title>
        <meta charset="UTF-8">
        <meta name="description" content="projet de prog web 2018/2019">
        <meta name="author" content="Mika Filleul">
        <meta name="viewport" content="width=device-width, initial-scale=1,0">
    </head>
    <?php
        if($_SESSION['login'] !== null){
    ?>
            <header class = "entete">
                <a href="profil.php"> <?php echo $_SESSION['login'] ?> </a>
                <a href="deconnexion.php">Déconnexion</a>
            </header>
    <?php       
        }
        else{
    ?>
            <a href="inscription.php">Inscription</a>
            
            <a href= "connexion.php">connexion</a>
    <?php
        }
    ?>

</html>