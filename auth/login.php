<?php   
include ('../controllers/AuthController.php'); 

$authController = new AuthController();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   try {
      $response = $authController->login($_POST);
      exit(json_encode($response));
   } catch (Exception $e) {
      exit(json_encode([
         'success' => false,
         'message' => 'Error al iniciar sesión'
      ]));
   }
} 

if($_SERVER['REQUEST_METHOD'] === 'GET'){
   $authController->loginView();
}