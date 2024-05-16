<?php
//fichier pour la connection a la base de donnée Mysql

$host='localhost';
//utilisateur ayant les droits à la connection
$user = "baba";
$password = "baba";
//nom de la base de donnée
$base = "pixelwar";

$link = connexion_MySQLi_procedural($host, $user,$password,$base);

// Connexion en Mysqli
// Style PROCEDURAL
function connexion_MySQLi_procedural ($host, $user,$password,$base)
{
    $link = mysqli_connect($host,$user,$password,$base);
    
    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }
    mysqli_query($link,"SET NAMES 'utf8'");
    return $link;
}


// fonction qui renvoie un tableau en 2D
if (!function_exists("GetSQL")) {
	function GetSQL($sql, &$tab)
		{
			global $link; global $nbEnr;
			$result = mysqli_query($link,$sql) or die($sql.'<br>'.mysqli_error($link)) ; $row = mysqli_fetch_array($result);
			$nbEnr = mysqli_num_rows($result);
				$k=0;
				$tab[$k] = $row;
				$k++;
			while ( $row = mysqli_fetch_array($result))
			{ 
				$tab[$k] = $row;
				$k++;
			}
                return $nbEnr;
        }
}

// Pratique quand la requête ne renvoie qu'un enregistrement, 
if (!function_exists("GetSQLValue")) {
	function GetSQLValue($sql)
		{
			global $link;
			$result = mysqli_query($link,$sql) or die($sql.'<br>'.mysqli_error($link)) ; $row = mysqli_fetch_array($result);
			return $row[0];
        }
}

// fonction basique qui execute la requête SQL, et ne renvoie rien
if (!function_exists("ExecuteSQL")) {
	function ExecuteSQL($sql)
		{
			global $link;
			$result = mysqli_query($link,$sql) or die($sql.'<br>'.mysqli_error($link)) ; 
			return ;
        }
}



// Ne pas oublier de terminer la page PHP, en fermant la connexion MySQL ( surtout pas ici)
//  mysqli_close($link)
?>