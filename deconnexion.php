<?php
session_start();
if (isset($_SESSION['username'])) {
    //unset($_SESSION['username']);
    // Vous pouvez également détruire complètement la session si nécessaire.
    session_destroy();
    echo "Variable de session supprimée.";
} else {
    echo "La variable de session n'existe pas.";
}
?>