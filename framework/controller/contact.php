
<?php
// framework/controlller/contact.php
class ContactController extends Controller
{
	public function create()
	{
		//echo 'Coucou';
		// Je rends la vue qui se trouve dans view/contact/creat.php
		$this->render('contact.create');

	}

	public function store()
	{
		$contact = new Model('contacts');
		$contact->prenom = $_POST['prenom'];
		$contact->nom = $_POST['nom'];
		$contact->phone = $_POST['phone'];
		$contact->save();
		header('Location: /contact/index');

	}

	public function index()
	{
		$contact = new Model('contacts');
		$GLOBALS['contacts'] = $contact->all();
		$this->render('contact.index');
	}
}




 
?>