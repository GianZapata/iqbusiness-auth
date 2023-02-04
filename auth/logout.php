<?php   
include ('../controllers/AuthController.php'); 

$authController = new AuthController();
$authController->logout();

header('Location: /auth/login.php');

