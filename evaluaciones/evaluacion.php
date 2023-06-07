<?php
require_once("../include/initialize.php");

// Verifica si existe un token en la solicitud HTTP
$message = "";
$status = "";

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
                $mydb->setQuery("SELECT * FROM `tblevaluaciones`e, `tblcreaevaluaciones`c, `tblocupaciones`o  WHERE e.`IDEVALUACIONCREA` = c.`IDEVALUACIONCREA` AND o.`OCUPACIONID` = c.`OCUPACIONID`  AND `EVALUACIONID`  =" . $datos->EVALUACIONID);
                $status = $mydb->loadSingleResult();
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
        <!-- Importa los estilos de Material Design -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
        <!-- Importa la librería de Material Design -->
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <!-- Agrega estilos personalizados -->
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
    if (!empty($status)) { ?>

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

        <div class=breadcrumbs>
            <div class=container>
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
        <section class="blog-single">
            <div class=container>
                <div class=row>
                    <div class="col-lg-8 col-md-12 col-12">
                        <div class=single-inner>
                            <div class=post-details>
                                <div class=detail-inner>
                                    <h2 class=post-title>
                                        <div>
                                            <p>Evaluacion</p>
                                        </div>
                                        <h2><?php echo $status->OCUPACION; ?></h2>
                                    </h2>
                                    <p>
                                        ¡Bienvenido! Estamos muy entusiasmados de que estés considerando unirte a
                                        nuestro equipo en Gandules.
                                        Para asegurarnos de que encajas perfectamente
                                        en nuestra familia, te pedimos que completes una evaluación para que podamos
                                        evaluar tus habilidades.</p>
                                    <p><b>¡Te deseamos mucha suerte en la evaluación!</b></p>
                                    <p style="color:black">
                                        <b><?php echo $status->TAREA ?></b>
                                    </p>

                                    <br>

                                    <div>
                                        <h3>Tener en cuenta las siguientes indicaciones:</h3>
                                    </div>

                                    <p>
                                        <?php echo $status->INDICACIONES ?>
                                    <div class="card">
                                        <div id="full">
                                            <p>Hello World!</p>
                                            <p>Desarrolla tu respuesta</p>
                                            <p><br /></p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="button">
                                        <button type="submit" class="btn" form="aplicant">Enviar respuesta</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <script src="../assets/js/bootstrap.js"></script>
        <script src="assets/js/app.js"></script>

        <script src="../assets/extensions/quill/quill.min.js"></script>
        <script src="../assets/js/pages/quill.js"></script>
    <?php } ?>
</body>

</html>