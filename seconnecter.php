<?php
include("config/config.inc.php");
$mauvais_mdp=false;
$mauvais_compte=false;

if(isset($_GET["isDeconected"])){
    $_SESSION['isConnected']=false;
}




//condition pour verifier si le pseudo existe dans la bdd
if (isset($_POST["pseudo"]) ){
    
    //nom de l'utilisateur avec des quotes pour les requettes sql
    $user_name=QuoteStr($_POST["pseudo"]);

    //nom de l'utilisateur sans quotes 
    $user_name_nonquote=$_POST["pseudo"];

    //penser à le hash en sha256 à l'aide de la foction hash('sha256',chaine)
    $sql="select mdp from `utilisateur` where pseudo = ".QuoteStr($_POST["pseudo"]);
    $pass_bdd=GetSQLValue($sql);

            
    // la variable $hash correspond au sha256 du password

    if (isset($pass_bdd)){

        $hash_poste=hash('sha256', $_POST["mdp"]);
        //$hash_poste= $_POST["mdp"];
        // si le hash que je poste est égale à celui qui est dans la bdd, c'est que le couple Login/password est correct
        
        if($pass_bdd==$hash_poste){
                $_SESSION['isConnected']=true;
                $_SESSION['pseudo']=$_POST["pseudo"];
                // je vais à la page liste.php
                // header("location: liste.php");

                header("Location: affichagegrille.php?user=".$user_name_nonquote);

                //header("Location: detail.php?param=".$last_id);

            }
        else{
                $mauvais_mdp=true;
            }

    }
    else{ 
            $mauvais_compte=true;
        }
     
    //condition qui nous dit si l'utilisateur n'est pas connecter     
    if ($mauvais_mdp == true){
        $_SESSION['isConnected']=false;
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
<h1> Se connecter </h1>





<form method="POST">

    <h3> Entrer votre nom d'utilisateur</h3>
    <input type="text" name="pseudo" value="" require>

    <h3> Entrer votre Mot de passe</h3>
    <input type="password" name="mdp" value="" require>

    <input type="submit" value="Valider">
    <br>
    <a href="PageAcceuil.php">Créer un compte</a>

<?php if ($mauvais_mdp) { ?>
            <div>
                Vous avez saisi un <strong>mauvais</strong> mot de passe. Essayez un nouveau.
            </div>
        <?php } ?>

        <?php if ($mauvais_compte) { ?>
            <div>
                <strong>Attention!</strong> Le compte que vous avez saisie n'existe pas.
            </div>
        <?php } ?>
        
</body>
</html>