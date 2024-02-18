<?php 
/*include_once('conn.php');*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbhotel";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
} 

?>
<?php 
//ajouter
$dated=@$_POST['dated'];
$datef=@$_POST['datef'];
$numcli=@$_POST['numcli'];
$num=@$_POST['nump'];
$prix1=@$_POST['prix1'];
$prix=@$_POST['prix'];
$mess='';
$mess2='';
if(isset($_POST['boutadd'])&&!empty($num)){
$rq=mysqli_query($conn,"insert into chambre(numporte,prix,numclient,occupee) values('$num','$prix1','0','non')");
if($rq){
$mess='<b class="succes">Insertion réussie !</b>';
}
else
$mess="<b class='erreur'>Impossible d'insérer !</b>";
}
?>
<?php 

$rqq=mysqli_query($conn,"select numclient from chambre where numporte='$num'");
if($rsa=mysqli_fetch_assoc($rqq)){
  $numc=$rsa['numclient'];
}
?>
<?php 
//reserver
if(isset($_POST['boutrsv'])&&!empty($numcli)){
  if(!empty($num) && ($numc==0 || $numc==NULL)){//
  $rq=mysqli_query($conn,"update chambre set datedebut='$dated',datefin='$datef', numclient='$numcli' where numporte='$num' ");
      
       if($rq){
    $mess2='<b class="succes">Réservation réussie !</b>';
             }
        else
    $mess2="<b class='erreur'>Echec réservation !</b>";
  }
  
  else{
    if(!empty($prix)){
$rqz=mysqli_query($conn,"insert into attente(prix,datedebut,datefin,numclient) values('$prix','$dated','$datef','$numcli')"); 
      if($rqz) {
       $mess2="<b class='succes'>Mise en liste d'attente réussie !</b>";}
       else
       $mess2="<b class='erreur'> Mise en liste d'attente échouée !</b>";
       }
       }
      // else $mess2="<b>Mise en liste d'attente échoué !</b>";
     }
?>
<?php 
//supprimer
if(isset($_POST['boutsupp'])&&!empty($num)){
$rq=mysqli_query($conn,"delete from chambre where numporte='$num'");
if($rq){
$mess='<b class="succes">Suppréssion réussie !</b>';
}
else
$mess="<b class='erreur'>Impossible de supprimer !</b>";
}
?>
<?php 
//occupée oui
if(isset($_POST['btoui'])&&!empty($num)){
$rq=mysqli_query($conn,"update chambre set occupee='oui' where numporte='$num'");
if($rq){
$mess2='<b class="succes">OK!</b>';
}
else
$mess2="<b class='erreur'>Erreur de validation !</b>";
}

?>
<?php 
//occupée non
if(isset($_POST['btnon'])&&!empty($num)){
$rq=mysqli_query($conn,"update chambre set occupee='non' where numporte='$num'");
if($rq){
$mess2='<b class="succes">OK!</b>';
}
else
$mess2="<b class='erreur'>Erreur de validation !</b>";
}

?>
<?php 
//annulation
if(isset($_POST['boutannul'])&&!empty($num)){
$rq=mysqli_query($conn,"update chambre set datedebut='NULL',datefin='NULL',numclient='NULL',occupee='non' where numporte='$num'");
if($rq){
$mess2='<b class="succes">Annulation réussie !</b>';
}
else
$mess2="<b class='erreur'>Impossible d'annuler !</b>";
}
?>

<?php 
  //fin d'une reservation
   mysqli_query($conn,"update chambre set datedebut='NULL',datefin='NULL',numclient='NULL',occupee='non'
   where (datediff(datefin,now())<0) or (occupee='non' and datediff(datedebut,now())<=-1) ");
  
  ?>
<!-- Created by TopStyle Trial - www.topstyle4.com -->
<!DOCTYPE html>
<html>
<head>
	<title>chcode_appli</title>
	<meta charset="utf8">
	<link rel="stylesheet" type="text/css" href="cssfile.css">
</head>

<body>
<div align="center">
<hr>
<h2>Enregistrement des chambres</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" >
  <table align="">
  
     <tr ><td></td><td> <?php print $mess;?></td></tr>
    <tr><td></td><td><strong >Numéro porte :</strong></td></tr>
   <tr><td></td><td><input type="text" name="nump" class="champ" size="25"  ></td></tr>
   <tr><td></td><td><strong>Prix journée (fcfa) :</strong></td></tr>
   <tr><td></td><td><input type="number" name="prix1" min="0" class="champ" size="25"></td></tr>
      <tr><td></td><td><input type="submit" name="boutadd" value="Enregistrer" class="bouton" ></td></tr>
       <tr><td></td><td><input type="submit" name="boutsupp" value="Supprimer" class="bouton" ></td></tr>
  
  </table>
  </form>
   <?php 
  print"<h2>Liste des chambres de l'Hotel :</h2>";
  
  $qq2=mysqli_query($conn,"select numporte,prix from chambre");
  print'<table border="1" class="tab"><tr><th>NUMERO PORTE</th><th>PRIX/JOUR (FCFA)</th></tr>';
	while($rst2=mysqli_fetch_assoc($qq2)){
	 print"<tr>";
	         echo"<td>".$rst2['numporte']."</td>";
	         echo"<td>".$rst2['prix']."</td>";
	         print"</tr>";
	}
	  print'</table>';
  
  ?>
   <?php 
  print"<h2>Liste des chambres disponibles de l'Hotel :</h2>";
  
  $qq2=mysqli_query($conn,"select numporte,prix from chambre where numclient=0 ");
  print'<table border="1" class="tab"><tr><th>NUMERO PORTE</th><th>PRIX/JOUR (FCFA)</th></tr>';
	while($rst2=mysqli_fetch_assoc($qq2)){
	 print"<tr>";
	         echo"<td>".$rst2['numporte']."</td>";
	         echo"<td>".$rst2['prix']."</td>";
	         print"</tr>";
	}
	  print'</table>';
  
  ?>
  <hr>
  <a href="liste_attente.php">Valider les réservations de la liste d'attente</a>
  <h2>Réservation des chambres</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" >
  <table align="">
  
     <tr ><td></td><td> <?php print $mess2;?></td></tr>
    <tr><td></td><td><strong >Numéro porte :</strong></td></tr>
   <tr><td></td><td><input type="text" name="nump" class="champ" size="20"  ></td>
   <td><strong >Occupée ?</strong></td>
   <td><input type="submit" name="btoui" value="Oui" class="bouton" ></td>
   <td><input type="submit" name="btnon" value="Non" class="bouton" ></td>
   </tr>
    <tr><td></td><td><strong >Prix :</strong></td></tr>
   <tr><td></td><td><input type="number" name="prix" class="champ" size="20" min="0" ></td></tr>
   <tr><td></td><td><strong>Date début :</strong></td></tr>
   <tr><td></td><td><input type="date" name="dated"  class="champ" size="25"></td></tr>
   <tr><td></td><td><strong>Date fin :</strong></td></tr>
   <tr><td></td><td><input type="date" name="datef"  class="champ" size="25"></td></tr>
   <tr><td></td><td><strong>Contact client :</strong></td></tr>
   <tr><td></td><td><input type="number" name="numcli" min="0"  class="champ" size="25"></td></tr>
   <tr><td></td></tr>
   
   <tr><td></td><td><input type="submit" name="boutrsv" value="réserver" class="bouton" ></td></tr>
  <tr><td></td><td><input type="submit" name="boutannul" value="annuler" class="bouton" ></td></tr>
  
  </table>
  </form>
  <?php 
  print'<h2>Liste des chambres réservées :</h2>';
  
  $qq=mysqli_query($conn,"select numporte,prix,datedebut,datefin,
  datediff(datefin,datedebut) as duree,datediff(datefin,now()) as delai,numclient,datediff(datefin,datedebut)*prix as montant, 
 occupee from chambre
   where datedebut<>'NULL' and datedebut<>'0000-00-00'");
  print'<table border="1" class="tab"><tr><th>PORTE</th><th>PRIX (fcfa)</th>
	<th>DATE DEBUT</th><th>DATE FIN</th><th>DUREE (nombre jours)</th><th>DELAI (nombre jours)</th><th>CONTACT CLIENT</th>
	<th>MONTANT (fcfa)</th>	<th>OCCUPEE</th></tr>';
	while($rst=mysqli_fetch_assoc($qq)){
	 print"<tr>";
	         echo"<td>".$rst['numporte']."</td>";
	         echo"<td>".$rst['prix']."</td>";
	         echo"<td>".$rst['datedebut']."</td>";
	         echo"<td>".$rst['datefin']."</td>";
	         echo"<td>".$rst['duree']."</td>";
	         echo"<td>".$rst['delai']."</td>";
	         echo"<td>".$rst['numclient']."</td>";
	         echo"<td>".$rst['montant']."</td>";
	         echo"<td>".$rst['occupee']."</td>";
	         print"</tr>";
	}
	  print'</table>';
  
  ?>
  <?php /* Application réalisée du 08 au 15 Mai 2020 à N'djaména au Tchad par
              TARGOTO CHRISTIAN
           Contact : ct@chrislink.net / 23560316682
        */
  ?>
  <hr>
  

</div>
</body>
</html>
