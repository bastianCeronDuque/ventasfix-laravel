<!doctype html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/') }}"
  data-template="vertical-menu-template-no-customizer"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Registro Ventasfix</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <div class="authentication-wrapper authentication-cover authentication-bg">
      <div class="authentication-inner row">
        <div class="d-none d-lg-flex col-lg-7 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
            <img
              src="{{ asset('assets/img/illustrations/auth-register-illustration-light.png') }}"
              alt="auth-register-cover"
              class="img-fluid my-5 auth-illustration"
              data-app-light-img="img/illustrations/auth-register-illustration-light.png"
              data-app-dark-img="img/illustrations/auth-register-illustration-dark.png" />

            <img
              src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}"
              alt="auth-register-cover"
              class="platform-bg"
              data-app-light-img="img/illustrations/bg-shape-image-light.png"
              data-app-dark-img="im/illustrations/bg-shape-image-dark.png" />
          </div>
        </div>
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
          <div class="w-px-400 mx-auto">
            <div class="app-brand mb-4">
              <a href="{{ url('/') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.95857 11.0628C3.12087 12.2329 4.80456 12.991 6.48825 13.8446C7.99285 14.6837 10.091 16.2087 12.3573 15.6268C14.0705 15.1134 15.7088 14.0416 17.0699 12.9278C18.3499 11.8968 19.5106 11.0084 20.6107 10.1384L21.4642 9.43936L22.6468 8.32486L23.405 7.04975L23.405 6.85398V0H0.00172773Z"
                      fill="#7367F0" />
                    <path
                      opacity="0.06"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.69824 16.4364L12.4835 20.8844L15.4218 21.9629L19.9234 16.4364H7.69824Z"
                      fill="#161616" />
                    <path
                      opacity="0.06"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M18.4804 16.4364L22.8631 20.8844L25.8014 21.9629L30.303 16.4364H18.4804Z"
                      fill="#161616" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M4.00632 17.0699L12.3573 21.1189C12.3573 21.1189 15.8646 22.6483 17.9987 20.6107C19.1278 19.497 19.8705 18.0617 20.6107 16.9531L25.8014 11.0628L23.405 7.04975L20.6107 10.1384L15.4218 14.0416C15.4218 14.0416 10.8866 17.8447 7.00078 17.2759C4.3855 16.8335 4.39851 16.1336 4.00632 17.0699Z"
                      fill="#7367F0" />
                  </svg>
                </span>
                <span class="app-brand-text demo text-body fw-bold">Ventasfix</span>
              </a>
            </div>
            <h4 class="mb-1 pt-2">La aventura comienza aquí 🚀</h4>
            <p class="mb-4">¡Haz que la gestión de tu aplicación sea fácil y divertida!</p>

            <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="rut" class="form-label">RUT</label>
                    <input type="text" class="form-control" id="rut" name="rut" placeholder="Ingresa tu RUT" autofocus value="{{ old('rut') }}" />
                    @error('rut')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" value="{{ old('nombre') }}" />
                    @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa tu apellido" value="{{ old('apellido') }}" />
                    @error('apellido')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">Contraseña</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required />
                        <label class="form-check-label" for="terms-conditions">
                            Estoy de acuerdo con los
                            <a href="javascript:void(0);">términos y condiciones</a>
                        </label>
                    </div>
                </div>
                <button class="btn btn-primary d-grid w-100" type="submit">Registrarme</button>
            </form>

            <p class="text-center">
                <span>¿Ya tienes una cuenta?</span>
                <a href="{{ route('login') }}">
                    <span>Iniciar sesión</span>
                </a>
            </p>
          </div>
        </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="{{ asset('assets/js/pages/auth-register.js') }}"></script>
  </body>
</html>