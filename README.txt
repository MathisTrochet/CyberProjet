Variables de session :

$_SESSION['username'];
$_SESSION['ppAdress'];
$_SESSION['temp'];
$_SESSION['id_comment'];
$_SESSION["photo"];


if (isset($_SESSION['username'])){
    echo 'Variable de session "username" existe';
}
if (isset($_SESSION['ppAdress'])){
    echo 'Variable de session "ppAdress" existe';
}
if (isset($_SESSION['temp'])){
    echo 'Variable de session "temp" existe';
}
if (isset($_SESSION['id_comment'])){
    echo 'Variable de session "id_comment" existe';
}
if (isset($_SESSION['photo'])){
    echo 'Variable de session "photo" existe';
}
