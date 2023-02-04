const formLogin = document.querySelector('#form-login');
const formSignup = document.querySelector('#form-signup');
const errors = document.querySelector('#errors');

const isEmail = (email) => {
   const regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   return regex.test(String(email).toLowerCase());
};

const cleanHTML = ( container ) => {
   while(container.firstChild) {
      container.removeChild(container.firstChild);
   }
};

const setAlert = ( isError = false, message = 'Hubo un error, intente nuevamente', callback = null ) => {
   cleanHTML(errors);

   const div = document.createElement('div');
   div.classList.add('border', 'px-4', 'py-3', 'rounded', 'max-w-lg', 'mx-auto', 'mt-6', 'text-center');

   if(isError) {
      div.classList.add('bg-red-100', 'border-red-400', 'text-red-700');
   } else {
      div.classList.add('bg-green-100', 'border-green-400', 'text-green-700');
   }

   div.textContent = message;

   errors.appendChild(div);

   setTimeout(() => {
      div.remove();
      if(callback) callback();
   }
   , 3000);
   
}

const onSubmitLogin = async (e) => {
   e.preventDefault();

   cleanHTML(errors);
   if(!formLogin) return;

   const email = document.querySelector('#email').value;
   const password = document.querySelector('#password').value;

   if(!email || !password) {
      return setAlert(true, 'Todos los campos son obligatorios');
   }

   const formData = new FormData();
   formData.append('email', email);
   formData.append('password', password);

   const btnLogin = formLogin.querySelector('button[type="submit"]');
   btnLogin.disabled = true;
   btnLogin.classList.add('cursor-not-allowed', 'opacity-50');

   try {
      const { data } = await axios.post('/auth/login.php', formData)
      const { success, message } = data;

      if(!success) {
         btnLogin.disabled = false;
         btnLogin.classList.remove('cursor-not-allowed', 'opacity-50');
         return setAlert(true, message)
      }

      return setAlert(false, 'Iniciando sesión...', () => {
         window.location.href = '/index.php';
      })
   } catch (error) {
      btnLogin.disabled = false;
      btnLogin.classList.remove('cursor-not-allowed', 'opacity-50');
      return setAlert(true, 'Hubo un error, intente nuevamente') 
   }

};

const onSubmitSignup = async (e) => {
   e.preventDefault();
   
   cleanHTML(errors);
   if(!formSignup) return;

   const email = document.querySelector('#email').value;
   const password = document.querySelector('#password').value;
   const passwordConfirm = document.querySelector('#password-confirm').value;

   if(!email || !password || !passwordConfirm) {
      return setAlert(true, 'Todos los campos son obligatorios');
   }

   if(!isEmail(email)) {
      return setAlert(true, 'El email no es válido');
   }

   if(password !== passwordConfirm) {
      return setAlert(true, 'Las contraseñas no coinciden');
   }

   if(password.length < 6) {
      return setAlert(true, 'La contraseña debe tener al menos 6 caracteres');
   }

   const formData = new FormData();
   formData.append('email', email);
   formData.append('password', password);
   formData.append('passwordConfirm', passwordConfirm);

   const btnSignup = formSignup.querySelector('button[type="submit"]');
   btnSignup.disabled = true;
   btnSignup.classList.add('cursor-not-allowed', 'opacity-50');

   try {
      const { data } = await axios.post('/auth/signup.php', formData)
      const { success, message } = data;

      if(!success) {
         btnSignup.disabled = false;
         btnSignup.classList.remove('cursor-not-allowed', 'opacity-50');
         return setAlert(true, message)
      }

      return setAlert(false, 'Registrando usuario...', () => {
         window.location.href = '/index.php';
      })
   } catch (error) {
      btnSignup.disabled = false;
      btnSignup.classList.remove('cursor-not-allowed', 'opacity-50');
      return setAlert(true, 'Hubo un error, intente nuevamente')
   }
};

const initAddEventListeners = () => {
   formLogin?.addEventListener('submit', onSubmitLogin);
   formSignup?.addEventListener('submit', onSubmitSignup);
}; 

document.addEventListener('DOMContentLoaded', initAddEventListeners);
