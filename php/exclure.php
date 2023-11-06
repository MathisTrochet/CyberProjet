<?php 
echo '<script>
alert("Vous devez être connecté pour accéder à la page que vous souhaitez");
setTimeout(function() { //sert a rien ça juste pour reutiliser si jamais
    window.location.href = "/CyberProjet/Authentification/connexionSEC.php";
}, 0000); // Délai en millisecondes (1000 ms = 1 seconde)
</script>';
?>