function hide() {
    var element = document.getElementById("mdp");
    if (element.type === "text"){
        element.type = "password";
    }
    else{
        element.type = "text";
    }
}

function Hide() {
    var element = document.getElementById("mdp");
    element.type = "password";
}

function Show() {
    var element = document.getElementById("mdp");
        element.type = "text";
}

function wrong() {
    console.log("Mauvais mot de passe");
}

function visibilityOn(){
    var element = document.getElementById("invisible");
    element.style.visibility = "visible";
}

function indexDeconnexion() {
    var xhr = new XMLHttpRequest();

    xhr.open('GET', 'deconnexion.php', true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // La session a été détruite côté serveur, vous pouvez maintenant effectuer des actions côté client, comme rediriger l'utilisateur vers la page de connexion.
            window.location.href = 'Authentification/connexionSEC.php';
        }
    };

    xhr.send();
}

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

function yo(){
alert(5);
}

window.addEventListener("scroll", function() {
    // Récupérez la position de défilement actuelle.
    const scrollPosition = window.scrollY;
    
    // Enregistrez la position de défilement dans le stockage local.
    localStorage.setItem("scrollPosition", scrollPosition);
});

window.addEventListener("load", function() {
    // Vérifiez s'il y a une position enregistrée dans le stockage local.
    const scrollPosition = localStorage.getItem("scrollPosition");
    
    // Si une position est enregistrée, réglez la position de défilement sur cette valeur.
    if (scrollPosition !== null) {
        window.scrollTo(0, scrollPosition);
    }
});