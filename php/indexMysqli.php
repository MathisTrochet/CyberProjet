<?php
$serveur = "127.0.0.1";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "informationutilisateurs";

// const MOTDEPASSE = 'azerty';

// Établir la connexion
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>La securité  avant tout</title>
    <link rel="stylesheet" type = "text/css" href="Style/index.css"> 
    <script src="Js/fonctionDeBase.js"></script>
</head>
<body>
    <header>
        <h1>MYPENTESTERLAB</h1>
    </header>

    <main>

        <form  action = "" method="post">
            <h2>Rentrez vos coordonnées ici :</h2>
            <br>
            <div class="inputContainer">
                <label>Votre Nom </label>
                <input type = "text" name = "lastName">
            </div>
            <br>
            <div class="inputContainer">
                <label>Votre Prenom </label>
                <input type = "text" name = "firstName">
            </div>
            <br>
            <div class="inputContainer">
                <label>Votre Age </label>
                <input type = "text" name = "age">
            </div>
            <br> 
            <div class="inputContainer">
                <label>Votre mail </label>
                <input type = "text" name = "mail">
            </div>
            <br>
            <div class="inputContainer">
                <label>Votre Mot de passe </label>
                <input id = "mdp" type = "password" name = "mdp">
                <a href="javascript:void(0);" onmousedown="Show();" onmouseup="Hide();">
                    <img id = "monImage" src="Image/iconeMdp.png" alt="iconemdp">
                </a>
            </div>

            <br><br>

            <input id = "save" type="submit" name = "Enregistrer" value="Enregistrer">
            
            <?php
            /*
                if (isset($_POST["Enregistrer"]))  {
                    $Mail = $_POST["mail"];
                    $Mdp = $_POST["mdp"];
                    echo 'yo';  
                    $mdpCompare = "SELECT mdp FROM infousers WHERE mail = $Mail";
                    if ($mdpCompare != $Mdp){
                        echo 'Mot de passe incorrect';
                        }
                    else echo 'Mot de passe correct';  
                }
            */
            ?>

         </form>

    </main>

    <footer>
    </footer>
</body>
</html>

<?php
    if (isset($_POST["Enregistrer"]))  {

        

        $Nom = $_POST["lastName"];
        $Prenom = $_POST["firstName"];
        $Age = $_POST["age"];
        $Mail = $_POST["mail"];
        $Mdp = $_POST["mdp"];
    
        
        
        $mdpCompare = "SELECT Mdp FROM infousers WHERE Mail = ?";
        $stmt = $connexion->prepare($mdpCompare);
        $stmt->bind_param("s", $Mail);
        $stmt->execute();
        $stmt->bind_result($MdpStocke);
        $stmt->fetch();
        
        //$MdpStocke = "SELECT mdp FROM infousers WHERE mail = $Mail";
        $connexion->close();
        $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);


        

        if ($MdpStocke == $Mdp){

            if ($connexion->connect_error) {
                die("Échec de la connexion : " . $connexion->connect_error);
            }

            $sql = "INSERT INTO infousers (Nom, Prenom, Age, Mail, Mdp) VALUES ('$Nom', '$Prenom' , '$Age', '$Mail', '$Mdp')";
            

        //executer la requete
        if ($connexion->query($sql) === TRUE) {
            echo "Enregistrement réussi. <br>";
        } 
        else {
            echo "Erreur : " . $sql . "<br>" . $connexion->error;
        }

        }
        else echo 'mot de passe different';
    
    }




// Fermer la connexion à la base de données
$connexion->close();
?>

