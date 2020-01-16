<?php
define('SQL_DSN', 'mysql:host=osr-mysql.unistra.fr; dbname=filleul');
define('SQL_USERNAME', 'filleul');
define('SQL_PASSWORD', 'Bionicle06sql'); //à préciser plus tard;

try{
    $db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
}
catch(Exception $e){
    echo 'Erreur de connexion à la BDD : ' . $e->getMessage();
    exit;
}
?>
