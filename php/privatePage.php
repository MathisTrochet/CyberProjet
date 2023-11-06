<?php 



if (isset($_SESSION['username'])){ //recupere le blaze du type
    $username = $_SESSION['username']; 
}
else {header('Location:php/exclure.php');exit;}



?>