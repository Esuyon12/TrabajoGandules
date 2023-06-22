<?php
function strip_zeros_from_date($marked_string = "")
{
	//first remove the marked zeros
	$no_zeros = str_replace('*0', '', $marked_string);
	$cleaned_string = str_replace('*0', '', $no_zeros);
	return $cleaned_string;
}

function insert($tbl, $array)
{
	global $mydb;
	// Don't forget your SQL syntax and good habits:
	// - INSERT INTO table (key, key) VALUES ('value', 'value')
	// - single-quotes around all values
	// - escape all values to prevent SQL injection
	// $attributes = $this->sanitized_attributes();
	$sql = "INSERT INTO " . $tbl . " (";
	$sql .= join(", ", array_keys($array));
	$sql .= ") VALUES ('";
	$sql .= join("', '", array_values($array));
	$sql .= "')";
	echo $mydb->setQuery($sql);
}

function redirect_to($location = NULL)
{
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}
function redirect($location = Null)
{
	if ($location != Null) {
		echo "<script>
					window.location='{$location}'
				</script>";
	} else {
		echo 'error location';
	}
}
function output_message($message = "")
{

	if (!empty($message)) {
		return "<p class=\"message\">{$message}</p>";
	} else {
		return "";
	}
}
function date_toText($datetime = "")
{
	$nicetime = strtotime($datetime);
	return strftime("%B %d, %Y at %I:%M %p", $nicetime);
}
function __autoload_($class_name)
{
	$class_name = strtolower($class_name);
	$path = LIB_PATH . DS . "{$class_name}.php";
	if (file_exists($path)) {
		require_once($path);
	} else {
		die("The file {$class_name}.php could not be found.");
	}
}
spl_autoload_register('__autoload_');

function currentpage_public()
{
	$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
	$bits = explode('/', $this_page);
	$this_page = $bits[count($bits) - 1]; // will return file.php, with parameters if case, like file.php?id=2
	$this_script = $bits[0]; // will return file.php, no parameters*/
	return $bits[2];
}

function currentpage_admin()
{
	$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
	$bits = explode('/', $this_page);
	$this_page = $bits[count($bits) - 1]; // will return file.php, with parameters if case, like file.php?id=2
	$this_script = $bits[0]; // will return file.php, no parameters*/
	return $bits[4];
}
// echo "string " .currentpage_admin()."<br/>";

function curPageName()
{
	return substr($_SERVER['REQUEST_URI'], 21, strrpos($_SERVER['REQUEST_URI'], '/') - 24);
}

// echo "The current page name is ".curPageName();

function currentpage()
{
	$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
	$bits = explode('/', $this_page);
	$this_page = $bits[count($bits) - 1]; // will return file.php, with parameters if case, like file.php?id=2
	$this_script = $bits[0]; // will return file.php, no parameters*/
	return $bits[3];
}
function publiccurrentpage()
{
	$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
	$bits = explode('/', $this_page);
	$this_page = $bits[count($bits) - 1]; // will return file.php, with parameters if case, like file.php?id=2
	$this_script = $bits[0]; // will return file.php, no parameters*/
	return $bits[2];
}
// echo publiccurrentpage();
function msgBox($msg = "")
{
?>
	<script type="text/javascript">
		alert(<?php echo $msg; ?>)
	</script>
<?php
}


function fechaespañol($fecha)
{

	$meses = array(
		'January' => 'Enero',
		'February' => 'Febrero',
		'March' => 'Marzo',
		'April' => 'Abril',
		'May' => 'Mayo',
		'June' => 'Junio',
		'July' => 'Julio',
		'August' => 'Agosto',
		'September' => 'Septiembre',
		'October' => 'Octubre',
		'November' => 'Noviembre',
		'December' => 'Diciembre'
	);

	$dias_semana = array(
		'Sunday' => 'Domingo',
		'Monday' => 'Lunes',
		'Tuesday' => 'Mmartes',
		'Wednesday' => 'Miércoles',
		'Thursday' => 'Jueves',
		'Friday' => 'Viernes',
		'Saturday' => 'Sábado'
	);

	// Obtener los nombres de los días de la semana y del mes en español
	$fecha_formateada = $dias_semana[date('l', strtotime($fecha))] . ', ' . date('d', strtotime($fecha)) . ' de ' . $meses[date('F', strtotime($fecha))] . ' de ' . date('Y', strtotime($fecha));

	echo $fecha_formateada;
}

function time_ago($timestamp)
{
	$time_ago = strtotime($timestamp);
	$current_time = time();
	$time_difference = $current_time - $time_ago;
	$seconds = $time_difference;
	$minutes = round($seconds / 60);
	$hours = round($seconds / 3600);
	$days = round($seconds / 86400);
	$weeks = round($seconds / 604800);
	$months = round($seconds / 2629440);
	$years = round($seconds / 31553280);

	if ($seconds <= 60) {
		return "just now";
	} else if ($minutes <= 60) {
		if ($minutes == 1) {
			return "Publicado hace un minuto";
		} else {
			return "Hace $minutes minutos";
		}
	} else if ($hours <= 24) {
		if ($hours == 1) {
			return "Publicado hace una hora";
		} else {
			return "Publicado hace $hours horas";
		}
	} else if ($days <= 7) {
		if ($days == 1) {
			return "Publicado ayer";
		} else {
			return "Publicado hace $days dias";
		}
	} else if ($weeks <= 4.3) {
		if ($weeks == 1) {
			return "Hace una semana";
		} else {
			return "Hace $weeks semanas";
		}
	} else if ($months <= 12) {
		if ($months == 1) {
			return "Hace un mes";
		} else {
			return "Hace $months meses";
		}
	} else {
		if ($years == 1) {
			return "Hace un año";
		} else {
			return "Hace $years años";
		}
	}
};

function updateAllsVacancy()
{
	global $mydb;
	$mydb->setQuery("SELECT JOBID, COMPANYID, AREAID, OCUPACIONID, DATEPOSTED, DATE_INT, DATE_END, JOBSTATUS FROM tbljob");
	$cur = $mydb->loadResultList();
	$fechaHoraActual = date('Y-m-d H:i:s');
	$fechaActual = new DateTime($fechaHoraActual);

	$messageVac = "";

	$i = 0;
	$o = 0;
	$t = 0;
	foreach ($cur as $key) {
		$fechaInicio = new DateTime($key->DATE_INT);
		$fechaFin = new DateTime($key->DATE_END);
		$job = new Jobs();
		
		if ($fechaActual >= $fechaInicio && $fechaActual <= $fechaFin) {
			$t++;
			if ($key->JOBSTATUS != 0) {
				@$job->JOBSTATUS = 0;
				$messageVac = "Activas ". $i++;
			}
		} else {
			if ($key->JOBSTATUS != 1) {
				@$job->JOBSTATUS = 1;
				$messageVac = "Inactivas ".$o++;
			}
		}

		if (isset($job->JOBSTATUS)) {
			$job->update($key->JOBID);
		}
	}

	$messageVac = !empty($messageVac) ? "Vacantes". $messageVac .", Total - " . $t : "";

	return $messageVac;
}
