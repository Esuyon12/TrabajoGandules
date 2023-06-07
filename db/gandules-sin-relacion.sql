-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-05-2023 a las 03:19:42
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gandules`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `EMPLEADOID` int NOT NULL AUTO_INCREMENT,
  `APELLIDOP` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `APELLIDOM` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `NOMBRE` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `DNI` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `TELEFONO` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `CORREO` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ESTADOCIVIL` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `CUMPLEAÑOS` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `GENERO` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `DEPARTAMENTO` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `PROVINCIA` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `DISTRITO` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `DIRECCION` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `AREA` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `PUESTO` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `SEDE` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ESTADO` int DEFAULT '0',
  `FECHAREGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`EMPLEADOID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`EMPLEADOID`, `APELLIDOP`, `APELLIDOM`, `NOMBRE`, `DNI`, `TELEFONO`, `CORREO`, `ESTADOCIVIL`, `CUMPLEAÑOS`, `GENERO`, `DEPARTAMENTO`, `PROVINCIA`, `DISTRITO`, `DIRECCION`, `AREA`, `PUESTO`, `SEDE`, `ESTADO`, `FECHAREGISTRO`) VALUES
(1, 'PRUEBA', 'PRUEBA', 'PRUEBA', '3232', '32323', 'PRUEBA', 'PRUEBA', 'PRUEBA', 'PRUEBA', 'PRUEBA', 'PRUEBA', 'PRUEBA', 'PRUEBAPRUEBA', 'PRUEBA', 'PRUEBA', 'PRUEBA', 0, '2023-05-10 00:00:00'),
(2, 'sa', 'sa', 'sasas', 'TRTRT', 'sas', 'asa', 'sa', 'sas', 'as', 'asa', 'sasa', 'as', 'SDS', 'SD', 'D', 'SDSD', 0, '2023-05-07 00:00:00'),
(3, 'ASA', 'SAS', 'ASAS', 'ASA', 'SAS', 'ASA', 'SASA', 'SAS', 'SAS', 'ASA', 'SAS', 'ASAS', 'ASA', 'SAS', 'ASAS', 'ASS', 0, '2023-05-07 00:00:00'),
(4, 'asas', 'as', '', '2212', '12', 'yuyuyu@gmail.com', '', '2023-05-25', '', '', '', '', '', '', '', '', 0, '2023-05-07 00:00:00'),
(5, 'Suyon', 'Yamunaque', 'Evelyn Lisseth', '73902466', '966333215', 'suyon@gmail.com', 'Masculino', '2023-05-04', 'Sin definir', 'sa', 'as', 'sa', 'asas', '', '', '', 1, '2023-05-07 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recovery`
--

DROP TABLE IF EXISTS `recovery`;
CREATE TABLE IF NOT EXISTS `recovery` (
  `ID` int NOT NULL,
  `USERID` int DEFAULT NULL,
  `CODIGO` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `FECHA_DE_CREACION` date DEFAULT NULL,
  `FECHA_DE_VERIFICACION` date DEFAULT NULL,
  `FECHA_DE_EXPIRACION` date DEFAULT NULL,
  `ESTADO` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int NOT NULL,
  `nombre_rol` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblapplicants`
--

DROP TABLE IF EXISTS `tblapplicants`;
CREATE TABLE IF NOT EXISTS `tblapplicants` (
  `APPLICANTID` int NOT NULL AUTO_INCREMENT,
  `DNI` int NOT NULL,
  `FNAME` varchar(90) NOT NULL,
  `LNAME` varchar(90) NOT NULL,
  `MNAME` varchar(90) NOT NULL,
  `EMAILADDRESS` varchar(90) NOT NULL,
  `CONTACTNO` varchar(90) NOT NULL,
  `CVFILE` varchar(100) NOT NULL,
  `COMPANYID` int NOT NULL,
  `JOBID` int NOT NULL,
  `STATE` int NOT NULL DEFAULT '0',
  `POINTS` int NOT NULL,
  `DATEADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`APPLICANTID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblareas`
--

DROP TABLE IF EXISTS `tblareas`;
CREATE TABLE IF NOT EXISTS `tblareas` (
  `AREAID` int NOT NULL AUTO_INCREMENT,
  `AREA` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `FECHAREGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ESTADO` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`AREAID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblareas`
--

INSERT INTO `tblareas` (`AREAID`, `AREA`, `FECHAREGISTRO`, `ESTADO`) VALUES
(1, 'Área de Operaciones\n', '2023-05-05 00:00:00', 1),
(2, 'Área de Ventas y Comercialización\n', '2023-05-05 00:00:00', 1),
(3, 'Área de Servicio al Cliente\n', '2023-05-05 00:00:00', 1),
(4, 'Área de Investigación y Desarrollo (I+D)\n', '2023-05-05 00:00:00', 1),
(5, 'Área de Marketing y Publicidad\n', '2023-05-05 00:00:00', 1),
(6, 'Área de Recursos Humanos y Gestión del Talento\n', '2023-05-05 00:00:00', 1),
(7, 'Área de Finanzas y Contabilidad\n', '2023-05-05 00:00:00', 1),
(8, 'Área Legal y Cumplimiento\n', '2023-05-05 00:00:00', 1),
(9, 'Área de Tecnología de la Información (TI) o Sistemas\n', '2023-05-05 00:00:00', 1),
(10, 'Área de Calidad y Mejora Continua\n', '2023-05-05 00:00:00', 1),
(11, 'Área de Compras y Abastecimiento\n', '2023-05-05 00:00:00', 1),
(12, 'Área de Producción y Operaciones\n', '2023-05-05 00:00:00', 1),
(13, 'Área de Logística y Distribución\n', '2023-05-05 00:00:00', 1),
(14, 'Área de Desarrollo de Negocios y Expansión\n', '2023-05-08 00:00:00', 1),
(15, 'Área de Relaciones Públicas y Comunicación', '2023-05-20 21:07:38', 1),
(16, 'Área de Responsabilidad Social Corporativa', '2023-05-20 21:07:44', 1),
(17, 'Área de Gestión de Proyectos', '2023-05-20 21:07:57', 1),
(18, 'Área de Seguridad y Salud Laboral', '2023-05-20 21:08:03', 1),
(19, 'Área de Investigación de Mercado', '2023-05-20 21:08:12', 1),
(20, 'Área de Innovación y Desarrollo Tecnológico', '2023-05-20 21:08:19', 1),
(21, 'Área de Planificación Estratégica', '2023-05-20 21:08:26', 1),
(22, 'Área de Administración de Riesgos', '2023-05-20 21:08:31', 1),
(23, 'Área de Desarrollo Sostenible y Medio Ambiente', '2023-05-20 21:08:36', 1),
(24, 'Área de Contabilidad y Finanzas', '2023-05-20 21:08:42', 1),
(25, 'Área de Desarrollo Organizacional', '2023-05-20 21:08:50', 1),
(26, 'Área de Gestión Ambiental y Sostenibilidad', '2023-05-20 21:08:56', 1),
(27, 'Área de Relaciones Institucionales', '2023-05-20 21:09:03', 1),
(28, 'Área de Cumplimiento y Legal', '2023-05-20 21:09:12', 1),
(29, 'Área de Análisis de Datos y Business Intelligence', '2023-05-20 21:09:19', 1),
(30, 'Área de Gestión del Cambio', '2023-05-20 21:09:27', 1),
(31, 'Área de Control de Calidad', '2023-05-20 21:11:51', 1),
(32, 'Área de Investigación de Mercados Internacionales', '2023-05-20 21:14:13', 1),
(33, 'Área de Gestión de Almacenes', '2023-05-20 21:15:52', 1),
(34, 'Área de Desarrollo de Productos y Servicios', '2023-05-20 21:17:16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblattachmentfile`
--

DROP TABLE IF EXISTS `tblattachmentfile`;
CREATE TABLE IF NOT EXISTS `tblattachmentfile` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `FILEID` varchar(30) DEFAULT NULL,
  `JOBID` int NOT NULL,
  `FILE_NAME` varchar(90) NOT NULL,
  `FILE_LOCATION` varchar(255) NOT NULL,
  `USERATTACHMENTID` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblattachmentfile`
--

INSERT INTO `tblattachmentfile` (`ID`, `FILEID`, `JOBID`, `FILE_NAME`, `FILE_LOCATION`, `USERATTACHMENTID`) VALUES
(2, '2147483647', 2, 'Resume', 'photos/27052018124027PLATENO FE95483.docx', 2018013),
(3, '20236912552', 0, 'Resume', 'photos/', 2023016);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblautonumbers`
--

DROP TABLE IF EXISTS `tblautonumbers`;
CREATE TABLE IF NOT EXISTS `tblautonumbers` (
  `AUTOID` int NOT NULL AUTO_INCREMENT,
  `AUTOSTART` varchar(30) NOT NULL,
  `AUTOEND` int NOT NULL,
  `AUTOINC` int NOT NULL,
  `AUTOKEY` varchar(30) NOT NULL,
  PRIMARY KEY (`AUTOID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblautonumbers`
--

INSERT INTO `tblautonumbers` (`AUTOID`, `AUTOSTART`, `AUTOEND`, `AUTOINC`, `AUTOKEY`) VALUES
(1, '02983', 14, 1, 'userid'),
(2, '000', 78, 1, 'employeeid'),
(3, '0', 17, 1, 'APPLICANT'),
(4, '69125', 65, 1, 'FILEID');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcategory`
--

DROP TABLE IF EXISTS `tblcategory`;
CREATE TABLE IF NOT EXISTS `tblcategory` (
  `CATEGORYID` int NOT NULL AUTO_INCREMENT,
  `CATEGORY` varchar(250) NOT NULL,
  PRIMARY KEY (`CATEGORYID`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblcategory`
--

INSERT INTO `tblcategory` (`CATEGORYID`, `CATEGORY`) VALUES
(10, 'Mercadeo y Ventas'),
(32, 'Producción'),
(34, 'Recursos Humanos'),
(37, 'Producciónnnn'),
(42, 'ewewe'),
(43, 'FGFGFG'),
(44, 'nbnbn');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcompany`
--

DROP TABLE IF EXISTS `tblcompany`;
CREATE TABLE IF NOT EXISTS `tblcompany` (
  `COMPANYID` int NOT NULL AUTO_INCREMENT,
  `COMPANYNAME` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `COMPANYADDRESS` varchar(90) NOT NULL,
  `COMPANYCONTACTNO` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `COMPANYSTATUS` int NOT NULL DEFAULT '0',
  `FECHAREGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`COMPANYID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblcompany`
--

INSERT INTO `tblcompany` (`COMPANYID`, `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`, `COMPANYSTATUS`, `FECHAREGISTRO`) VALUES
(1, 'Gandules Inc Sac', 'Jayanca, Perú.', 'Nombre de un encargado', 1, '2023-05-05 00:00:00'),
(2, 'Niño Jesus', 'Jayanca, Perú.', 'Nombre de un encargado', 1, '2023-05-05 00:00:00'),
(3, 'San Judas', 'Jayanca, Perú.', 'Nombre de un encargado', 1, '2023-05-05 00:00:00'),
(4, 'El roble', 'Jayanca, Perú.', 'Nombre de un encargado', 0, '2023-05-05 00:00:00'),
(5, 'Fundo Nombre', 'Jayanca, Perú.', 'Nombre de un encargado', 0, '2023-05-05 00:00:00'),
(6, 'Fundo Jayanca', 'Jayanca, Perú.', 'Nombre de un encargado', 1, '2023-05-05 00:00:00'),
(7, 'Fabrica de Campo', 'Jayanca, Perú.', 'Nombre de un encargado', 0, '2023-05-05 00:00:00'),
(8, ' San Pedro De Lloc', 'La Libertad, Perú', 'Nombre de un responsable', 1, '2023-05-05 00:00:00'),
(9, 'Empres Prueba', 'Empres Prueba', 'Empres Prueba', 1, '2023-05-09 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcreaevaluaciones`
--

DROP TABLE IF EXISTS `tblcreaevaluaciones`;
CREATE TABLE IF NOT EXISTS `tblcreaevaluaciones` (
  `IDEVALUACIONCREA` int NOT NULL AUTO_INCREMENT,
  `OCUPACIONID` int NOT NULL,
  `TITULO` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `TAREA` text COLLATE utf8mb4_general_ci NOT NULL,
  `INDICACIONES` text COLLATE utf8mb4_general_ci NOT NULL,
  `ESTADO` int NOT NULL DEFAULT '0',
  `FECHAREGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDEVALUACIONCREA`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblcreaevaluaciones`
--

INSERT INTO `tblcreaevaluaciones` (`IDEVALUACIONCREA`, `OCUPACIONID`, `TITULO`, `TAREA`, `INDICACIONES`, `ESTADO`, `FECHAREGISTRO`) VALUES
(1, 5, ' Estudio de Mercado para el Lanzamiento de un Nuevo Producto', '¿Existe demanda y aceptación para el nuevo producto en el mercado objetivo?\n<br>\n¿Cuáles son las preferencias, necesidades y deseos de los consumidores en relación al nuevo producto?\n<br>\n¿Cuál es el tamaño del mercado y cuál es su potencial de crecimiento?\n<br>\n¿Quiénes son los competidores principales y cuál es su participación de mercado?\n<br>\n¿Cuál es la percepción y posicionamiento de la marca en comparación con los competidores?\n<br>\n¿Cuál es el precio óptimo para el nuevo producto que maximice las ventas y los márgenes de beneficio?\n<br>\n¿Cuáles son los canales de distribución más efectivos para llegar al mercado objetivo?\n<br>\n¿Cuáles son las estrategias de marketing y comunicación más adecuadas para promocionar el nuevo producto?', '1. Proporcionar una especificación detallada de los requisitos de la API, incluyendo los métodos HTTP permitidos, los tipos de datos que se deben utilizar y los formatos de respuesta.<br><br>2. Especificar las herramientas que deben usarse, como el marco de la aplicación, la base de datos y cualquier biblioteca adicional necesaria.', 1, '2023-05-09 00:00:00'),
(2, 2, 'Evaluación Profesional para un Analista de Laboratorio', 'Describe brevemente tu experiencia previa como Analista de Laboratorio. ¿Cuánto tiempo has trabajado en esta posición y en qué tipo de laboratorios has trabajado?\r\n<br>\r\n¿Cuáles son las técnicas de laboratorio más comunes con las que estás familiarizado(a)? Explica brevemente en qué consisten y cómo las has utilizado en tu trabajo anterior.\r\n<br>\r\n¿Cómo manejas y organizas los datos y resultados obtenidos en el laboratorio? Describe un ejemplo de cómo has gestionado y analizado grandes cantidades de datos en tu trabajo anterior.\r\n<br>\r\nLa seguridad en el laboratorio es de suma importancia. ¿Cuáles son las medidas de seguridad que consideras cruciales en un entorno de laboratorio? Proporciona ejemplos de cómo has aplicado estas medidas en tu experiencia laboral anterior.\r\n<br>\r\nLa calibración y mantenimiento de los equipos de laboratorio son fundamentales para obtener resultados precisos y confiables. ¿Cómo te aseguras de que los equipos estén calibrados y funcionando correctamente? Proporciona ejemplos de cómo has llevado a cabo esta tarea en el pasado.\r\n<br>\r\nEn un laboratorio, a veces pueden surgir problemas inesperados. Describe una situación en la que hayas enfrentado un desafío o dificultad en tu trabajo como Analista de Laboratorio y cómo lo resolviste.\r\n<br>\r\nLa comunicación efectiva es clave en un entorno de laboratorio. ¿Cómo te aseguras de que la información se transmita de manera clara y precisa entre los miembros del equipo? Describe una experiencia en la que hayas trabajado en colaboración con otros profesionales de laboratorio y cómo lograste una comunicación efectiva.', 'A continuación, encontrarás una serie de preguntas relacionadas con las habilidades y conocimientos requeridos para el puesto de Analista de Laboratorio. Por favor, lee cada pregunta cuidadosamente y proporciona tus respuestas de manera clara y concisa. Tómate el tiempo necesario para responder con precisión y utilizar ejemplos relevantes cuando sea apropiado. Tu evaluación será utilizada para determinar tu idoneidad para el puesto. ¡Buena suerte!', 1, '2023-05-20 21:39:33'),
(3, 9, 'Evaluación Profesional para un Gerente de Almacén', 'Preguntas:\r\n\r\nDescribe brevemente tu experiencia previa como Gerente de Almacén. ¿Cuánto tiempo has trabajado en esta posición y en qué tipo de almacenes has gestionado?\r\n\r\n¿Cuáles son las responsabilidades principales de un Gerente de Almacén? Enumera y explica brevemente las tareas y funciones clave que has desempeñado en tu experiencia laboral anterior.\r\n\r\nEl control de inventario es crucial para un almacén eficiente. ¿Cuál es tu enfoque para garantizar un inventario preciso y actualizado? Proporciona ejemplos de herramientas o métodos que has utilizado para llevar a cabo esta tarea en tu experiencia previa.\r\n\r\nLa seguridad en el almacén es de suma importancia. ¿Cuáles son las medidas de seguridad que consideras cruciales en un entorno de almacén? Proporciona ejemplos de cómo has implementado estas medidas en tu experiencia laboral anterior.\r\n\r\nLa gestión de equipos es esencial para un Gerente de Almacén. ¿Cómo lideras y motivas a tu equipo para lograr los objetivos del almacén? Describe una situación en la que hayas enfrentado un desafío en la gestión de tu equipo y cómo lo resolviste.\r\n\r\nLa optimización de los procesos es fundamental para mejorar la eficiencia del almacén. ¿Cómo identificas áreas de mejora y qué acciones has tomado para optimizar los procesos de tu almacén anteriormente? Proporciona ejemplos de cómo has implementado cambios exitosos en la gestión de procesos.', 'Instrucciones: A continuación, encontrarás una serie de preguntas relacionadas con las habilidades y conocimientos requeridos para el puesto de Gerente de Almacén. Por favor, lee cada pregunta cuidadosamente y proporciona tus respuestas de manera clara y concisa. Tómate el tiempo necesario para responder con precisión y utilizar ejemplos relevantes cuando sea apropiado. Tu evaluación será utilizada para determinar tu idoneidad para el puesto. ¡Buena suerte!', 1, '2023-05-20 21:43:26'),
(10, 13, 'no se we, es prueba', '<p>jknajdajkndkjnadjaknjads</p><p>asdsasdsa</p><p>dasdsadada</p><p>sadadsasdsa</p><p>dasdasdadasa</p>', 'no se tu dime, quizas si haya o no se we', 1, '2023-05-26 03:36:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblemployees`
--

DROP TABLE IF EXISTS `tblemployees`;
CREATE TABLE IF NOT EXISTS `tblemployees` (
  `INCID` int NOT NULL AUTO_INCREMENT,
  `APLICANTID` int NOT NULL,
  `AREAID` int NOT NULL,
  `OCUPACIONID` int NOT NULL,
  `DATEHIRED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `COMPANYID` int NOT NULL,
  `ESTADO` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`INCID`),
  UNIQUE KEY `EMPLOYEEID` (`APLICANTID`),
  KEY `AREAID` (`AREAID`),
  KEY `PUESTOID` (`OCUPACIONID`),
  KEY `COMPANYID` (`COMPANYID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblevaluaciones`
--

DROP TABLE IF EXISTS `tblevaluaciones`;
CREATE TABLE IF NOT EXISTS `tblevaluaciones` (
  `EVALUACIONID` int NOT NULL AUTO_INCREMENT,
  `APPLICANTID` int DEFAULT NULL,
  `TOKEN` varchar(390) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IDEVALUACIONCREA` text COLLATE utf8mb4_general_ci,
  `RESULT` int NOT NULL,
  `OCUPACIONID` int NOT NULL,
  `AREAID` int NOT NULL,
  `MSG` int NOT NULL DEFAULT '0',
  `RESPUESTA` text COLLATE utf8mb4_general_ci NOT NULL,
  `DATE_END` datetime DEFAULT NULL,
  `DATE_IN` datetime DEFAULT NULL,
  PRIMARY KEY (`EVALUACIONID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblfeedback`
--

DROP TABLE IF EXISTS `tblfeedback`;
CREATE TABLE IF NOT EXISTS `tblfeedback` (
  `FEEDBACKID` int NOT NULL AUTO_INCREMENT,
  `APPLICANTID` int NOT NULL,
  `REGISTRATIONID` int NOT NULL,
  `FEEDBACK` text NOT NULL,
  PRIMARY KEY (`FEEDBACKID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblfeedback`
--

INSERT INTO `tblfeedback` (`FEEDBACKID`, `APPLICANTID`, `REGISTRATIONID`, `FEEDBACK`) VALUES
(2, 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbljob`
--

DROP TABLE IF EXISTS `tbljob`;
CREATE TABLE IF NOT EXISTS `tbljob` (
  `JOBID` int NOT NULL AUTO_INCREMENT,
  `COMPANYID` int NOT NULL,
  `AREAID` int NOT NULL,
  `OCUPACIONID` int NOT NULL,
  `REQ_EMPLOYEES` int NOT NULL,
  `SUELDO` double NOT NULL,
  `WORKEXPERIENCE` text NOT NULL,
  `JOBDESCRIPTION` text NOT NULL,
  `BENEFICIOS` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `GENERO` varchar(30) NOT NULL,
  `TCONTRATOID` int NOT NULL,
  `MODALIDAD` varchar(100) NOT NULL,
  `TIEMPO` varchar(100) NOT NULL,
  `JOBSTATUS` int NOT NULL DEFAULT '0',
  `DATEPOSTED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`JOBID`),
  KEY `AREAID` (`AREAID`),
  KEY `OCUPACIONID` (`OCUPACIONID`),
  KEY `COMPANYID` (`COMPANYID`),
  KEY `TCONTRATOID` (`TCONTRATOID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbljob`
--

INSERT INTO `tbljob` (`JOBID`, `COMPANYID`, `AREAID`, `OCUPACIONID`, `REQ_EMPLOYEES`, `SUELDO`, `WORKEXPERIENCE`, `JOBDESCRIPTION`, `BENEFICIOS`, `GENERO`, `TCONTRATOID`, `MODALIDAD`, `TIEMPO`, `JOBSTATUS`, `DATEPOSTED`) VALUES
(15, 1, 1, 13, 8, 455545, 'pruebA', 'pruebA', 'pruebA', 'Maculino/Femenino', 1, 'Presencial', 'Tiempo completo', 0, '2023-05-20 04:27:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbljobregistration`
--

DROP TABLE IF EXISTS `tbljobregistration`;
CREATE TABLE IF NOT EXISTS `tbljobregistration` (
  `REGISTRATIONID` int NOT NULL AUTO_INCREMENT,
  `COMPANYID` int NOT NULL,
  `JOBID` int NOT NULL,
  `APPLICANTID` int NOT NULL,
  `APPLICANT` varchar(90) NOT NULL,
  `REGISTRATIONDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `REMARKS` varchar(255) NOT NULL DEFAULT 'Pending',
  `FILEID` varchar(30) DEFAULT NULL,
  `PENDINGAPPLICATION` tinyint(1) NOT NULL DEFAULT '1',
  `HVIEW` tinyint(1) NOT NULL DEFAULT '1',
  `DATETIMEAPPROVED` datetime NOT NULL,
  PRIMARY KEY (`REGISTRATIONID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbljobregistration`
--

INSERT INTO `tbljobregistration` (`REGISTRATIONID`, `COMPANYID`, `JOBID`, `APPLICANTID`, `APPLICANT`, `REGISTRATIONDATE`, `REMARKS`, `FILEID`, `PENDINGAPPLICATION`, `HVIEW`, `DATETIMEAPPROVED`) VALUES
(1, 2, 2, 2018013, 'Kim Domingo', '2018-05-27 00:00:00', 'Ive seen your work and its really interesting', '2147483647', 0, 1, '2018-05-26 16:13:01'),
(2, 2, 2, 2018015, 'Janry Tan', '2018-05-26 00:00:00', 'aasd', '2147483647', 0, 0, '2018-05-28 14:14:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblkeywords`
--

DROP TABLE IF EXISTS `tblkeywords`;
CREATE TABLE IF NOT EXISTS `tblkeywords` (
  `cod_keyword` int NOT NULL AUTO_INCREMENT,
  `OCUPACIONID` int DEFAULT NULL,
  `keyword` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`cod_keyword`),
  KEY `cod_ocupacion` (`OCUPACIONID`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblkeywords`
--

INSERT INTO `tblkeywords` (`cod_keyword`, `OCUPACIONID`, `keyword`, `fecha_registro`) VALUES
(1, 1, 'Programación', '2022-01-01'),
(2, 1, 'Desarrollo web', '2022-01-02'),
(3, 2, 'Cirugía', '2022-01-03'),
(4, 3, 'Derecho penal', '2022-01-04'),
(5, 12, 'programacion', '2023-05-08'),
(6, 12, 'base de datos', '2023-05-08'),
(7, 12, 'sistemas', '2023-05-08'),
(8, 12, 'desarrollo web', '2023-05-08'),
(9, 12, 'administracion de sistemas', '2023-05-08'),
(10, 12, 'redes', '2023-05-08'),
(11, 12, 'ciberseguridad', '2023-05-08'),
(12, 12, 'tecnologias de la informacion', '2023-05-08'),
(13, 12, 'analisis de sistemas', '2023-05-08'),
(14, 12, 'inteligencia artificial', '2023-05-08'),
(15, 12, 'machine learning', '2023-05-08'),
(16, 12, 'ingenieria de software', '2023-05-08'),
(17, 12, 'proyectos de sistemas', '2023-05-08'),
(18, 12, 'desarrollo movil', '2023-05-08'),
(19, 12, 'ingenieria de datos', '2023-05-08'),
(20, 12, 'tecnologias en la nube', '2023-05-08'),
(21, 12, 'orientada a objetos', '2023-05-08'),
(22, 12, 'programacion funcional', '2023-05-08'),
(23, 12, 'java', '2023-05-08'),
(24, 12, 'python', '2023-05-08'),
(25, 12, 'analista', '2023-05-08'),
(26, 12, 'base de datos', '2023-05-08'),
(27, 12, 'sistemas', '2023-05-08'),
(28, 12, 'desarrollo web', '2023-05-08'),
(29, 12, 'administración de sistemas', '2023-05-08'),
(30, 12, 'redes', '2023-05-08'),
(31, 12, 'ciberseguridad', '2023-05-08'),
(32, 12, 'tecnologías de la información', '2023-05-08'),
(33, 12, 'análisis de sistemas', '2023-05-08'),
(34, 12, 'inteligencia artificial', '2023-05-08'),
(35, 12, 'machine learning', '2023-05-08'),
(36, 12, 'ingeniería de software', '2023-05-08'),
(37, 12, 'proyectos de sistemas', '2023-05-08'),
(38, 12, 'desarrollo móvil', '2023-05-08'),
(39, 12, 'ingeniería de datos', '2023-05-08'),
(40, 12, 'tecnologías en la nube', '2023-05-08'),
(41, 12, 'programación orientada a objetos', '2023-05-08'),
(42, 12, 'programación funcional', '2023-05-08'),
(43, 12, 'programación en Java', '2023-05-08'),
(44, 12, 'programación en Python', '2023-05-08'),
(45, 40, 'abogado', '2023-05-08'),
(46, 40, 'derecho laboral', '2023-05-08'),
(47, 40, 'derecho de la empresa', '2023-05-08'),
(49, 40, 'contratacion publica', '2023-05-08'),
(50, 40, 'pontificia universidad catolica del peru', '2023-05-08'),
(51, 40, 'experiencia en entidades publicas y privadas', '2023-05-08'),
(52, 40, 'ingles', '2023-05-08'),
(53, 40, 'orientacion a resultados', '2023-05-08'),
(54, 40, 'proactividad', '2023-05-08'),
(55, 40, 'derecho', '2023-05-08'),
(56, 40, 'doctorado', '2023-05-08'),
(57, 40, 'diplomado', '2023-05-08'),
(58, 40, 'becario', '2023-05-08'),
(60, 40, 'politica jurisdiccional', '2023-05-08'),
(61, 40, 'bachiller en derecho', '2023-05-08'),
(62, 40, 'licenciado en derecho', '2023-05-08'),
(63, 40, 'docente', '2023-05-08'),
(64, 40, 'etica y ciudadania del derecho', '2023-05-08'),
(65, 40, 'derecho procesal civil', '2023-05-08'),
(66, 40, 'derecho del transporte', '2023-05-08'),
(67, 40, 'derecho minero', '2023-05-08'),
(68, 40, 'responsabilidad social', '2023-05-08'),
(69, 40, 'legislacion laboral', '2023-05-08'),
(70, 40, 'derecho municipal', '2023-05-08'),
(71, 40, 'investigacion cientifica', '2023-05-08'),
(72, 40, 'derecho individual del trabajo', '2023-05-08'),
(73, 40, 'derecho colectivo del trabajo', '2023-05-08'),
(74, 40, 'derecho procesal del trabajo', '2023-05-08'),
(75, 40, 'planeamiento empresarial', '2023-05-08'),
(76, 40, 'acceso y salida al mercado', '2023-05-08'),
(77, 40, 'derecho bursatil', '2023-05-08'),
(78, 40, 'teoria de la negociacion', '2023-05-08'),
(79, 40, 'derecho previsional', '2023-05-08'),
(80, 40, 'tecnicas de litigacion oral', '2023-05-08'),
(81, 40, 'derecho de la competencia', '2023-05-08'),
(82, 40, 'propiedad intelectual', '2023-05-08'),
(83, 40, 'practica procesal civil', '2023-05-08'),
(84, 40, 'planeamiento de negocios', '2023-05-08'),
(85, 40, 'universidad', '2023-05-08'),
(86, 40, 'cesar vallejo', '2023-05-08'),
(87, 40, 'secretario academico', '2023-05-08'),
(88, 40, 'abogado', '2023-05-08'),
(89, 40, 'facultad de derecho', '2023-05-08'),
(90, 40, 'liderazgo', '2023-05-08'),
(91, 40, 'maestria', '2023-05-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblocupaciones`
--

DROP TABLE IF EXISTS `tblocupaciones`;
CREATE TABLE IF NOT EXISTS `tblocupaciones` (
  `OCUPACIONID` int NOT NULL AUTO_INCREMENT,
  `OCUPACION` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `AREAID` int NOT NULL,
  `FECHAREGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OCUPACIONSTATUS` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`OCUPACIONID`),
  KEY `AREAID` (`AREAID`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblocupaciones`
--

INSERT INTO `tblocupaciones` (`OCUPACIONID`, `OCUPACION`, `AREAID`, `FECHAREGISTRO`, `OCUPACIONSTATUS`) VALUES
(1, 'Inspector de calidad\n', 31, '2023-05-05 00:00:00', 1),
(2, 'Analista de laboratorio\n', 31, '2023-05-05 00:00:00', 1),
(3, 'Especialista en aseguramiento de calidad\n', 31, '2023-05-05 00:00:00', 1),
(4, 'Coordinador de control de calidad\n', 31, '2023-05-05 00:00:00', 1),
(5, 'Analista de investigación de mercados\n', 32, '2023-05-05 00:00:00', 1),
(6, 'Investigador de mercados internacionales\n', 32, '2023-05-05 00:00:00', 1),
(7, 'Especialista en análisis de datos\n', 32, '2023-05-05 00:00:00', 1),
(8, 'Consultor de investigación de mercados\n', 32, '2023-05-05 00:00:00', 1),
(9, 'Gerente de almacén\n', 33, '2023-05-05 00:00:00', 1),
(10, 'Supervisor de inventario\n', 33, '2023-05-05 00:00:00', 1),
(11, 'Coordinador de logística de almacén\n', 33, '2023-05-05 00:00:00', 1),
(12, 'Operador de montacargas\n', 33, '2023-05-05 00:00:00', 1),
(13, 'Ingeniero de desarrollo de productos\n', 34, '2023-05-05 00:00:00', 1),
(14, 'Diseñador de productos\n', 34, '2023-05-05 00:00:00', 1),
(15, 'Especialista en investigación y desarrollo de alimentos\n', 34, '2023-05-05 00:00:00', 1),
(16, 'Gerente de desarrollo de productos\n', 34, '2023-05-05 00:00:00', 1),
(17, 'Gerente de Operaciones', 1, '2023-05-05 00:00:00', 1),
(18, 'Supervisor de Producción', 1, '2023-05-05 00:00:00', 1),
(19, 'Coordinador de Logística', 1, '2023-05-05 00:00:00', 1),
(20, 'Analista de Procesos', 1, '2023-05-05 00:00:00', 1),
(21, 'Encargado de gestión del talento', 2, '2023-05-05 00:00:00', 1),
(22, 'Agente de Seguridad Patrimonial', 8, '2023-05-05 00:00:00', 0),
(23, 'Personal de Limpieza ', 10, '2023-05-05 00:00:00', 0),
(24, 'Prevencionista de Seguridad Industrial Senior', 8, '2023-05-05 00:00:00', 0),
(25, 'Conductor de Semitrailer', 9, '2023-05-05 00:00:00', 0),
(26, 'Reparador de Calderas', 4, '2023-05-05 00:00:00', 0),
(27, 'Técnico en Mantenimiento de Maquinas', 4, '2023-05-05 00:00:00', 0),
(28, 'Técnico electromecánico', 4, '2023-05-05 00:00:00', 0),
(29, 'Ayudante/Operario para el área de Calidad', 2, '2023-05-05 00:00:00', 1),
(30, 'Auxiliar de mantenimiento de campamento', 4, '2023-05-05 00:00:00', 0),
(31, 'Auxiliar de atención al personal', 11, '2023-05-05 00:00:00', 0),
(32, 'Operador del Centro de Monitoreo', 8, '2023-05-05 00:00:00', 0),
(33, 'Operador de Montacargas', 12, '2023-05-05 00:00:00', 0),
(34, 'Operador Apilador', 12, '2023-05-05 00:00:00', 0),
(35, 'Operador de calderas', 12, '2023-05-05 00:00:00', 0),
(36, 'Técnico Frigorista Industrial', 13, '2023-05-05 00:00:00', 0),
(37, 'Jefe de Recursos Humanos', 1, '2023-05-06 00:00:00', 0),
(38, 'Operario mecánico o electromecánico ', 4, '2023-05-06 00:00:00', 0),
(39, 'Coordinador de Operaciones Sector Eléctrico', 4, '2023-05-06 00:00:00', 0),
(40, 'Abogado', 14, '2023-05-08 00:00:00', 0),
(41, 'Desarrollador de software', 7, '2023-05-09 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblprofesiones`
--

DROP TABLE IF EXISTS `tblprofesiones`;
CREATE TABLE IF NOT EXISTS `tblprofesiones` (
  `cod_profesion` int NOT NULL AUTO_INCREMENT,
  `profesion` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`cod_profesion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblprofesiones`
--

INSERT INTO `tblprofesiones` (`cod_profesion`, `profesion`, `fecha_registro`) VALUES
(2, 'Ingeniero de sistemas', '2023-04-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpuestos`
--

DROP TABLE IF EXISTS `tblpuestos`;
CREATE TABLE IF NOT EXISTS `tblpuestos` (
  `cod_puesto` int NOT NULL AUTO_INCREMENT,
  `puesto` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`cod_puesto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblpuestos`
--

INSERT INTO `tblpuestos` (`cod_puesto`, `puesto`, `estado`) VALUES
(1, 'Comunicadora de area', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblrequerimientos`
--

DROP TABLE IF EXISTS `tblrequerimientos`;
CREATE TABLE IF NOT EXISTS `tblrequerimientos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `profesion` int NOT NULL,
  `palabra_clave` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`),
  KEY `profesion` (`profesion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblrequerimientos`
--

INSERT INTO `tblrequerimientos` (`id`, `profesion`, `palabra_clave`, `descripcion`) VALUES
(1, 2, 'Prueba', 'Prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbltipocontrato`
--

DROP TABLE IF EXISTS `tbltipocontrato`;
CREATE TABLE IF NOT EXISTS `tbltipocontrato` (
  `TCONTRATOID` int NOT NULL AUTO_INCREMENT,
  `TIPOCONTRATO` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `CONTENIDO` text COLLATE utf8mb4_general_ci NOT NULL,
  `ESTADO` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`TCONTRATOID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbltipocontrato`
--

INSERT INTO `tbltipocontrato` (`TCONTRATOID`, `TIPOCONTRATO`, `CONTENIDO`, `ESTADO`) VALUES
(1, 'Contrato laboral por tiempo determinado', '<p><b>CONTRATO POR TIEMPO DETERMINADO</b></p><p><br></p><p>En la ciudad de [Ciudad], a [Fecha de inicio del contrato]</p><p><br></p><p>Entre la empresa Gandules Inc SAC, con RUC [RUC de la empresa], con domicilio en [Dirección de la empresa], representada por [Nombre del representante legal], en adelante denominada \\\"la Empresa\\\", por una parte, y el señor/señora [Nombre completo del trabajador], con DNI [Número de DNI], con domicilio en [Dirección del trabajador], en adelante denominado/a \\\"el Trabajador\\\", por la otra parte, se celebra el presente contrato de trabajo por tiempo determinado, de conformidad con las siguientes cláusulas:</p><p><b style=\\\"background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\\\"><i><br></i></b></p><p><b style=\\\"background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\\\"><i>1. Objeto del contrato:</i></b></p><p>La Empresa contrata al Trabajador para desempeñar el cargo de [Cargo del Trabajador] en el área de [Área del Trabajador] durante un periodo determinado desde [Fecha de inicio del contrato] hasta [Fecha de finalización del contrato].</p><p><b style=\\\"background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\\\"><i><br></i></b></p><p><b style=\\\"background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\\\"><i>2. Obligaciones del Trabajador:</i></b></p><p>El Trabajador se compromete a cumplir con las siguientes obligaciones:</p><p><br></p><ul><li>Realizar las tareas y funciones correspondientes a su cargo de manera eficiente y profesional.</li><li>Cumplir con los horarios establecidos por la Empresa y acatar las normas internas de la misma.</li><li>Mantener la confidencialidad de la información y los secretos comerciales de la Empresa.</li></ul><p><b><i>3. Jornada laboral:</i></b></p><p>La jornada laboral del Trabajador será de [Número de horas] horas semanales, distribuidas de acuerdo con los horarios establecidos por la Empresa.</p><p><br></p><p><b><i>4. Remuneración:</i></b></p><p>La Empresa pagará al Trabajador una remuneración mensual de [Monto de la remuneración], la cual será abonada en [Frecuencia de pago] pagos mensuales.</p><p><br></p><p><b><i>5. Beneficios:</i></b></p><p>El Trabajador tendrá derecho a los beneficios establecidos por la legislación laboral vigente y por las políticas internas de la Empresa.</p><p><br></p><p><b><i>6. Confidencialidad:</i></b></p><p>El Trabajador se compromete a mantener la confidencialidad de la información y los secretos comerciales de la Empresa durante y después de la vigencia de este contrato.</p><p><br></p><p><b><i>7. Causales de terminación:</i></b></p><p>El presente contrato se considerará terminado en las siguientes situaciones:</p><p><br></p><ul><li>Vencimiento del plazo establecido en este contrato.</li><li>Por mutuo acuerdo entre ambas partes.</li><li>Por incumplimiento grave de alguna de las obligaciones establecidas en este contrato.</li></ul><p><b><i>8. Ley aplicable y jurisdicción:</i></b></p><p>Este contrato se regirá por las leyes de [País]. Cualquier controversia que surja en relación con este contrato será sometida a la jurisdicción de los tribunales competentes de [Ciudad].</p><p>En prueba de conformidad, ambas partes firman el presente contrato en dos ejemplares, en la fecha y lugar indicados al comienzo del contrato.</p><p><br></p><p><u>[Nombre del representante legal]</u></p><p><b>Gandules Inc SAC</b></p><p><br></p><p><u>[Nombre completo del trabajador]</u></p><p><b>Por el Trabajador</b></p><p><br></p><p><u>Fecha: [Fecha de firma del contrato]</u></p>', 1),
(2, 'Contrato laboral por tiempo indeterminado', '<p><b>CONTRATO LABORAL POR TIEMPO INDETERMINADO</b></p><p><br></p><p>En la ciudad de [Ciudad], a [Fecha de inicio del contrato]</p><p><br></p><p>Entre la empresa Gandules Inc SAC, con RUC [RUC de la empresa], con domicilio en [Dirección de la empresa], representada por [Nombre del representante legal], en adelante denominada \\\"la Empresa\\\", por una parte, y el señor/señora [Nombre completo del trabajador], con DNI [Número de DNI], con domicilio en [Dirección del trabajador], en adelante denominado/a \\\"el Trabajador\\\", por la otra parte, se celebra el presente contrato de trabajo por tiempo indeterminado, de conformidad con las siguientes cláusulas:</p><p><br></p><p><b>1. Objeto del contrato:</b></p><p>La Empresa contrata al Trabajador para desempeñar el cargo de [Cargo del Trabajador] en el área de [Área del Trabajador].</p><p><br></p><p><b>2. Obligaciones del Trabajador:</b></p><p>El Trabajador se compromete a cumplir con las siguientes obligaciones:</p><ul><li>Realizar las tareas y funciones correspondientes a su cargo de manera eficiente y profesional.</li><li>Cumplir con los horarios establecidos por la Empresa y acatar las normas internas de la misma.</li><li>Mantener la confidencialidad de la información y los secretos comerciales de la Empresa.</li><li>Cumplir con todas las demás obligaciones establecidas por la legislación laboral vigente y las políticas internas de la Empresa.</li></ul><p><b>3. Jornada laboral:</b></p><p>La jornada laboral del Trabajador será de [Número de horas] horas semanales, distribuidas de acuerdo con los horarios establecidos por la Empresa.</p><p><br></p><p><b>4. Remuneración:</b></p><p>La Empresa pagará al Trabajador una remuneración mensual de [Monto de la remuneración], la cual será abonada en [Frecuencia de pago] pagos mensuales.</p><p><br></p><p><b>5. Beneficios:</b></p><p>El Trabajador tendrá derecho a los beneficios establecidos por la legislación laboral vigente y por las políticas internas de la Empresa, los cuales podrán incluir, entre otros, seguro médico, seguro de vida, y subsidios.</p><p><br></p><p><b>6. Período de prueba:</b></p><p>Se establece un período de prueba de [Duración del período de prueba] a partir de la fecha de inicio del contrato. Durante este período, ambas partes podrán dar por terminado el contrato sin necesidad de preaviso ni indemnización.</p><p><br></p><p><b>7. Confidencialidad:</b></p><p>El Trabajador se compromete a mantener la confidencialidad de la información y los secretos comerciales de la Empresa durante y después de la vigencia de este contrato.</p><p><br></p><p><b>8. Causales de terminación:</b></p><p>El presente contrato podrá ser terminado en las siguientes situaciones:</p><p><br></p><ul><li>Por decisión unilateral de cualquiera de las partes, previo aviso escrito con una anticipación mínima de [Período de preaviso] días.</li><li>Por incumplimiento grave de alguna de las obligaciones establecidas en este contrato.</li><li>Por causas previstas por la legislación laboral vigente.</li></ul><p><b>9. Ley aplicable y jurisdicción:</b></p><p>Este contrato se regirá por las leyes de [País]. Cualquier controversia que surja en relación con este contrato será sometida a la jurisdicción de los tribunales competentes de [Ciudad</p>', 1),
(3, 'Contrato laboral temporal', '<p><br></p>', 1),
(4, 'Contrato para capacitación inicial', '<p><br></p>', 1),
(5, 'Contrato de periodo de prueba', '<p><br></p>', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusers`
--

DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE IF NOT EXISTS `tblusers` (
  `USERID` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `FULLNAME` varchar(40) NOT NULL,
  `USERNAME` varchar(90) NOT NULL,
  `CORREO` varchar(150) NOT NULL,
  `DNI` varchar(10) NOT NULL,
  `TELEFONO` varchar(10) NOT NULL,
  `PASS` varchar(90) NOT NULL,
  `ROLE` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `FOTO` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `CREATEAT` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`USERID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblusers`
--

INSERT INTO `tblusers` (`USERID`, `FULLNAME`, `USERNAME`, `CORREO`, `DNI`, `TELEFONO`, `PASS`, `ROLE`, `FOTO`, `CREATEAT`) VALUES
('1', 'admin', 'Eve', 'admin@gmail.com', '3232323', '98989899', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 'photos/Koala.jpg', '2023-05-02 00:46:19'),
('2', 'admin', 'root', 'root@gmail.com', '71574122', '965208467', '$2y$10$zIZRLiAGHVLHbDMFDdafxO.F6ZPFzORE0OS68hjYFEfzVE3i0.7sm', 'Administrador', 'photos/Koala.jpg', '2023-05-02 00:46:19');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD CONSTRAINT `tblemployees_ibfk_5` FOREIGN KEY (`COMPANYID`) REFERENCES `tblcompany` (`COMPANYID`),
  ADD CONSTRAINT `tblemployees_ibfk_6` FOREIGN KEY (`AREAID`) REFERENCES `tblareas` (`AREAID`),
  ADD CONSTRAINT `tblemployees_ibfk_7` FOREIGN KEY (`OCUPACIONID`) REFERENCES `tblocupaciones` (`OCUPACIONID`),
  ADD CONSTRAINT `tblemployees_ibfk_8` FOREIGN KEY (`COMPANYID`) REFERENCES `tblcompany` (`COMPANYID`);

--
-- Filtros para la tabla `tblkeywords`
--
ALTER TABLE `tblkeywords`
  ADD CONSTRAINT `tblkeywords_ibfk_1` FOREIGN KEY (`OCUPACIONID`) REFERENCES `tblocupaciones` (`OCUPACIONID`);

--
-- Filtros para la tabla `tblrequerimientos`
--
ALTER TABLE `tblrequerimientos`
  ADD CONSTRAINT `tblrequerimientos_ibfk_1` FOREIGN KEY (`profesion`) REFERENCES `tblprofesiones` (`cod_profesion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
