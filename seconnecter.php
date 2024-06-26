<?php
include("config/config.inc.php");
$mauvais_mdp=false;
$mauvais_compte=false;

if(isset($_GET["isDeconected"])){
    $_SESSION['isConnected']=false;
}




//condition pour verifier si le pseudo existe dans la bdd
if (isset($_POST["mail"]) ){
    
    //mail de l'utilisateur sans quotes 
    $user_mail=$_POST["mail"];
 
    //utilisation des prepared statments pour avoir le mail et le mdp chiffre
    $select_mdp_sql=$link->prepare("select mdp from `utilisateur` where mail=?");
    $select_mdp_sql->bind_param("s", $user_mail);
    $select_mdp_sql->execute();
    $mdp_result=$select_mdp_sql->get_result();

    if ($mdp_row = $mdp_result->fetch_assoc()) {
        $pass_bdd = $mdp_row["mdp"];
    } else {
        $pass_bdd = null; 
    }
    
    $select_mdp_sql->close();
    

    $select_user_sql=$link->prepare("select pseudo from `utilisateur` where mail=?");
    $select_user_sql->bind_param("s", $user_mail);
    $select_user_sql->execute();
    $user_result=$select_user_sql->get_result();

    if ($user_row = $user_result->fetch_assoc()) {
        $user_name = $user_row["pseudo"];
    } else {
        $user_name = null; 
    }
    $select_user_sql->close();

    if ($pass_bdd !== null){
        
        $hash_poste=hash('sha256', $_POST["mdp"]);
        // si le hash que je poste est égale à celui qui est dans la bdd, c'est que le couple Login/password est correct
        if($pass_bdd==$hash_poste){
                $_SESSION['isConnected']=true;
                $_SESSION['mail']=$user_mail;

                header("Location: selection_grille.php?user=".$user_name);


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

    <h3> Entrer votre mail</h3>
    <input type="text" name="mail" value="" placeholder="example@example.com" required>

    <h3> Entrer votre Mot de passe</h3>
    <input type="password" name="mdp" value="" placeholder="example12345" required>
    <br>
    <br>
    <input class="button" type="submit" value="Valider">
    <br>
    <br>
    

    <?php if ($mauvais_mdp) { ?>
            <div class="warning">
                Le mot de passe que vous avez saisie n'est pas correcte.
            </div>
            
        <?php } ?>

        <?php if ($mauvais_compte) { ?>
            <div>
                <strong>Attention!</strong> Le compte que vous avez saisie n'existe pas.
            </div>
        <?php } ?>
    <br>    
    <a href="creation_compte.php">Créer un compte</a>
    <br>
    <br>
    <a href="index.php">Page d'Acceuil</a>

</body>
</html>