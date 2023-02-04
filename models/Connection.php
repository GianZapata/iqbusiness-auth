<?php 

class Connection {

   private $host = 'localhost';
   private $dbName = 'iqbusinessdb';
   private $dbUser = 'root';
   private $dbPass = 'root';

   private static $instance = null;
   private $db;

   private function __construct() {
      $host = $this->host;
      $dbName = $this->dbName;
      $dbUser = $this->dbUser;
      $dbPass = $this->dbPass;
      $this->db = new PDO("mysql:host={$host};dbname={$dbName}",$dbUser, $dbPass);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }

   public static function getInstance() {
      if (self::$instance == null) {
         self::$instance = new Connection();
      }
      return self::$instance;
   }

   public function getDB() {
      return $this->db;
   }

}

?>