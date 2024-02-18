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

$an=@$_POST['annee'];
$mois=@$_POST['mois'];
$mat=@$_POST['matricule']; 
?>
<!-- Created by TopStyle Trial - www.topstyle4.com -->
<!DOCTYPE html>
<html>
<head>
	<title>chcode_appli</title>
		<meta charset="utf8">
			<link rel="stylesheet" type="text/css" href="lestyle.css">
</head>

<body>
	<div align="center" >
	<a href="index.php">ACCUEIL</a><br>
		<a href="paie.php">ENREGISTREMENT PAIE</a><br><br>
		<h2>Etat des paiements :</h2>
	<form action="" method="POST">
	<label><b>Matricule :</b></label>
	<input type="text" name="matricule" value="<?php echo"$mat";?>" >
	<input type="submit" name="brech1" value="Chercher"><br><br>
	<label><b>Année :</b></label>
	<input type="number" name="annee" value="2020" min="1900">
		<label ><b>Mois :</b></label>
	<select name="mois" id="mois"  >
         <option  value="1">Janvier</option>
        <option  value="2">Février</option>
        <option  value="3">Mars</option>
        <option  value="4">Avril</option>
        <option  value="5">Mai</option>
        <option  value="6">Juin</option>
        <option  value="7">Juillet</option>
        <option  value="8">Aout</option>
        <option  value="9">Septembre</option>
        <option  value="10">Octobre</option>
        <option  value="11">Novembre</option>
        <option  value="12">Décembre</option>
     </select>
	<input type="submit" name="brech2" value="Chercher">

	</form>
	<br>
	<?php 
	$exe=mysqli_query($conn,"select sum(t_mensuel) as mass from salaires");
	if($qq=mysqli_fetch_assoc($exe)){
	$mass=$qq['mass'];
	echo"<b>Masse salariale : $mass FCFA</b><br><br>";
	}
	?>

	<?php 
	 //recherche paies

	 if(isset($_POST['brech2'])){
	   $rq=mysqli_query($conn,"select matricule,nom,prenom,t_mensuel,sum(m_percu) as sm_percu,
	    t_mensuel-sum(m_percu) as m_restant,annee,mois from salaires inner join payement
	    on salaires.matricule=payement.idsal where annee='$an' and mois='$mois'  group by matricule,annee,mois");
	print'<table border="1" class="tab"><tr><th>Matricule</th><th>Nom</th><th>Prenom</th>
	<th>Salaire mensuel (FCFA)</th><th>Montant perçu</th><th>Reste</th><th>Année</th><th>Mois</th></tr>';
	     while($rst=mysqli_fetch_assoc($rq)){
	     
	       
	         print"<tr>";
	         echo"<td>".$rst['matricule']."</td>";
	         echo"<td>".$rst['nom']."</td>";
	         echo"<td>".$rst['prenom']."</td>";
	         echo"<td>".$rst['t_mensuel']."</td>";
	         echo"<td>".$rst['sm_percu']."</td>";
	         echo"<td>".$rst['m_restant']."</td>";
	         echo"<td>".$rst['annee']."</td>";
	         echo"<td>".$rst['mois']."</td>";
	         echo'<td><a href="detail.php?MATRICULE='.$rst['matricule'].'&amp ANNEE='.$rst['annee'].'&amp MOIS='.$rst['mois'].'">Détail</a></td>';
	         print"</tr>";   
	     }
	   print'</table>';
	 $lrq=mysqli_query($conn,"select sum(m_percu) as percu from payement where annee='$an' and mois='$mois'");
	   if($rr=mysqli_fetch_assoc($lrq)){
	   $percu=$rr['percu'];
	   }
	   $np=$mass-$percu;
	echo"<br><b>Montant des salaires perçus : $percu FCFA</b>";
	echo"<br><b>Montant des salaires non payés : $np FCFA</b>";
	 }
	
	?>
	
	<?php 
	 //recherche paies 2

	 if(isset($_POST['brech1'])){
	   $rq=mysqli_query($conn,"select matricule,nom,prenom,t_mensuel,sum(m_percu) as sm_percu,
	    t_mensuel-sum(m_percu) as m_restant,annee,mois from salaires inner join payement
	    on salaires.matricule=payement.idsal where annee='$an' and mois='$mois' and matricule='$mat'  group by matricule,annee,mois");
	print'<table border="1" class="tab"><tr><th>Matricule</th><th>Nom</th><th>Prenom</th>
	<th>Taux mensuel (FCFA)</th><th>Montant perçu</th><th>Reste</th><th>Année</th><th>Mois</th></tr>';
	     while($rst=mysqli_fetch_assoc($rq)){
	     
	       
	         print"<tr>";
	         echo"<td>".$rst['matricule']."</td>";
	         echo"<td>".$rst['nom']."</td>";
	         echo"<td>".$rst['prenom']."</td>";
	         echo"<td>".$rst['t_mensuel']."</td>";
	          echo"<td>".$rst['sm_percu']."</td>";
	          echo"<td>".$rst['m_restant']."</td>";
	           echo"<td>".$rst['annee']."</td>";
	           echo"<td>".$rst['mois']."</td>";
	echo'<td><a href="detail.php?MATRICULE='.$rst['matricule'].'&amp ANNEE='.$rst['annee'].'&amp MOIS='.$rst['mois'].'">Détail</a></td>';
	         print"</tr>";   
	     }
	   print'</table>';
	 
	 }
	 
	 /*application réalisée du 03 au 07 Mai 2020 à N'djaména au Tchad par
Targoto Christian
Contact: 23560316682 / ct@chrislink.net */
	
	?>
	
	</div>

</body>
</html>