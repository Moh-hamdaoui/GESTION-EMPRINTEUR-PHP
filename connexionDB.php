<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'gestion de bibliotheque';

$conn = mysqli_connect($host, $user, $pass, $db);
if($conn){
    return $conn;
}else{
    echo 'Erreur Connexion'.'<br>';
}


?>