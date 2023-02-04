<main class="max-w-3xl m-auto mt-10 md:mt-28 flex flex-col items-center">
   <h1 class="text-5xl font-black text-center uppercase">
      IQ
      <span class="block text-indigo-600">Business</span>
   </h1>
      
   <?php if( isset($_SESSION['user']) ): ?>
      <h2
         class="text-4xl font-black text-center uppercase mt-5"
      >¡Bienvenido! 
         <span class="block text-indigo-600">
            <?=  $_SESSION['user']['email'] ?? ""; ?>
         </span>
      </h2>
   
      <form action="/auth/logout.php">
         <button
            class="bg-indigo-600 hover:bg-indigo-800 text-white w-full mt-5 p-3 uppercase font-bold cursor-pointer rounded-md transition duration-300"
            type="submit"
         >
            Cerrar Sesión
         </button>
      </form>
   <?php else : ?>
      <a
         href="/login"
         class="bg-indigo-600 hover:bg-indigo-800 text-white w-full mt-5 p-3 uppercase font-bold cursor-pointer rounded-md transition duration-300"
      >
         Iniciar Sesión
      </a>
   <?php endif; ?>

</main>