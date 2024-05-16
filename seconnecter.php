<?php
include("config/config.inc.php");

if (isset($_POST["pseudo"]) ){
    $user_name=QuoteStr($_POST["pseudo"]);
    //penser à le hash en sha256 à l'aide de la foction hash('sha256',chaine)
    $sql="select mdp from `utilisateur` where pseudo = ".QuoteStr($_POST["pseudo"]);
    $pass_bdd=GetSQLValue($sql);

            
    // la variable $hash correspond au sha256 du password

    if (isset($pass_bdd))
    {

        $hash_poste=hash('sha256', $_POST["mdp"]);
        //$hash_poste= $_POST["mdp"];
        // si le hash que je poste est égale à celui qui est dans la bdd, c'est que le couple Login/password est correct
        if($pass_bdd==$hash_poste)
            {
                $_SESSION['isConnected']=true;
                $_SESSION['pseudo']=$_POST["pseudo"];
                // je vais à la page liste.php
                // header("location: liste.php"); 
                header("location: index.html");
            }
        else
            {
                $bMauvaisMotDePasse=true;
            }

    }
    else
        { 
            $bMauvaisCompte=true;
        }
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
<h1> Se connecter </h1>


<form method="POST">

    <h3> Entrer votre pseudo</h3>
    <input type="text" name="pseudo" value="" require>

    <h3> Entrer votre Mot de passe</h3>
    <input type="password" name="mdp" value="" require>

    <input type="submit" value="Valider">

</body>
</html>