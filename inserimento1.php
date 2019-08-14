 <?php
 
 /* connect to database*/
$conn = mysql_connect("", "") or $conn = mysql_connect("", "", "");
				  mysql_select_db("") or die (mysql_error());
				  
				  
				  
			/* Catch data from PHP_POST call*/	  
	$latitudine =$_POST['latitudine'];
			 
			  $longitudine =$_POST['longitudine'];
			  $via =$_POST['via'];
			  $nome =$_POST['nome'];	
  $cognome =$_POST['cognome'];	
$info =$_POST['info'];	  
				 
				 /*insert data in table 'persona'*/
				$query = mysql_query("INSERT into persona( nome,cognome,info,via,latitudine,longitudine )VALUES('$nome','$cognome','$info','$via','$latitudine','$longitudine') ");  
				  
			echo"	  <script>
window.location = 'mappaprova.php';</script>";
				 ?>