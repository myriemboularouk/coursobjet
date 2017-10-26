<?php
// framework/controller/contact.php
class ContactController extends Controller
{
	public function create()
	{
		// Je rends la vue qui se trouve dans view/contact/create.php
		$this->render('contact.create');
	}
}