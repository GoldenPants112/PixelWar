<?php
    $nom_grille=$_GET["nom"];
    $pseudo=$_GET["pseudo"];
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
        <grille>
            <pixels>
                
            </parts>
        </grille>
    </div>


    <br>
    <?php
    echo '<a href="selection_grille.php?user='.$pseudo.'">Retour à la selection</a>';

    ?>

    <script src="script.js"></script>
</body>
</html>
