<?php 
include("config/config.inc.php");


//nom de l'utilisateur avec des quotes pour les requettes sql
$pseudo=$_GET["user"];
$nom_grille=$_GET["nom"];

//nom de l'utilisateur sans quotes 
$pseudo_quote=QuoteStr($pseudo);
$nom_grille_quote=QuoteStr($nom_grille);


//condition pour ne pas permettre l'acces a cette page sans pseudo
if($_GET['user'] == NULL){
    header("Location: seconnecter.php");
}

//requette sql qui permet de recuperer l'id de l'utilisateur.
$sql_id="select id from `utilisateur` where pseudo = ".$pseudo_quote;
$id=GetSQLValue($sql_id);
$id_quote=QuoteStr($id);

//selectionne toutes les grilles de cet utilisateur
$sql_user_grille="select * from `grille` where user_id = ".$id_quote;
echo "id grille :".GetSQL($sql_user_grille,$grille_utilisateur);
echo "<br>";

//selectionne toutes les grilles 
$sql_grille="select * from `grille`";
$nbr_grille= GetSQL($sql_grille,$grille);

echo "GetSQL:".$nbr_grille;
echo "<br>";
echo "Il ya ".$nbr_grille." grilles au totale";
// for($i=0;$i<$sql_grille;$i++){
//     //echo $grille[$i];
// }
// echo "<br>";

if (isset($_POST["ajout_grille"]) ){
   
    $sql="insert into grille(user_id) values($id_quote)";
    ExecuteSQL($sql);
    echo "<br>";
    echo "Vous avez ajouter une grille!";

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
    <?php echo "<h1>Bienvenue a PixelWar ".$pseudo." </h1>";
    
    echo "<h2> Selection de Grilles</h2>";
     


    ?>


    <form method="post">
    <p>Nom de votre nouvelle grille</p>
    <input type="text" name="nom" value="" require>
    <input type="submit" value="+ Creation de nouvelles grilles" name="ajout_grille">

    </form>



    <a href="seconnecter.php">Deconnection</a>
</body>
</html>