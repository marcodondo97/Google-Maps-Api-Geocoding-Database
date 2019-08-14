
<!--

Author: Marco Dondo.

Language: EN.


 -->


 <!-- Database connection --> 
<?php 

$conn = mysql_connect("", "") or $conn = mysql_connect("", "", "");
				  mysql_select_db("") or die (mysql_error());

/* query to extract information from database */				
$query34 = "SELECT * FROM persona  ";

$risultati = mysql_query($query34);
$num = mysql_numrows($risultati);
 
$i=0;



while ($i < $num) {
$latitudine1 = mysql_result($risultati, $i, "latitudine");
$longitudine1 = mysql_result($risultati, $i, "longitudine");
$nome1 = mysql_result($risultati, $i, "nome");
$cognome1 = mysql_result($risultati, $i, "cognome");
$info1 = mysql_result($risultati, $i, "info");

$lat[$i]=$latitudine1;
$lon[$i]=$longitudine1;
$nom[$i]=$nome1;
$cog[$i]=$cognome1;
$inf[$i]=$info1;

$i++;}

  ?>


 <!--Page HTML  -->
 
 <!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Mappa Master RDM</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map { 
     width:100%;
	 height:600px;
	 
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
   <div id="map"></div>
  <script>
  function initMap() {
	  
/* initial map view setting
 */
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 5,
    center: {
      lat: 42.298541698265296, lng: 11.96125427987667
    } <!-- Center of Italy  -->
  });
  var infoWin = new google.maps.InfoWindow();
  // Add some markers to the map.
  // Note: The code uses the JavaScript Array.prototype.map() method to
  // create an array of markers based on a given  array.
  // The map() method here has nothing to do with the Google Maps API.
  var markers = locations.map(function(location, i) {
    var marker = new google.maps.Marker({
      position: location
    });
    google.maps.event.addListener(marker, 'click', function(evt) {
      infoWin.setContent(location.info);
      infoWin.open(map, marker);
    })
    return marker;
  });

  // Add a marker clusterer to manage the markers.
  var markerCluster = new MarkerClusterer(map, markers, {
    imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
  });

}



var locations = [
/*
 Loop cycle to read all items in database*/
<?php 

for ($x = 0; $x <= $num-1; $x++) 
{
    echo"

{

 lat:" .$lat[$x]." , lng: ".$lon[$x].",
  info: ' <h3>".$nom[$x]." ".$cog[$x]."</h3><br> ".$inf[$x]."',
},"; 


}
?>

];

 
google.maps.event.addDomListener(window, "load", initMap);
  
  
  
    </script>
	<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"
    async defer></script>  <!-- insert your Google API key 
 -->
    </script>
	
  





				 
				 
			<center>	 
			<h2 style="color:red;"> Inserisci il tuo segnaposto </h2>	 
 <form action="" method="post">
    <input type='text' name='address' placeholder='inserisci il tuo indirizzo' />
	  
    <input type='submit' value='prosegui' />
</form>
</center>
<br>
<br>
<?php 

//$cognome =$_POST['cognome'];
//$info =$_POST['info'];
// function to geocode address, it will return false if unable to geocode address
function geocode($address){
 
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=YOUR_API_KEY";  /* insert your Google API key 
*/
 
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
 
        // get the important data
        $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
        $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
        $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
         
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $data_arr = array();            
             
            array_push(
                $data_arr, 
                    $lati, 
                    $longi, 
                    $formatted_address
                );
             
            return $data_arr;
             
        }else{
            return false;
        }
         
    }
 
    else{
        echo "<strong>ERROR: {$resp['status']}</strong>";
        echo" <center> <h3> Si sono presentati errori. Compila il modulo scrivendo latitudine e longitudine della tua via. <br>
       <a href='https://www.coordinate-gps.it/' target='_blank'> Ricavare le coordinate</a> </h3>
        <form action='/mappa/inserimento1.php' method='post'>
     <input type='text' name='latitudine' placeholder='inserisci la latitudine'>
	  <input type='text' name='longitudine' placeholder='inserisci longitudine'> 
	  <input type='text' name='via' value=''placeholder='inserisci inserisci via' ><br>
	  <input type='text' name='nome' placeholder='inserisci il tuo nome' />
	    <input type='text' name='cognome' placeholder='inserisci il tuo cognome' />
		  <input type='text' name='info' placeholder='inserissci le info' />
    <input type='submit' value='inserisci' />
</form> </center> <br>";
        return false;
    }
}



if($_POST){
 
    // get latitude, longitude and formatted address
    $data_arr = geocode($_POST['address']);
 
    // if able to geocode the address
    if($data_arr){
         
        $latitude = $data_arr[0];
        $longitude = $data_arr[1];
	$formatted_address = $data_arr[2];
	
	 echo" <center> <form action='/inserimento1.php' method='post'>
     <input type='text' name='latitudine' value=".$latitude .">
	  <input type='text' name='longitudine' value=".$longitude ."> 
	  <input type='text' name='via' value=".$formatted_address ."><br>
	  <input type='text' name='nome' placeholder='inserisci il tuo nome' />
	    <input type='text' name='cognome' placeholder='inserisci il tuo cognome' />
		  <input type='text' name='info' placeholder='inserissci le info' />
    <input type='submit' value='inserisci' />
</form> </center> <br>";
	 
}}




?> 
</body>
</html>

<!-- FOLLOW OTHER FILES IN FOLDER : /inserimento1.php AND /persona.sql  -->

