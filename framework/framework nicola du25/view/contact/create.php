<?php

// framework/view/contact/create.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Créer un contact</title>
</head>
<body>
	<form action="/contact/store" method="post">
		<input type="text" name="nom" placeholder="nom"><br>
		<input type="text" name="prenom" placeholder="prenom"><br>
		<input type="text" name="phone" placeholder="Téléphone"><br>
		<input type="submit" value="Envoyer">
	</form>
</body>
</html>