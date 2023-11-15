<?php 
session_start();

if (!isset($_SESSION['quantite'])){
    $_SESSION['quantite'] = 0;
}
if ($_SESSION['nbStock'] > $_SESSION['quantite']){
    $nouvelleLigne = array ($_SESSION['idProduct'], $_SESSION['quantite']);
    array_push($_SESSION['panier'] , $nouvelleLigne);
    header("location:../Boutique/produit.php");
    $_SESSION['quantite']++;
}

else {
    echo "<script> alert('Il n\\'y a plus de produit en stock'); </script>";
    sleep(1);
    header("location:../Boutique/produit.php");
}

?>