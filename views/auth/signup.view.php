<main class="max-w-3xl m-auto mt-10 md:mt-28 flex flex-col items-center">
   <h1 class="text-5xl font-black text-center uppercase">
      IQ
      <span class="block text-indigo-600">Business</span>
   </h1>
   <div class="p-10 w-full">
      <h1 class="text-4xl font-black text-center uppercase">Crear cuenta</h1>
      <div class="bg-white shadow-md rounded-md mt-5 px-5 py-10">
         <form class="space-y-5" id="form-signup">

            <div id="errors" class="space-y-2"></div>

            <div>
               <label 
                  class="text-slate-800" for="email"
               >
                  Correo:
               </label>
               <input
                  id="email"
                  type="text"
                  name="email"
                  class="mt-2 block p-3 bg-gray-50 w-full outline-none"
                  placeholder="Tu Correo"
               />
            </div>
            <div>
               <label class="text-slate-800" for="password">
                  Contraseña:
               </label>
               <input
                  id="password"
                  type="password"
                  name="password"
                  class="mt-2 block p-3 bg-gray-50 w-full outline-none"
                  placeholder="Tu Contraseña"
               />
            </div>
            <div>
               <label class="text-slate-800" for="password-confirm">
                  Confirmar Contraseña:
               </label>
               <input
                  id="password-confirm"
                  type="password"
                  name="password-confirm"
                  class="mt-2 block p-3 bg-gray-50 w-full outline-none"
                  placeholder="Confirmar Contraseña"
               />
            </div>
            <button
               type="submit"
               class="bg-indigo-600 hover:bg-indigo-800 text-white w-full mt-5 p-3 uppercase font-bold cursor-pointer rounded-md transition duration-300"
            >Crear cuenta</button>
         </form>
         <div class="mt-5">
            <p class="text-sm text-gray-500">
               ¿Ya tiene cuenta?
               <a
                  href="/auth/login.php"
                  class="text-indigo-600 hover:underline cursor-pointer"
               > Inicia sesión </a>
            </p>
         </div>
      </div>
   </div>      
</main>