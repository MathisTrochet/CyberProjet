function deconnexion() {
    var xhr = new XMLHttpRequest();

    xhr.open('GET', '../deconnexion.php', true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // La session a été détruite côté serveur, vous pouvez maintenant effectuer des actions côté client, comme rediriger l'utilisateur vers la page de connexion.
            window.location.href = '../index.php';
        }
    };

    xhr.send();
}
