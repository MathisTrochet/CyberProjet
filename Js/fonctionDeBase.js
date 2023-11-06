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



function truee(){
alert("truee");
}

function falsee(){
    alert("falsee");
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