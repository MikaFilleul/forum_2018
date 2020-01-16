<?php
    if(isset($_SERVER['REQUEST_METHOD']) && is_string($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'GET'){

        session_start();
        include("header.php");
        include("cote.php");
?>
<!DOCTYPE html>
<html>
<p> Vous avez déjà un compte ? <a href="connexion.php"> Connectez-vous </a>
<p>Inscription : </p>
<form method="post" action="ajoutUtilisateur.php">
    <label for="login">Login : </label>
    <input name="login" id="login" type="text" required autofocus><br><br>

    <label for="pseudo">Pseudo : </label>
    <input name="pseudo" id="pseudo" type="text" required><br><br>

    <label for="mail">Mail : </label>
    <input name="mail" id="mail" type="email" required><br><br>

    <label for="mdp">Mot de passe : </label>
    <input name="mdp" id="mdp" type="password" required><br><br>

    <label for="confirm" id="confirm" >Confirmer mot de passe : </label>
    <input name="confirm" id="confirm" type="password" required><br><br>

    <input type="submit" value="Soumettre"/>
</form>



<?php

    if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
        echo "<div class=\"message\">" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    include("footer.php");
?>
</html>

<?php
    }
    else{
        header("Location:accueil.php");
    }
?>