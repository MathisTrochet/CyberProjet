function deconnexion() {
    var xhr = new XMLHttpRequest();

    xhr.open('GET', 'http://127.0.0.1/CyberProjet/deconnexion.php', true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // La session a été détruite côté serveur, vous pouvez maintenant effectuer des actions côté client, comme rediriger l'utilisateur vers la page de connexion.
            window.location.href = 'http://127.0.0.1/CyberProjet/index.php';
        }
    };

    xhr.send();
}