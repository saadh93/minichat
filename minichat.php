<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<META NAME="AUTHOR" CONTENT="www.angelz.be">
<META NAME="COPYRIGHT" CONTENT="Copyright (c) 2006 by AngelZ">
<META NAME="GENERATOR" CONTENT="powered by angelz.be - fabrice@angelz.be">
		
<title>Mini Chat AngelZ</title>
<style type="text/css">
<!--
.Style1 {
	color: #FF0000;
	font-weight: bold;
	font-style: italic;
}
.Style2 {
	color: #00FF00;
	font-weight: bold;
	font-style: italic;
}
body {
	background-color: #000000;
}
.Style3 {
	color: #FFFF00;
	font-weight: bold;
	font-style: italic;
}
.Style4 {
	color: #FFFFFF;
	font-weight: bold;
	font-style: italic;
}
-->
</style>
</head>

<body>

<?php
// on verifie que les variable $_POST['pseudo'] et $_POST['message'] existe 
if (isset($_POST['pseudo']) AND isset($_POST['message']))
{
// si oui on les enregistre dans les variables $pseudo et $message
$pseudo=$_POST['pseudo'];
$message=$_POST['message'];

// on se connecte a la BDD pour y enregistre dans la table
mysql_connect('localhost', '', "");
mysql_select_db('site_php_module');
// on enregistre dans la BDD les infos recupeter dans les variables $pseudo et $message
mysql_query("INSERT INTO minichat VALUES('', '$pseudo', '$message')");

}


// on se connecte a la BDD pour y lire dans la table
mysql_connect('localhost', 'root', "");
mysql_select_db('site_php_module');

// on va recupere les données dans la table minichat, on les classe par ordre DESCendant dans une LIMITe de 10 entree(les 10 derniere vu que c ds un ordre DESC) dans la variable $Data
$data=mysql_query("SELECT pseudo,message FROM minichat ORDER BY ID DESC LIMIT 0, 10") or die(mysql_error()); // 
mysql_close(); //on ferme la connection MySql
// on passe en HTML 
?>

<CENTER>
  <H1><p class="Style3">Mini Chat </p></H1>
  <p>
    <textarea cols="120" rows="30">
<?php
// on repasse en php :)

while (false !== ($donnee = mysql_fetch_array($data))) // on fait une boucle (on va chercher dans la Variable $data et on les classe dans ARRAY de la variable $donnee
{
?>

<?php echo htmlentities($donnee['pseudo']); echo ">>>>"; echo htmlentities($donnee['message']); // on affiche les donnees recuilli grace a un echo

}
?>
      </textarea>
    </p>
</CENTER>


<CENTER>
<p align="center">
<form action="minichat.php" method="post">
<span class="Style2">Pseudo :</span>
<?php // on verifi si la variable $pseudo existe si oui on affiche le pseudo a la place du champ text
if(!empty($pseudo))
echo '<span class="Style4">'.$pseudo.'</span><input type="hidden" name="pseudo" value="'.htmlentities($pseudo).'" />';
else // sinon on affiche le champ texte
echo '<input name="pseudo" type="text" />';
?>
<span class="Style1">Message :</span>
<input name="message" type="text" size="100" />
<input type="submit" name="Submit" value="Envoyer" />   
</form>

</CENTER>

		<p align="center">
			<a target="_blank" href="http://www.angelz.be">
				www.angelz.be
			</a>
		</p>
</body>
</html>
