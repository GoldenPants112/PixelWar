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


//condition pour ne pas permettre l'acces a cette page sans pseudo
if($_GET['user'] == NULL){
    header("Location: seconnecter.php");
}

//requette sql qui permet de recuperer l'id de l'utilisateur.
$sql_id=$link->prepare("select id from `utilisateur` where pseudo =?");
$sql_id->bind_param("s",$pseudo);
$sql_id->execute();
$id_result=$sql_id->get_result();
$id_row=$id_result->fetch_assoc();
$id=$id_row ? $id_row["id"] :null;


//selectionne toutes les grilles 
$sql_grille="select * from `grille`";
$nbr_grille= GetSQL($sql_grille,$grilles);



//condition pour un creation de grille
if (isset($_POST["ajout_grille"]) ){
    if (empty($nom_grille)){
        $nom_requis=true;
    }
    else{
        //requette sql qui permet de verifier si le nom de la grille rentrer par l'utilisateur est deja pris. (a l'aide de la prepared statment)
        $sql_grille =$link->prepare("select `nom` from `grille` where `nom`=?");
        $sql_grille->bind_param("s",$nom_grille);
        $sql_grille->execute();
        $grille_result= $sql_grille->get_result();
        $grille_row = $grille_result->fetch_assoc();
        $grille_bdd = $grille_row ? $grille_row["nom"]:null;

        
        if ($grille_bdd !== null){
            $nom_grille_pris=true;
        }
        else{
            $sql_insert_grille=$link->prepare("insert into grille(nom,user_id) values(?,?)");
            $sql_insert_grille->bind_param("ss",$nom_grille,$id);
            $sql_insert_grille->execute();
            // ExecuteSQL($sql);
            $ajout_grille=true;
            $sql_insert_grille->close();
        }
        
    }
    
    

}
$sql_id->close();

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
                    $sql="select pseudo from utilisateur where ";
                    echo"<br>";
                echo '</TR>';
            }





    ?>
    <form method="post">
    <p>Nom de votre nouvelle grille:</p>
    <input type="text" name="nom" value="">
    <br>
    <input class="button" type="submit" value="+ Crée une grille" name="ajout_grille">

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