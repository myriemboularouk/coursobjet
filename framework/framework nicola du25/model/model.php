<?php
// framework/model/model.php
class Model
{
	public $pdo;
	public $table;
	public $attributes = [];
	public $database = 'contact';
	public $user = 'root';
	public $password = '';

	public function __construct($table)
	{
		// Instanciation de PDO, stockage dans $this->pdo.
		$this->pdo = new PDO('mysql:host=localhost;dbname='.$this->database,
			$this->user,
			$this->password,
			[PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
		// On stocke la base passée 
		$this->table = $table;
	}

	public function execute($query, $params = [])
	{
		// Je prépare la requête en accédant à $this->pdo.
		$statement = $this->pdo->prepare($query);
		// Pour chaque paramètre passé...
		foreach($params as $key => &$param) {
			// Je récupère le type du paramètre en cours
			if(is_null($param)){
				$type = PDO::PARAM_NULL;
			} else if (is_bool($param)){
				$type = PDO::PARAM_BOOL;
 			} else if (is_int($param)){
 				$type = PDO::PARAM_INT;
 			} else {
 				$type = PDO::PARAM_STR;
 			}
 			// Je bind le paramètre
			$statement->bindParam($key, $param, $type);
		}
		// J'exécute la requête.
		$q = $statement->execute();
		return $q;
	}
}

$model = new Model('contacts');
$model->execute('INSERT INTO contacts (prenom, nom, phone) VALUES (:prenom, :nom, :phone)', [
		':prenom' => 'Nicolas',
		':nom' => 'Coulange',
		':phone' => '06 86 63 32 00'
	]);

$contact = new Model('contacts');
$contact->prenom = 'Nicolas';
$contact->nom = 'Coulange';
$contact->phone = '06 86 63 32 00';
$contact->save();

$contact->find(2);
$contact->prenom = 'Babar';
$contact->save();
$contacts = $contact->all();