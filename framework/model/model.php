<?php

class Model
{
   public $pdo;
   public $table;
   public $attributes = [];
   public $database = 'contact';
   public $user = 'root';
   public $password = '';
   public $is_new = true;


   public function __construct($table)
   {
       $this->pdo = new PDO('mysql:host=localhost;dbname='.$this->database, $this->user, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
       $this->table = $table;
   }

   public function __set($key, $value)
   {
       $this->attributes[$key] = $value;
   }
   public function __get($key)
   {
       return $this->attributes[$key];
   }
   public function save()
   {
     if ($this->_new) {
     
    
       $query = 'INSERT INTO '
       . $this->table
       . ' ('
       . implode(', ', array_keys($this->attributes))
       . ') VALUES (:'
       . implode(', :', array_keys($this->attributes))
       . ')';
       $this->execute($query, $this->attributes);
       $this->id = $this->pdo->lastInsertId();
   }else {
    //requet d'update...
   }

    }
   public function execute($query, $params = [], $query_type = '')
   {
       $statement = $this->pdo->prepare($query);
       foreach($params as $key => &$param){
           if(is_null($param)){
               $type = PDO::PARAM_NULL;
           } elseif(is_bool($param)){
               $type = PDO::PARAM_BOOL;
           }  elseif(is_int($param)){
               $type = PDO::PARAM_INT;
           } else{
               $type = PDO::PARAM_STR;
           }
           $statement->bindParam($key, $param, $type);
       }
       //J'exécute la requete.
       $q = $statement->execute();
       if ($query_type == 'all') {
          return $statement->fetchAll(PDO::FETCH_ASSOC);
       }
      
       return $q;
   }

   public function all()

   {
    $query = 'SELECT * FROM ' . $this->table;
    return $this->execute($query, [], 'all');
   }
}
$contact = new Model('contacts');
$contacts = $contact->all();
dd($contacts);

?>