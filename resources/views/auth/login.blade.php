 {{--<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form> 
        </x-jet-authentication-card>
</x-guest-layout>
        --}}
            <!-- sign in page -->
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Acceso Proveedor redvital®</title>
                <link rel="stylesheet" href="css/redvital.css">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                
            </head>
            <body>
              <div class="container5" id="container">
                <!-- sign in page -->
                <div class="form-container sign-in-container">
                    <form method="POST" action="{{ route('login') }}" class="form2">
                  {{-- <form method="POST" action="" class="form2" id="login"> --}}
                    @csrf
                    <h1 class="form__title">Login</h1>
                    <div class="form__input-group">
                      <label for="username">Correo: </label>
                      <input type="text" class="form__input" name="email" id="email" maxlength="90" aria-describedby="emailHelp" required> 
                     
                    </div>
                    <div class="form__input-group">
                      <label for="pass">Contraseña: </label>
                      <input type="password" class="form__input" name="password" id="password" maxlength="90" required> 
                    </div><br>
                    @error('message')
            
                    "Clave o usuario no validos"
                        
                    @enderror
                    <div class="form__input-group">
                      <button type="submit" class="form__button">Enviar</button>
                    </div>
                    
        
                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
        
                        {{-- <x-jet-button class="ml-4">
                            {{ __('Log in') }}
                        </x-jet-button> --}}
                    </div>
                    
                 </form>
                 
                    </div>
                </div>
                
               <!--  create account page -->  
               <div class="overlay-container">
                    <div class="overlay">
                        <div class="overlay-panel overlay-left">
                            <h1>Welcome Back!</h1>
                            <p>Please login with your personal info</p>
                            <button class="ghost" id="signIn">Sign In</button>
                        </div>
                        <div class="overlay-panel overlay-right">
                            <h1>Bienvenido</h1>
                            <p>Amigo Proveedor</p>
                            <div class="logo_login"><img src="img/logo-redvital-blanco.png" alt=""></div>
                        </div>
                    </div>
                </div>
             </div>
              
              <script src="js/login.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                <script>
                    const queryString = window.location.search;
                    if (queryString != "") {
                        //?c=401
                        const eCode = parseInt(queryString.replace("?c=", ""));
                        if (eCode == 401) {
                            document.getElementById("idMensaje").style.display = "block";
                        }
                    }
                </script>
            </body>
