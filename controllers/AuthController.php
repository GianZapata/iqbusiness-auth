<?php 

   require '../models/User.php';

   class AuthController {
      
      public static function isValidEmail($email){
         return filter_var($email, FILTER_VALIDATE_EMAIL);
      }

      public function loginView(){
         session_start();
         if(isset($_SESSION['user'])) {
            header('Location: /');
            exit;
         }
         include_once __DIR__ . '/../views/header.php';
         include_once __DIR__ . '/../views/auth/login.view.php';
         include_once __DIR__ . '/../views/footer.php';
         
      }

      public function login($args = [
         'email' => '',
         'password' => ''
      ]){

         $email = filter_var(trim($args['email']), FILTER_SANITIZE_EMAIL);
         $password = $args['password'];
         
         if(empty($email) || empty($password)){
            return [
               'success' => false,
               'message' => 'Todos los campos son requeridos'
            ];
         }

         if(!self::isValidEmail($email)){
            return [
               'success' => false,
               'message' => 'El email no es válido'
            ];
         }

         $user = User::findByEmail($email);

         if(!$user){
            return [
               'success' => false,
               'message' => 'Email / Contraseña incorrectos'
            ];
         }

         if(!password_verify($password, $user['password'])){
            return [
               'success' => false,
               'message' => 'Email / Contraseña incorrectos'
            ];
         }

         $newUserInfo = [
            'id' => $user['id'],
            'email' => $user['email'],
         ];

         session_start();
         $_SESSION['user'] = $newUserInfo;
         return [
            'success' => true,
            'token' => session_id(),
            'user' => $newUserInfo
         ];
      }

      public function signupView(){
         session_start();
         if(isset($_SESSION['user'])) {
            header('Location: /');
            exit;
         }
         include_once __DIR__ . '/../views/header.php';
         include_once __DIR__ . '/../views/auth/signup.view.php';
         include_once __DIR__ . '/../views/footer.php';
      }

      public function signup(
         $args = [
            'email' => '',
            'password' => '',
            'passwordConfirm' => ''
         ]
      ){

         $email = $args['email'];
         $password = $args['password'];
         $passwordConfirm = $args['passwordConfirm'];

         if(empty($email) || empty($password) || empty($passwordConfirm)){
            return [
               'success' => false,
               'message' => 'Todos los campos son requeridos'
            ];
         }

         if(!self::isValidEmail($email)){
            return [
               'success' => false,
               'message' => 'El email no es válido'
            ];
         }

         if($password !== $passwordConfirm){
            return [
               'success' => false,
               'message' => 'Las contraseñas no coinciden'
            ];
         }

         if(strlen($password) < 6){
            return [
               'success' => false,
               'message' => 'La contraseña debe tener al menos 6 caracteres'
            ];
         }

         $user = User::findByEmail($email);
         if($user){
            return [
               'success' => false,
               'message' => 'El email ya está en uso'
            ];
         }

         $newUser = new User();
         $newUser->email = $email;
         $newUser->password = password_hash($password, PASSWORD_DEFAULT);
         $newUser->save();

         $newUserInfo = [
            'id' => $newUser->id,
            'email' => $email,
         ];

         session_start();
         $_SESSION['user'] = $newUserInfo;
         return [
            'success' => true,
            'token' => session_id(),
            'user' => $newUserInfo
         ];

         return [
            'success' => true,
            'message' => 'Usuario creado exitosamente'
         ];

      }

      public function logout(){
         session_start();
         session_destroy();
      }

   }

?>

