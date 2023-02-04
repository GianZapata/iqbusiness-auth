<?php 

   class HomeController {
      public function index() {
         session_start();

         if(empty($_SESSION) || !isset($_SESSION['user'])) {
            header('Location: /auth/login.php');
         }

         include_once __DIR__ . '/../views/header.php';
         include_once __DIR__ . '/../views/home/index.view.php';
         include_once __DIR__ . '/../views/footer.php';

      }
   }

?>