<?php   
include ('../controllers/AuthController.php'); 

$authController = new AuthController();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   try {
      $response = $authController->signup($_POST);
      exit(json_encode($response));
   } catch (Exception $e) {
      exit(json_encode([
         'success' => false,
         'message' => 'Error al crear la cuenta'
      ]));
   }
} 

if($_SERVER['REQUEST_METHOD'] === 'GET'){
   $authController->signupView();
}