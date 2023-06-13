
<head>
    <title>Solicitud | Gandules.</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo-gandules.png" />
</head>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

    body {
        position: fixed;
        top: 0;
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', sans-serif;
    }

    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .btn.btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #0069d9;
        border-color: #0062cc;
    }


    a {
        text-decoration: none;
    }

    .card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 400px;
        padding: 20px;
        text-align: center;
    }

    .error-message {
        color: black;
    }

    .message-content {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .custom-message {
        font-weight: bold;
    }

    .bi-exclamation-circle-fill {
        font-size: 40px;
    }

    #countdown-timer {
        font-size: 24px;
    }

    .video-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: -2;
    }

    .video-background-back {
        display: flex;
        width: 100%;
        top: 0;
        left: 0;
        height: 100%;
        position: fixed;
        z-index: -1;
        background: rgb(0 0 0 / 0.6);
        filter: blur(20px);
    }

    .timer {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .timerB {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 30px;
        width: 50px;
        color: #fff;
        border-radius: 12px;
        margin: 0 5px;
        background: rgb(0 0 0 / 0.7);
    }
</style>

<?php
require_once("include/initialize.php");

$_POST['COMPANYID'] = $_SESSION['COMPANYID'];
$_POST['JOBID'] = $_SESSION['JOBID'];
$_POST['OCUPACIONID'] = $_SESSION['OCUPACIONID'];
// echo json_encode($_POST);
// die;

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
    $job = $search_corto[0]->OCUPACION;

    $card = '';

    $card .= '<div class="video-background-back"></div>';

    $card .= '<video class="video-background" autoplay loop muted>
            <source src="assets/video/GandulesVideo.mp4" type="video/mp4">
        </video>';


    $card .= '<div class="card error-message">';
    $card .= '<div class="message-content">';
    $card .= '<i class="bi bi-exclamation-circle-fill"></i>';

    $card .= '<h3>Ya has presentado tu postulación para el puesto de <span class="text-danger">' . $job . '</span>.</h3>';

    $card .= '<p>Puedes volver a postular en una nueva convocatoria.</p>';


    $card .= '<p><a href="index.php">Volver al inicio</a></p>';
    $card .= '</div>';
    $card .= '</div>';

    echo $card;
} else {
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
    $status = isset($responseData['status']) ? $responseData['status'] : '';
    $message = isset($responseData['message']) ? $responseData['message'] : '';

    if ($status == 'success') {
        echo '<style>
            body {
                background: #000;
                overflow: hidden;
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
    
            .card {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                width: 400px;
                margin: 0 auto;
                padding: 20px;
                margin-top: 100px;
                text-align: center;
            }
    
            .success-message {
                color: green;
            }
    
            .error-message {
                color: red;
            }
    
            .message-content {
                font-size: 18px;
                margin-bottom: 10px;
            }
    
            .tips {
                font-size: 14px;
            }
    
            .tips p {
                margin-top: 5px;
            }
    
            .bi-emoji-laughing-fill {
                font-size: 40px;
            }
        </style>';

        echo '<video class="video-background" autoplay loop muted>
            <source src="assets/video/GandulesVideo.mp4" type="video/mp4">
        </video>';
        echo '<div class="card success-message">';
        echo '<div class="message-content">';
        echo '<i class="bi bi-emoji-laughing-fill"></i>';
        echo '<p class="custom-message">¡Tu solicitud se procesó con éxito!.</p>';
        echo '</div>';
        echo '<div class="tips">';
        echo '<p>Espera la respuesta de nuestro personal de reclutamiento.</p>';
        echo '<p>Te recomendamos seguir navegando en la web.</p>';
        echo '<p><a href="index.php">Volver al inicio</a></p>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="card error-message">';
        echo '<div class="message-content">';
        echo '<i class="bi bi-emoji-laughing-fill"></i>';
        echo '<p>Error: ' . $message . '</p>';
        echo '</div>';
        echo '</div>';
    }
}
