<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpaie";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
} 
?>
<?php 
$mat=@$_POST['matricule'];
$nom=@$_POST['nom'];
$prenom=@$_POST['prenom'];
$tm=@$_POST['tm'];
$mess='';
//inserer
if(isset($_POST['bajout'])&&!empty($mat)){
$sql=mysqli_query($conn,"insert into salaires(matricule,nom,prenom,t_mensuel) 
values('$mat','$nom','$prenom','$tm')");
if($sql){
$mess="<br>Insertion r�ussie !";

}
else
$mess="<br>Erreur d'insertion !";
}

?>
<?php 
//modifier
if(isset($_POST['bmodif'])&&!empty($mat)){
$sql=mysqli_query($conn,"update salaires set nom='$nom',prenom='$prenom',t_mensuel='$tm' where matricule='$mat'");
if($sql){
$mess="<br>Modification r�ussie !";
}
else
$mess="<br>Impossible de modifier !";
}
?>
<?php 
//supprimer
if(isset($_POST['bsupp'])&&!empty($mat)){
$sql=mysqli_query($conn,"delete from salaires where matricule='$mat'");
if($sql){
$mess="<br>Suppr�ssion r�ussie !";
}
else
$mess="<br>Impossible de supprimer !";
}

?>
<!-- Created by TopStyle Trial - www.topstyle4.com -->
<!DOCTYPE html>
<html>
<head>
	<title>chcode_appli</title>
		<link rel="stylesheet" type="text/css" href="lestyle.css">
</head>

<body>
	<div align="center">
	<a href="paie.php">PAIEMENT</a><br>
		<a href="listepaie.php">LISTE PAIEMENT</a>
	<h2 >Gestion salari�s</h2>
	<form action="" method="POST">
	<label><b>Matricule :</b></label>
	<input type="text" name="matricule" value="<?php print"$mat";?>"><br>
	<label><b>Nom :</b></label>
	<input type="text" name="nom" value="<?php print"$nom";?>"><br>
	<label><b>Prenom :</b></label>
	<input type="text" name="prenom" value="<?php print"$prenom";?>"><br>
	<label><b>Salaire mensuel :</b></label>
	<input type="text" name="tm"  value="<?php print"$tm";?>"><br>
	<input type="submit" name="bajout" value="Ajouter">
	<input type="submit" name="bmodif" value="Modifier">
	<input type="submit" name="bsupp" value="Supprimer">
	<label ><?php echo "$mess";?></label>
	</form>
	<?php 
	print'<h2>Liste des salari�s :</h2>';
	//l'affichage d'un vol disparait de la liste un jour apr�s la date de d�part 
	     $rq=mysqli_query($conn,"select * from salaires ");
	print'<table border="1" class="tab"><tr><th>MATRICULE</th><th>NOM</th>
	<th>PRENOM</th><th>SALAIRE MENSUEL (FCFA)</th></tr>';
	     while($rst=mysqli_fetch_assoc($rq)){
	     
	       
	         print"<tr>";
	         echo"<td>".$rst['matricule']."</td>";
	         echo"<td>".$rst['nom']."</td>";
	         echo"<td>".$rst['prenom']."</td>";
	         echo"<td>".$rst['t_mensuel']."</td>";
	         print"</tr>";   
	     }
	   print'</table>';
	   
	   /*application r�alis�e du 03 au 07 Mai 2020 � N'djam�na au Tchad par
Targoto Christian
Contact: 23560316682 / ct@chrislink.net */
	?>
	
	</div>
</body>
</html>