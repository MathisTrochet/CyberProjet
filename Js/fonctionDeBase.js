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

function animationPP(){
    const imageContainer = document.querySelector('.imageContainer');
    
    // Ajoutez la classe pour déclencher l'animation
    imageContainer.classList.add('transi');
}