<?php
    include("config/config.inc.php");

    $nom_grille=$_GET["nom"];
    $pseudo=$_GET["pseudo"];

    //ce bloc a pour fonction de recuperer le createur d'une grille
    //pour les requette sql
    $nom_grille_quote=QuoteStr($nom_grille);
    $sql_createur_id="select user_id from `grille` where `nom`=".$nom_grille_quote;
    $createur_id=GetSQLValue($sql_createur_id);
    //pour les requette sql
    $createur_id_quote=QuoteStr($createur_id);
    $sql_createur="select pseudo from `utilisateur` where `id`=".$createur_id_quote;
    $createur=GetSQLValue($sql_createur);     //recupere le createur

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
    <div>
        <h1>PixelWar</h1>
        <?php echo"<h2>Grille crée par ".$createur."</h2>";
    ?>
        <colors>
            <color class="red" title="red"></color>
            <color class="green" title="green"></color>
            <color class="blue" title="blue"></color>
            <color class="yellow" title="yellow"></color>
            <color class="orange" title="orange"></color>
            <color class="pink" title="pink"></color>
        </colors>
        <grille>
            <pixels>
                
            </parts>
        </grille>
    </div>

    <br>
    
    
    <br>
    <?php
    echo '<a href="selection_grille.php?user='.$pseudo.'">Retour à la selection</a>';

    ?>

    <script src="script.js"></script>
</body>
</html>
