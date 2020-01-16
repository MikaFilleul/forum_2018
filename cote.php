<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
    <h3>Topic</h3>

    <?php
    if(isset($_SESSION['categorie'])){
        while($_SESSION['categorie']->fetch()){
            echo $_SESSION['categorie']['Intitule'];
        }
    }
    ?>
</html>