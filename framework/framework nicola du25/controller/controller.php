<?php
// controller/controller.php

class Controller
{
	public function handleRequest()
	{
		// J'importe le model pour le rendre disponible dans le code.
		require('model/model.php');

		// Je récupère l'url tapé après framework.dev (par exemple '/contact/create').
		// J'explose la chaine de caractère en array en coupant à chaque '/'
		$exploded = explode('/', $_SERVER['REQUEST_URI']);
		// Je met l'argument (contact) dans $controller
		$controller = $exploded[1];
		// Je mets l'argument 'create' dans $method
		$method = $exploded[2];

		// Je fais un require du fichier qui contient le controller voulu dans controller/contact.php.
		require('controller/' . $controller . '.php');
		// Je passe la première lettre de contact en majuscule et lui concatène 'Controller'
		$controller = ucfirst($controller) . 'Controller';
		// Avec ContactController (dans $controller), j'instancie un nouveau controller dynamiquement.
		$controller = new $controller;

		// J'appelle la méthode $method (create) du controller fraichement créé
		$controller->$method();
	}

	public function render($view)
	{
		// Je crée le chemin de la vue. Je remplace les points par des slaches dans $view.
		$chemin_view = 'view/' . str_replace('.', '/', $view) . '.php';
		require($chemin_view);
	}
}