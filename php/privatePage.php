<?php 



if (isset($_SESSION['username'])){ //recupere le blaze du type
    $username = $_SESSION['username']; 
}
else {header('Location:/CyberProjet/php/exclure.php');exit;} 
                                                                        //(car je suis appelé par un include)



?>