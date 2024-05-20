<?php 
include("config/config.inc.php");

//nom de l'utilisateur sans quotes 
$pseudo=$_GET["user"];

//recuperer le nom de la grille renter par l'utilisateur
if (isset($_POST["nom"])){      //condition pour eviter un warning au lancement de la page
    $nom_grille=$_POST["nom"];
    $nom_grille_quote=QuoteStr($nom_grille);  //pour les rqeutte sql
}


//initialisation des variables   
$nom_requis=false;
$ajout_grille=false;
$nom_grille_pris=false;

//nom de l'utilisateur avec des quotes pour les requettes sql
$pseudo_quote=QuoteStr($pseudo);



//condition pour ne pas permettre l'acces a cette page sans pseudo
if($_GET['user'] == NULL){
    header("Location: seconnecter.php");
}

//requette sql qui permet de recuperer l'id de l'utilisateur.
$sql_id="select id from `utilisateur` where pseudo = ".$pseudo_quote;
$id=GetSQLValue($sql_id);
$id_quote=QuoteStr($id);

//selectionne toutes les grilles de cet utilisateur
// $sql_user_grille="select * from `grille` where user_id = ".$id_quote;
// echo "id grille :".GetSQL($sql_user_grille,$grille_utilisateur);
// echo "<br>";

//selectionne toutes les grilles 
$sql_grille="select * from `grille`";
$nbr_grille= GetSQL($sql_grille,$grilles);



//condition pour un creation de grille
if (isset($_POST["ajout_grille"]) ){
    if (empty($nom_grille)){
        $nom_requis=true;
    }
    else{
        //requette sql qui permet de verifier si le nom de la grille rentrer par l'utilisateur est deja pris.
        $sql="select nom from `grille` where nom = ".$nom_grille_quote;
        $nom_grille_bdd=GetSQLValue($sql);
        if (isset($nom_grille_bdd)){
            $nom_grille_pris=true;
        }
        else{
            $sql="insert into grille(nom,user_id) values($nom_grille_quote,$id_quote)";
            ExecuteSQL($sql);
            $ajout_grille=true;
        }
        
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
    <?php echo "<h1>Bienvenue à PixelWar ".$pseudo." </h1>";
    
    echo "<h2> Sélection de Grilles</h2>";
     
 
        for ($i=0;$i<$nbr_grille;$i++)
            {
                $nom_grille_affiche=$grilles[$i][1];

                echo '<TR>';
                //affiche la liste des grilles.
                    echo '<td><a href="grille.php?nom='.$nom_grille_affiche.'&pseudo='.$pseudo.'">'.$nom_grille_affiche.'</a></td>';
                    echo"<br>";
                echo '</TR>';
            }





    ?>
    <form method="post">
    <p>Nom de votre nouvelle grille:</p>
    <input type="text" name="nom" value="">
    <br>
    <input type="submit" value="+ Creation de nouvelles grilles" name="ajout_grille">

    </form>
    <?php
    if($ajout_grille){
        echo "<div>Vous avez ajouter une grille! Actualiser la page pour la visualiser dans la liste.</div>";
    }
    else if ($nom_requis){
        echo "<div class='warning'>Un nom de grille est requis pour la création</div>";
    }
    else if($nom_grille_pris){
        echo "<div class='warning'>Ce nom de grille est déjà pris, veuillez en choisir un autre.</div>";
    }
    echo "<br>";   
    ?>

    

    <a href="seconnecter.php">Déconnection</a>
</body>
</html>