<?php 

// if($_SESSION['isConnected']== false){
//     header("Location: seconnecter.php");

// };

$pseudo=$_GET["user"];

//condition pour ne pas permettre l'acces a cette page sans pseudo
if($_GET['user'] == NULL){
    header("Location: seconnecter.php");
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
    <?php echo "<h1>Bienvenue a PixelWar ".$pseudo." </h1>";
    
    echo "<h2> Selection de Grilles</h2>";    
    ?>




    <a href="seconnecter.php">Deconnection</a>
</body>
</html>