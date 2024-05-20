<?php
include("config/config.inc.php");
$pseudo_pris=false;
$compte_creer=false;
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
        $compte_creer=true;
        
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
        <p class="infomsg">Les * designent les champs obligatoires</p>
        <h3>*Entrer un nom d'utilisateur</h3>
        <input type="text" name="pseudo" value="" placeholder="example30" required>

        <h3>*Entrer votre adresse mail</h3>
        <input type="text" name="mail" value="" placeholder="example@example.com" required>

        <h3>*Entrer un Mpd de passe</h3>
        <input type="password" name="mdp" value="" placeholder="example12345" required>
        <br>
        <br>
        <input type="submit" value="Valider">
        <br>
        <br>
        <?php 
        if($pseudo_pris){
            echo"<div><strong>Ce pseudo est déjà pris</strong> !</div>";

        }
        else if ($compte_creer){
            echo "<div>Le compte a été crée avec succès.</div>";
                
        }
        else{

        }
            
        

        ?>
        <br>
        <a href="seconnecter.php">Vous avez déjà un compte</a>
</form>
</body>
</html>