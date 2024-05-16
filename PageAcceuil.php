<?php
include("config/config.inc.php");
if (isset($_POST["pseudo"]) ){
    $user_name=QuoteStr($_POST["pseudo"]);
    $user_mail=QuoteStr($_POST["mail"]);
    //penser à le hash en sha256 à l'aide de la foction hash('sha256',chaine)
    $user_paswrd=QuoteStr(sha1($_POST["mdp"]));

    $sql="insert into utilisateur (pseudo,mail,mdp) values($user_name, $user_mail, $user_paswrd)";
    ExecuteSQL($sql);
 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Création de compte</h1>


    <form method="POST">

        <h3> Entrer un nom d'utilisateur</h3>
        <input type="text" name="pseudo" value="" require>

        <h3> Entrer votre mail de passe</h3>
        <input type="text" name="mail" value="" require>

        <h3> Entrer un Mpd de passe</h3>
        <input type="password" name="mdp" value="" require>

        <input type="submit" value="Valider">
</form>
</body>
</html>