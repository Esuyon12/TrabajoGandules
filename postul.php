<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud | Gandules</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo-gandules.png" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }

        body {
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            max-width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 6px 6px 7px 2px rgb(0 0 0 /.4);
            background: #fff;
            position: relative;
            z-index: 2;
        }

        .message-content {
            line-height: 30px;
            text-align: center;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
    </style>
</head>

<body>
    <video class="video-background" autoplay loop muted>
        <source src="assets/video/GandulesVideo.mp4" type="video/mp4">
        <!-- Aquí puedes agregar más formatos de video si lo deseas, por ejemplo: -->
        <!-- <source src="ruta/al/video.webm" type="video/webm"> -->
        <!-- <source src="ruta/al/video.ogv" type="video/ogg"> -->
        Tu navegador no admite el elemento de video.
    </video>
    <?php
    require_once("include/initialize.php");

    $_POST['COMPANYID'] = $_SESSION['COMPANYID'];
    $_POST['JOBID'] = $_SESSION['JOBID'];
    $_POST['OCUPACIONID'] = $_SESSION['OCUPACIONID'];

    $file = $_FILES['CVFILE'];

    // Crear un objeto CURLFile
    $cfile = curl_file_create($file['tmp_name'], $file['type'], $file['name']);

    // Definir los datos a enviar en el formulario
    $postData = $_POST;
    $postData['CVFILE'] = $cfile;

    $dni = $_POST['DNI'];
    $jobid = $_POST['JOBID'];

    $mydb->setQuery("SELECT * FROM tblapplicants a, tblocupaciones e WHERE a.DNI = '$dni' AND a.JOBID = '$jobid' AND a.JOBID = e.OCUPACIONID ");
    $search_corto = $mydb->loadResultList();

    if (count($search_corto) > 0) {
        $job = $search_corto[0]->OCUPACION; ?>

        <div class="card error-message">
            <div class="message-content">
                <i class="bi bi-exclamation-circle-fill"></i>
                <h3>Ya has presentado tu postulación para el puesto de <span class="text-danger"><?php echo $job ?></span>.</h3>
                <p>Puedes volver a postular en una nueva convocatoria.</p>
                <p><a href="index.php">Volver al inicio</a></p>
            </div>
        </div>
    <?php } else {
        // Inicializar la sesión CURL
        $ch = curl_init();

        // Configurar la sesión CURL
        curl_setopt($ch, CURLOPT_URL, URL_WEB . web_root . 'admin/applicants/controller.php?action=postul');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Ejecutar la sesión CURL y obtener la respuesta
        $response = curl_exec($ch);

        // Cerrar la sesión CURL
        curl_close($ch);

        $responseData = json_decode($response, true);
        $status = $responseData['status'];
        // $message = $responseData['message'];
        $message = json_encode($response);
    ?>

        <div class="card">
            <div class="message-content">

                <?php if ($status == 'success') { ?>
                    <i class="bi bi-emoji-laughing-fill"></i>
                    <p class="custom-message">¡Tu solicitud se procesó con éxito!</p>
                    <div class="tips">
                        <p>Espera la respuesta de nuestro personal de reclutamiento.</p>
                        <p><a href="index.php">Volver al inicio</a></p>
                    </div>
                <?php } else { ?>
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <p>Error: <?php echo $message ?></p>
                <?php } ?>

            </div>
        </div>
    <?php }
    ?>

    <script>
        // Scripts JavaScript aquí
    </script>
</body>

</html>