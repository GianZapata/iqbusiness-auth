<?php 
   require 'Connection.php';

   class User extends Connection {

      public $id;
      public $email;
      public $password;

      public function __construct($args = [
         'id' => null,
         'email' => '',
         'password' => ''
      ]){
         $this->id = $args['id'] ?? null;
         $this->email = $args['email'] ?? '';
         $this->password = $args['password'] ?? '';
      }

      
      public function create(){
         $instance = self::getInstance();
         $db = $instance->getDB();
         $query = $db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
         $query->execute([
            'email' => $this->email,
            'password' => $this->password
         ]);
         $this->id = $db->lastInsertId();
         return $this;
      }

      public function update(){
         $instance = self::getInstance();
         $db = $instance->getDB();
         $query = $db->prepare("UPDATE users SET email = :email, password = :password WHERE id = :id");
         $query->execute([
            'email' => $this->email,
            'password' => $this->password,
            'id' => $this->id
         ]);
         return $this;
      }

      public function save(){
         if($this->id){
            return $this->update();
         } else {
            return $this->create();
         }
      }

      public static function findAll(){
         $instance = self::getInstance();
         $db = $instance->getDB();
         $query = $db->prepare("SELECT * FROM users");
         $query->execute();
         $users = $query->fetchAll(PDO::FETCH_ASSOC);
         return $users;
      }


      public static function findById(int $id){
         $instance = self::getInstance();
         $db = $instance->getDB();
         $query = $db->prepare("SELECT * FROM users WHERE id = :id");
         $query->execute(['id' => $id]);
         $user = $query->fetch(PDO::FETCH_ASSOC);
         return $user;
      }

      public static function findByEmail( string $email){
         $instance = self::getInstance();
         $db = $instance->getDB();
         $query = $db->prepare("SELECT * FROM users WHERE email = :email");
         $query->execute(['email' => $email]);
         $user = $query->fetch(PDO::FETCH_ASSOC);
         return $user;
      }

   }

?>