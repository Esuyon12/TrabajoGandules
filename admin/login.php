<?php
require_once("../include/initialize.php");

// login confirmation
if (isset($_SESSION['ADMIN_USERID'])) {
  redirect(web_root . "admin/index.php");
}

try {


  $max_attempts = 2; // Número máximo de intentos fallidos permitidos
  $max_time = 60; // Tiempo máximo permitido en segundos


  // Comprobar si ha pasado el tiempo límite
  if (isset($_SESSION['login_attempts_time']) && time() - $_SESSION['login_attempts_time'] > $max_time) {
    unset($_SESSION['login_attempts']); // Restablecer el número de intentos fallidos
    unset($_SESSION['login_attempts_time']); // Restablecer el tiempo de inicio de sesión
  }

  if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['login_attempts_time'] = time();
  }

  if ($_SESSION['login_attempts'] > $max_attempts) {
    $nope = true;

    // Mostrar un mensaje de error o realizar otra acción
  }


  if (!empty($_POST)) {

    if (isset($nope)) {
      throw new Exception("fail", 1);
    }

    $email = trim($_POST['user_email']);
    $upass = $_POST['user_pass'];
    // $h_upass = password_hash($upass, PASSWORD_DEFAULT);

    if ($email == '' || $upass == '') {
      throw new Exception("Los campos estan vacios", 1);
    }

    if (empty($upass)) {
      throw new Exception("La contraseña esta vacia", 1);
    }

    $user = new User();
    sleep(3);
    $res = $user->userAuthentication($email, $upass);

    if ($res == false) {
      throw new Exception("Ocurrio un error", 1);
    }

    $_SESSION['ADMIN_USERID'] = $_SESSION['USERID'];
    $_SESSION['ADMIN_FULLNAME'] = $_SESSION['FULLNAME'];
    $_SESSION['ADMIN_USERNAME'] = $_SESSION['USERNAME'];
    $_SESSION['ADMIN_ROLE'] = $_SESSION['ROLE'];
    $_SESSION['ADMIN_CORREO'] = $_SESSION['CORREO'];
    $_SESSION['ADMIN_DNI'] = $_SESSION['DNI'];
    $_SESSION['ADMIN_FOTO'] = $_SESSION['FOTO'];
    $_SESSION['ADMIN_TELF'] = $_SESSION['TELEFONO'];
    $_SESSION['ADMIN_DATE'] = $_SESSION['CREATEAT'];

    unset($_SESSION['USERID']);
    unset($_SESSION['FULLNAME']);
    unset($_SESSION['USERNAME']);
    unset($_SESSION['PASS']);
    unset($_SESSION['ROLE']);
    unset($_SESSION['CORREO']);
    unset($_SESSION['DNI']);
    unset($_SESSION['TELEFONO']);
    unset($_SESSION['CREATEAT']);

    $response = array("status" => "success", "message" => "Se inicion correctamente");
    echo json_encode($response);
    die();
  }
} catch (Exception $e) {


  $_SESSION['login_attempts']++;



  $response = array("status" => "error", "message" => $e->getMessage());
  echo json_encode($response);
  die();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Iniciar sesión | Gandules </title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/login/vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="assets/login/vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="assets/login/vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="assets/login/css/util.css">
  <link rel="stylesheet" type="text/css" href="assets/login/css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css">

  <link rel="icon" type="image/png" href="assets/images/logo/logo-gandules.png" />

</head>

<body>

  <style>
    .card-error {
      width: 100%;
      height: 200px;
      position: absolute;
      top: 75px;
      z-index: 2;
      transition: all .5s ease;
      cursor: pointer;
    }

    .modal-content {
      border: none !important;
    }

    .modal-body .d-flex i {
      font-size: 120px;
      color: #f44336;
    }
  </style>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
          <img src="assets/images/logo/logo-gandules.png" alt="IMG">
        </div>
        <form id="login">
          <?php if (!empty($nope)) { ?>
            <p id="countdown"></p>
          <?php } ?>
          <?php if (empty($nope)) { ?>
            <div class="modal fade" aria-labelledby="resetModalLabel" aria-hidden="true" id="error">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                      <i class="fa fa-times-circle mb-3" aria-hidden="true"></i>
                      <h6 class="card-title"></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <span class="login100-form-title">Inicio de sesión</span>
            <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
              <input class="input100" type="text" name="user_email" placeholder="Usuario" autocomplete="off">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Password is required">
              <input class="input100" type="password" name="user_pass" placeholder="Contraseña">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
              </span>
            </div>

            <div class="container-login100-form-btn">
              <button class="login100-form-btn" type="submit" name="btnLogin">Iniciar sesión</button>
            </div>

            <div class="text-center p-t-12">
              <!-- <a class="txt2" href="#" data-toggle="modal" data-target="#resetModal">
                ¿Olvidó su nombre de usuario/contraseña?
              </a> -->
            </div>
            <div class="text-center p-t-50">
              <!-- <a class="txt2" href="#">
              Registrar tu cuenta
              <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a> -->
            </div>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="resetModal" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class=" modal-header">
          <span><b>Recuperar cuenta</b></span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frmReset" onsubmit="recuperarClave(event)" autocomplete="off">
            <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
              <input class="input100" type="text" name="" placeholder="Ingrese su correo electrónico" autocomplete="off">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </span>
            </div>
            <hr>
            <div class="container-login100-form-btn">
              <button class="login100-form-btn" type="submit" name="#">Enviar solicitud</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


  <script>
    function recuperarClave(event) {
      event.preventDefault(); // evitar que se envíe el formulario automáticamente

      const email = document.getElementById('email').value;

      $('#resetModal').modal('hide');
    }

    document.getElementById("login").addEventListener('submit', async (e) => {
      e.preventDefault();
      let form = new FormData(document.getElementById("login"));

      let response = await fetch("<?php echo web_root ?>/admin/login.php", {
        method: 'POST',
        body: form
      });

      let data = await response.json();
      if (data.message === "fail") {
        // Si se han superado el número máximo de intentos fallidos, recargar la página después de 2 segundos
        setTimeout(function() {
          location.reload();
        }, 1000);
      } else if (data.status === "success") {
        // Si la validación del inicio de sesión es exitosa, redirigir al usuario a otra página
        location.reload();
      } else if (data.status === "error") {
        $('#error').modal('show');
        document.querySelector(".card-title").innerHTML = data.message;
      }
    });

    // Obtener el tiempo restante antes de que se elimine la variable de sesión
    let timeLeft = <?php echo ($_SESSION['login_attempts_time'] + $max_time) - time(); ?>;

    // Función para actualizar el contador
    function updateCountdown() {
      let minutes = Math.floor(timeLeft / 60);
      let seconds = timeLeft % 60;

      // Actualizar el contenido del elemento con el contador
      document.getElementById("countdown").innerHTML = "Tiempo restante: " + minutes + " min " + seconds + " s";

      // Restar un segundo al tiempo restante
      timeLeft--;

      // Si el tiempo restante ha llegado a cero, detener el contador
      if (timeLeft < 0) {
        clearInterval(countdownInterval);
        document.getElementById("countdown").innerHTML = "Tiempo restante: 0 min 0 s";
        location.reload();

      }
    }
    <?php if (!empty($nope)) { ?>
      // Actualizar el contador cada segundo
      let countdownInterval = setInterval(updateCountdown, 1000);
    <?php } ?>
  </script>



  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- SweetAlert library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="assets/login/vendor/bootstrap/js/popper.js"></script>
  <script src="assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/login/vendor/select2/select2.min.js"></script>
  <script src="assets/login/vendor/tilt/tilt.jquery.min.js"></script>
  <script>
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>
  <script src="assets/login/js/main.js"></script>
</body>

</html>