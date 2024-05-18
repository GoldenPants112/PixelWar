<?php
include("config/config.inc.php");

if (isset($_POST["pseudo"]) ){


    //nom/mail/mdp avec des quotes pour les requettes sql
    $user_name=QuoteStr($_POST["pseudo"]);
    $user_mail=QuoteStr($_POST["mail"]);
    $user_paswrd=QuoteStr(hash("sha256",$_POST["mdp"]));

    //requette sql qui permet de verifier si le pseudo rentrer par l'utilisateur est deja pris.
    $sql="select pseudo from `utilisateur` where pseudo = ".$user_name;
    $pseudo_bdd=GetSQLValue($sql);

    //condition qui verifie si le pseudo est pris (present dans la bdd)
    if (isset($pseudo_bdd)){
        $pseudo_pris=true;
    }
    else{
        $sql="insert into utilisateur (pseudo,mail,mdp) values($user_name, $user_mail, $user_paswrd)";
        ExecuteSQL($sql);
        $pseudo_pris=false;
    }

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

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
        <br>

        <?php 
        if(isset ($pseudo_pris)){
            if($pseudo_pris){
                echo"<div>Ce pseudo est déjà pris, veuillez prendre un autre.</div>";

            }
            else{
                echo "<div>Le compte a été crée avec succes.</div>";
                
            }
        }

        ?>
        <br>
        <a href="seconnecter.php">Vous avez déjà un compte</a>
</form>
</body>
</html>