# Google-Maps-Api-Geocoding-Database
Guidelines to create a map through the Google API with geocoding

<h2> Introduction </h2>
To build map  I used the following technologies:

- Frontend: HTML5 markup and scripting languages, Javascript;
- Import map from Google API Maps;
- Geocoding: Google Maps API;
- Backend: programming language for PHP5 webserver interface;
- Database: MySql and PHP5;
 

<h2>Description</h2>

Have the user insert their placeholder on the map by entering an alphanumeric address.

The map provides for the use of the Google Geocoding API that is used to make the http request to Google to transform the street into alphanumeric characters in numerical coordinates (latitude and longitude), a once the request is made, the code takes the coordinates from the google site and automatically inserts them in the form, after which the user will have to enter the data he wants to appear on the infowindow of his marker in the same form.

The insertion and population of the map placeholders is done by querying the database and retrieving the already registered users.

 

 If the street turns out to be poorly written, or for other reasons, the program cannot find the way and warns the user that if he wants he can always enter the its coordinates manually following the instructions I defined.

 
<h2>&#x1F53A; Warning &#x1F53A; </h2>
This program is partially free, ie google leaves a geocoding request (conversion of address from street to character format to latitude and longitude) free of charge every 24 hours and this means that only one user per day (the first one) can have the privilege to insert his placeholder comfortably automatically otherwise he must do the manual procedure.<br>
TO GET YOUR APIKEY YOU MUST FOLLOW THIS LINK https://developers.google.com/maps/documentation/javascript/get-api-key
<br> It is necessary to create a database. I USED XAMPP V 5.5.38.
<br>
<br>
<h2> Images </h2>
<img src="Screenshot/inserire_via.jpg" width="60%">
 Api get coordinates. We complete the form.  
<img src="Screenshot/compilazione_campi.jpg" width="60%">
 Informations stored in database MySql. The program let see the new mark in map.
<img src="Screenshot/infobox.jpg" width="60%">
