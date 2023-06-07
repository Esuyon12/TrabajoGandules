<?php
require_once("../include/initialize.php");

date_default_timezone_set('America/Lima');
// Verifica si existe un token en la solicitud HTTP
$message = "";
$status = "";
$examen = "";

if (!empty($_GET['TOKEN'])) {
    // Define la clave secreta para la firma del token
    $clave_secreta = 'XjhGjf7SPsdoobvW';

    // Separa los datos codificados y la firma
    $partes_token = explode('.', $_GET['TOKEN']);

    // Verifica que el token tenga al menos dos partes
    if (count($partes_token) == 2) {
        $datos_base64 = $partes_token[0];
        $firma = $partes_token[1];

        // Verifica la firma del token
        if (hash_hmac('sha256', $datos_base64, $clave_secreta) === $firma) {
            // Si la firma es válida, decodifica los datos y los utiliza en la página
            $datos_json = base64_decode($datos_base64);
            $datos = json_decode($datos_json);

            // Verifica si el token ha expirado
            if (time() >= $datos->exp) {
                $message = "La evaluación ha expirado.";
                // Agrega el código para manejar un token expirado aquí
            } else {
                $mydb->setQuery("SELECT * FROM `tblevaluaciones` e, `tblcreaevaluaciones` c, `tblocupaciones` o WHERE e.`IDEVALUACIONCREA` = c.`IDEVALUACIONCREA` AND o.`OCUPACIONID` = c.`OCUPACIONID` AND `EVALUACIONID` =" . $datos->EVALUACIONID);
                $status = $mydb->loadSingleResult();

                if (empty($status->DATE_IN) || empty($status->DATE_END)) {
                    if (!empty($_POST)) {
                        // print_r($datos->EVALUACIONID);

                        $evacre = new Evaluaciones();
                        $fechaHoraActual = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual
                        $fechaHoraSiguiente = date('Y-m-d H:i:s', strtotime('+1 hour')); // Sumar una hora a la fecha y hora actual

                        $evacre->DATE_IN = $fechaHoraActual;
                        $evacre->DATE_END = $fechaHoraSiguiente;

                        $evacre->update($datos->EVALUACIONID);

                        echo "<script>location.reload()</script>";
                        die();
                    }
                }

                if (!empty($status->DATE_IN) || !empty($status->DATE_END)) {
                    $examen = $status;
                    $fechaHoraActual = date('Y-m-d H:i:s');
                    $status = "";
                }
            }
        } else {
            // Si la firma no es válida, muestra un mensaje de error
            $message = "Acceso no válido.";
        }
    } else {
        // Si el token no tiene al menos dos partes, muestra un mensaje de error
        $message = "Acceso no válido.";
    }
} else {
    // Si no se recibió un token en la solicitud HTTP, muestra un mensaje de error
    $message = "No se encontró el código de acceso.";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluacion</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/logo-gandules.png" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif !important;
        }

        body {
            background: #E0EAFC;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #CFDEF3, #E0EAFC);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #CFDEF3, #E0EAFC);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }

        .blog-single {
            background: none !important;
        }
    </style>
    <?php if (!empty($message)) { ?>

        <style>
            h3,
            h4 {
                font-family: 'Poppins', sans-serif !important;
            }

            body {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .mdl-card {
                width: 80%;
                max-width: 400px;
                min-height: 150px;
                border-radius: 12px;
                margin: 0 auto;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;

            }

            .mdl-card__supporting-text {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
            }
        </style>
    <?php };
    if (!empty($status) or !empty($examen)) { ?>

        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../assets/css/LineIcons.2.0.css" />
        <link rel="stylesheet" href="../assets/css/animate.css" />
        <link rel="stylesheet" href="../assets/css/tiny-slider.css" />
        <link rel="stylesheet" href="../assets/css/main.css" />

        <link rel="stylesheet" href="../assets/extensions/quill/quill.snow.css" />
        <link rel="stylesheet" href="../assets/extensions/quill/quill.bubble.css" />

    <?php } ?>

</head>

<body>
    <?php if (!empty($message)) { ?>
        <!-- Crea la tarjeta -->
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__supporting-text">
                <h3><?php echo $message ?></h3>
            </div>
        </div>

    <?php };
    if (!empty($status)) { ?>
        <br>
        <br>
        <section class="blog-single">
            <div class=container>
                <div class=row>
                    <div class="col-lg-9 col-md-12 col-12 mx-auto">
                        <div class=single-inner>
                            <div class=post-details>
                                <div class=detail-inner>
                                    <h2 class="card-title">
                                        <?php echo $status->OCUPACION ?>
                                    </h2>
                                    <p style="margin-bottom: 2px !important;">Antes de comenzar tu examen, es importante tener en cuenta algunas instrucciones clave: </p>
                                    <ul style="list-style-type: unset;" class="mx-4">
                                        <li>Dispondrás de 60 minutos para completar esta evaluación.</li>
                                        <li>Una vez que transcurran los 60 minutos, el examen se guardará automáticamente y será enviado para su evaluación.</li>
                                        <li>Recomendamos encarecidamente que realices el examen en un entorno libre de distracciones y te enfoques por completo en la tarea.</li>
                                        <li>Antes de iniciar, tómate un momento para relajarte y concentrarte. Respira profundamente y confía en tus habilidades.</li>
                                        <li>Recuerda que este examen es una oportunidad para demostrar tus conocimientos y habilidades, así que da lo mejor de ti.</li>
                                    </ul>
                                    <p style="font-weight: 700;" class="text-end">¡Aprovecha cada minuto y buena suerte en tu evaluación!</p>
                                    <form class="button text-end" action="" method="POST">
                                        <input type="hidden" name="test" value="start">
                                        <button class="btn">Empezar evaluacion</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    <?php } ?>
    <?php if (!empty($examen)) { ?>
        <div class=breadcrumbs>
            <div class=container>
                <div class="row fixed-bottom" id="timestamp">
                    <!-- Aqui imprime el reloj -->
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class=breadcrumbs-content>
                            <h1 class=page-title>Evaluaciones de habilidades</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class=breadcrumb-nav>
                            <li><a href=#>Home</a></li>
                            <li>Evaluaciones de habilidades</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <br>
        <br>
        <section class="blog-single mb-4">
            <div class=container>
                <div class=row>
                    <div class="col-lg-8 col-md-12 col-12">
                        <div class="single-inner mb-90">
                            <div class=post-details>
                                <div class=detail-inner>
                                    <h2 class=post-title><?php echo $examen->OCUPACION; ?></h2>
                                    <br>
                                    <p style="color:black"><?php echo $examen->TAREA ?></p>

                                    <h3>Tener en cuenta las siguientes indicaciones:</h3>
                                    <p><?php echo $examen->INDICACIONES ?></p>
                                    <div class="card">
                                        <div id="full">
                                            <?php if (!empty($examen->RESPUESTA)) { ?>
                                                <?php echo $examen->RESPUESTA ?>
                                            <?php } else { ?>
                                                <p>Desarrolla tu respuesta</p>
                                                <p><br /></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="button">
                                        <button id="sub" class="btn">Enviar respuesta</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="../assets/extensions/quill/quill.min.js"></script>
        <script>
            var options = {
                modules: {
                    toolbar: [
                        [{
                            'header': [1, 2, 3, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        ['link'],
                        [{
                            'list': 'bullet'
                        }],
                        [{
                            'color': []
                        }, {
                            'background': []
                        }],
                    ]
                },
                placeholder: 'Escribe aquí tu mensaje...',
                theme: 'snow'
            };
            var respuesta = new Quill('#full', options);
            const botonFinalizar = document.getElementById('sub'); // Asumiendo que existe un botón con id "boton-finalizar"

            <?php
            // echo $examen->DATE_END ."<". $fechaHoraActual; exit;
            if ($examen->DATE_END > $fechaHoraActual) {
            ?>

                function formatTime(time) {
                    const hours = Math.floor(time / (1000 * 60 * 60));
                    const minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((time % (1000 * 60)) / 1000);
                    return `${padZero(minutes)}:${padZero(seconds)}`;
                }

                function padZero(num) {
                    return num < 10 ? '0' + num : num;
                }


                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('timestamp').innerHTML = `
                    <div class="card col-md-9 mx-auto">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="text-muted" id="end">Tiempo restante <span class="text-muted" id="timeleft"></span></p>
                                <p class="text-muted" id="nose"></p>
                                </div>
                                <div class="progress" style="height: 20px" role="progressbar">
                                <div id="progress-bar" class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;"></div>
                            </div>
                        </div>
                    </div>
                `;
                    const progressBar = document.getElementById('progress-bar');
                    const timeRemaining = document.getElementById('time-remaining');
                    const timeleft = document.getElementById('timeleft');
                    const nose = document.getElementById("nose")
                    const startTime = new Date('<?php echo $examen->DATE_IN; ?>').getTime();
                    const endTime = new Date('<?php echo $examen->DATE_END; ?>').getTime();
                    let progressInterval; // Declarar la variable progressInterval


                    updateProgressBar();
                    progressInterval = setInterval(updateProgressBar, 1000); // Asignar el valor del intervalo a progressInterval

                    function updateProgressBar() {
                        const now = new Date().getTime();
                        const progress = (endTime - now) / (endTime - startTime) * 100;
                        const timeLeft = endTime - now;

                        progressBar.style.width = progress + '%';
                        progressBar.setAttribute('aria-valuenow', progress);
                        timeleft.textContent = formatTime(timeLeft);



                        if (timeLeft <= 0) {
                            document.getElementById('sub').disabled = true
                            respuesta.enable(false)

                            // location.reload()
                            clearInterval(progressInterval);
                            document.getElementById('end').textContent = 'Tiempo agotado';
                        }
                    }
                });



                let enviarRespuestaInterval;
                const formData = new FormData();

                async function enviarRespuesta(a = "") {
                    formData.append('respuesta', respuesta.root.innerHTML);
                    formData.append('ID', <?php echo $examen->EVALUACIONID ?>);
                    a

                    let response = await fetch('<?php echo URL_WEB . web_root ?>admin/evaluaciones/controller.php?action=send', {
                        method: 'POST',
                        body: formData
                    })

                    let data = await response.json()
                    console.log(data);

                    nose.innerHTML = data.message

                    setTimeout(function() {
                        nose.innerHTML = "";
                    }, 3000);

                }

                function finalizarExamen() {
                    clearInterval(enviarRespuestaInterval); // Detener el envío automático cada 5 minutos
                    // Aquí puedes agregar cualquier otra lógica adicional que desees realizar al finalizar el examen

                    // Por ejemplo, puedes redirigir a otra página o mostrar un mensaje de finalización
                    alert('Examen finalizado');

                    // También puedes deshabilitar el botón de finalizar si no se desea que se pueda presionar nuevamente
                    botonFinalizar.disabled = true;
                    respuesta.enable(false)

                    enviarRespuesta(formData.append('mood', "end"));
                    setTimeout(function() {
                        location.reload()
                    }, 3000)
                }


                botonFinalizar.addEventListener('click', finalizarExamen);

                // Iniciar el envío automático cada 5 minutos
                enviarRespuestaInterval = setInterval(enviarRespuesta, 5 * 60 * 1000); // 5 minutos = 5 * 60 segundos * 1000 milisegundos

            <?php
            } else { ?>
                botonFinalizar.disabled = true;
                respuesta.enable(false)
            <?php } ?>
        </script>
        <script src="../assets/js/bootstrap.js"></script>

    <?php } ?>
</body>

</html>