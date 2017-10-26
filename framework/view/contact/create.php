<?php 
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>vreér un contact</title>
 </head>
 <body>
 	<form action="/contact/store" method="post">
 		<input type="text" name="nom" placeholder="nom"><br>
 		<input type="text" name="prenom" placeholder="prenom"><br>
 		<input type="text" name="phone" placeholder="téléphone"><br>
 		<input type="submit" value="envoyer"><br>
 		
 	</form>
 </body>
 </html>