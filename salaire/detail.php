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

<!-- Created by TopStyle Trial - www.topstyle4.com -->
<!DOCTYPE html>
<html>
<head>
	<title>chcode_appli</title>
	<meta charset="utf8">
		<link rel="stylesheet" type="text/css" href="lestyle.css">
</head>

<body>
	<div align="center">
	<h2 >Détail du paiement</h2>
	<?php 
@$mat=$_GET['MATRICULE'];
@$an=$_GET['ANNEE'];
@$mois=$_GET['MOIS'];
echo"<b>Matricule : $mat - Année : $an - Mois : $mois</b><br><br>";
$rq=mysqli_query($conn,"select matricule,nom,prenom,t_mensuel,m_percu,jour 
from salaires inner join payement on salaires.matricule=payement.idsal where matricule='$mat'
and annee='$an' and mois='$mois'");
print'<table border="1" class="tab"><tr><th>Matricule</th><th>Nom</th><th>Prenom</th><th>Taux mensuel (FCFA)</th>
<th>Montant perçu</th><th>Jour</th></tr>';
 while($rst=mysqli_fetch_assoc($rq)){
 print"<tr>";
	         echo"<td>".$rst['matricule']."</td>";
	         echo"<td>".$rst['nom']."</td>";
	         echo"<td>".$rst['prenom']."</td>";
	         echo"<td>".$rst['t_mensuel']."</td>";
	         echo"<td>".$rst['m_percu']."</td>";
	         echo"<td>".$rst['jour']."</td>";
	         print"</tr>";   
	     }
	   print'</table>';
  $qr=mysqli_query($conn,"select sum(m_percu) as tmp from payement where idsal='$mat'and annee='$an' and mois='$mois' ");
   if($rss=mysqli_fetch_assoc($qr)){
     $tmp=$rss['tmp'];
     }
     $qr2=mysqli_query($conn,"select t_mensuel as sm from salaires inner join payement on salaires.matricule=payement.idsal
      where matricule='$mat'and annee='$an' and mois='$mois' ");
   if($rss2=mysqli_fetch_assoc($qr2)){
     $sm=$rss2['sm'];
     }
     $sr=$sm-$tmp;
     echo"<br><b>Salaire brute : $sm FCFA</b>";
     echo"<br><b>Total montant perçu : $tmp FCFA</b>";
     echo"<br><b>Montant restant : $sr FCFA</b>";
     
     
     /*application réalisée du 03 au 07 Mai 2020 à N'djaména au Tchad par
Targoto Christian
Contact: 23560316682 / ct@chrislink.net */
   
?>
	</div>
</body>
</html>