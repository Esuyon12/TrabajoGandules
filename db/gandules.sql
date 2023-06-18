-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2023 a las 02:10:45
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

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
-- Estructura de tabla para la tabla `tblapplicants`
--

CREATE TABLE `tblapplicants` (
  `APPLICANTID` int(11) NOT NULL,
  `DNI` int(11) NOT NULL,
  `FNAME` varchar(90) NOT NULL,
  `LNAME` varchar(90) NOT NULL,
  `MNAME` varchar(90) NOT NULL,
  `EMAILADDRESS` varchar(90) NOT NULL,
  `CONTACTNO` varchar(90) NOT NULL,
  `CVFILE` varchar(100) NOT NULL,
  `COMPANYID` int(11) NOT NULL,
  `JOBID` int(11) NOT NULL,
  `STATE` int(11) NOT NULL DEFAULT 0,
  `POINTS` int(11) NOT NULL,
  `DATEADD` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tblapplicants`
--

INSERT INTO `tblapplicants` (`APPLICANTID`, `DNI`, `FNAME`, `LNAME`, `MNAME`, `EMAILADDRESS`, `CONTACTNO`, `CVFILE`, `COMPANYID`, `JOBID`, `STATE`, `POINTS`, `DATEADD`) VALUES
(1, 71574122, 'OLIVER', 'DELGADO', 'GONZALES', 'suyonlisseth@gmail.com', '123457892', '13062023114231cv.pdf', 3, 3, 0, 0, '2023-06-14 04:42:31'),
(2, 73902466, 'EVELYN LISSETH', 'SUYON', 'YAMUNAQUE', 'suyonlisseth@gmail.com', '123456789', '13062023114335cv.pdf', 1, 1, 0, 0, '2023-06-14 04:43:35'),
(3, 17591502, 'YSABEL', 'YAMUNAQUE', 'SANTOYO', 'suyonlisseth@gmail.com', '123456789', '13062023114357cv.pdf', 1, 1, 0, 0, '2023-06-14 04:43:57'),
(4, 73902411, 'MARGOT', 'MEZA', 'CHAUCA', 'suyonlisseth@gmail.com', '123456789', '13062023114419cv.pdf', 1, 1, 0, 0, '2023-06-14 04:44:19'),
(5, 73903466, 'EDWIN', 'CHAISA', 'HUARACHA', 'suyonlisseth@gmail.com', '123456789', '13062023115741cv.pdf', 1, 1, 0, 0, '2023-06-14 04:57:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblareas`
--

CREATE TABLE `tblareas` (
  `AREAID` int(11) NOT NULL,
  `AREA` varchar(255) NOT NULL,
  `FECHAREGISTRO` timestamp NOT NULL DEFAULT current_timestamp(),
  `ESTADO` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblareas`
--

INSERT INTO `tblareas` (`AREAID`, `AREA`, `FECHAREGISTRO`, `ESTADO`) VALUES
(1, 'Área de Operaciones\n', '2023-05-05 00:00:00', 1),
(2, 'Área de Ventas y Comercialización\n', '2023-05-05 00:00:00', 0),
(3, 'Área de Servicio al Cliente\n', '2023-05-05 00:00:00', 1),
(4, 'Área de Investigación y Desarrollo (I+D)\n', '2023-05-05 00:00:00', 1),
(5, 'Área de Marketing y Publicidad\n', '2023-05-05 00:00:00', 0),
(6, 'Área de Recursos Humanos y Gestión del Talento\n', '2023-05-05 00:00:00', 0),
(7, 'Área de Finanzas y Contabilidad\n', '2023-05-05 00:00:00', 0),
(8, 'Área Legal y Cumplimiento\n', '2023-05-05 00:00:00', 0),
(9, 'Área de Tecnología de la Información (TI) o Sistemas\n', '2023-05-05 00:00:00', 0),
(10, 'Área de Calidad y Mejora Continua\n', '2023-05-05 00:00:00', 0),
(11, 'Área de Compras y Abastecimiento\n', '2023-05-05 00:00:00', 0),
(12, 'Área de Producción y Operaciones\n', '2023-05-05 00:00:00', 0),
(13, 'Área de Logística y Distribución\n', '2023-05-05 00:00:00', 0),
(14, 'Área de Desarrollo de Negocios y Expansión\n', '2023-05-08 00:00:00', 1),
(15, 'Área de Relaciones Públicas y Comunicación', '2023-05-20 21:07:38', 0),
(16, 'Área de Responsabilidad Social Corporativa', '2023-05-20 21:07:44', 0),
(17, 'Área de Gestión de Proyectos', '2023-05-20 21:07:57', 0),
(18, 'Área de Seguridad y Salud Laboral', '2023-05-20 21:08:03', 1),
(19, 'Área de Investigación de Mercado', '2023-05-20 21:08:12', 0),
(20, 'Área de Innovación y Desarrollo Tecnológico', '2023-05-20 21:08:19', 0),
(21, 'Área de Planificación Estratégica', '2023-05-20 21:08:26', 0),
(22, 'Área de Administración de Riesgos', '2023-05-20 21:08:31', 0),
(23, 'Área de Desarrollo Sostenible y Medio Ambiente', '2023-05-20 21:08:36', 0),
(24, 'Área de Contabilidad y Finanzas', '2023-05-20 21:08:42', 1),
(25, 'Área de Desarrollo Organizacional', '2023-05-20 21:08:50', 1),
(26, 'Área de Gestión Ambiental y Sostenibilidad', '2023-05-20 21:08:56', 0),
(27, 'Área de Relaciones Institucionales', '2023-05-20 21:09:03', 0),
(28, 'Área de Cumplimiento y Legal', '2023-05-20 21:09:12', 1),
(29, 'Área de Análisis de Datos y Business Intelligence', '2023-05-20 21:09:19', 1),
(30, 'Área de Gestión del Cambio', '2023-05-20 21:09:27', 0),
(31, 'Área de Control de Calidad', '2023-05-20 21:11:51', 1),
(32, 'Área de Investigación de Mercados Internacionales', '2023-05-20 21:14:13', 0),
(33, 'Área de Gestión de Almacenes', '2023-05-20 21:15:52', 1),
(34, 'Área de Desarrollo de Productos y Servicios', '2023-05-20 21:17:16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblautonumbers`
--

CREATE TABLE `tblautonumbers` (
  `AUTOID` int(11) NOT NULL,
  `AUTOSTART` varchar(30) NOT NULL,
  `AUTOEND` int(11) NOT NULL,
  `AUTOINC` int(11) NOT NULL,
  `AUTOKEY` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
-- Estructura de tabla para la tabla `tblcompany`
--

CREATE TABLE `tblcompany` (
  `COMPANYID` int(11) NOT NULL,
  `COMPANYNAME` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `COMPANYADDRESS` varchar(90) NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `COMPANYSTATUS` int(11) NOT NULL DEFAULT 0,
  `FECHAREGISTRO` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tblcompany`
--

INSERT INTO `tblcompany` (`COMPANYID`, `COMPANYNAME`, `COMPANYADDRESS`, `DESCRIPCION`, `COMPANYSTATUS`, `FECHAREGISTRO`) VALUES
(1, 'Gandules Inc Sac', 'La Viña, Perú.', 'GANDULES INC es una corporación fundada en el año 2002 con capitales privados y con muchos años de experiencia dedicados al manejo de tierras con fines agrícolas en los valles de Jayanca y San Pedro demostrando de esta manera un profundo compromiso con el desarrollo agroindustrial del Perú. Somos reconocidos en la actualidad tanto en el ámbito nacional como internacional como una de las empresas más importantes del sector agroindustrial del Perú, que ha sabido integrar totalmente sus operaciones productivas y la exportación de sus productos a clientes en más de 45 países dentro de 3 principales líneas de negocio: Conservas, Congelados y Frescos.', 1, '2023-05-05 00:00:00'),
(2, 'Niño Jesus', 'Jayanca, Perú.', '', 1, '2023-05-05 00:00:00'),
(3, 'San Judas', 'Jayanca, Perú.', '', 1, '2023-05-05 00:00:00'),
(4, 'El roble', 'Jayanca, Perú.', '', 0, '2023-05-05 00:00:00'),
(5, 'Fundo Nombre', 'Jayanca, Perú.', '', 0, '2023-05-05 00:00:00'),
(10, 'Sede de prueba', 'Direccion de prueba ', 'Hola', 1, '2023-06-17 23:51:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcorreo`
--

CREATE TABLE `tblcorreo` (
  `CORREOID` int(11) NOT NULL,
  `ASUNTO` varchar(100) NOT NULL,
  `CONTENIDO` text NOT NULL,
  `ESTADO` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblcorreo`
--

INSERT INTO `tblcorreo` (`CORREOID`, `ASUNTO`, `CONTENIDO`, `ESTADO`) VALUES
(1, 'PROCESO DE EVALUACIÓN GANDULES / REVISIÓN DE CV', '<p>Estimado/a [Nombre del solicitante],</p><p><br></p><p>Nos complace informarle que hemos recibido y revisado su solicitud de trabajo para el puesto de [Puesto de trabajo]. Después de evaluar su currículum, nos complace comunicarle que cumple con la mayoría de los requisitos establecidos para el puesto, lo cual nos ha generado un interés especial en su perfil.</p><p>Con el objetivo de avanzar en el proceso de selección, nos gustaría solicitarle que complete una evaluación que nos permitirá poner a prueba sus habilidades y conocimientos relacionados con el puesto al que está aplicando. La evaluación ha sido diseñada para brindarnos una mejor comprensión de su idoneidad para el puesto.</p><p><br></p><p>Para acceder a la evaluación, por favor utilice el siguiente enlace: [Enlace de evaluación].</p><p><br></p><p>Dentro de la evaluación encontrará indicaciones importantes que le pedimos que siga detenidamente. Si tiene alguna pregunta o inquietud, no dude en ponerse en contacto con nosotros. Estaremos encantados de ayudarle en cualquier aspecto relacionado con el proceso de selección.</p><p>Agradecemos su interés en formar parte de nuestra empresa y esperamos contar con su participación en la evaluación.</p><p><br></p><p>Atentamente,</p><p>[Nombre de la empresa]</p>', 1),
(2, 'PROCESO DE EVALUACIÓN GANDULES / REVISIÓN DE EVALUACIÓN', '<p>Estimado/a [Nombre del aplicante],</p><p><br></p><p>Me complace informarte que has superado exitosamente el examen como parte del proceso de selección para el puesto de [Nombre de la ocupación] en nuestra empresa.</p><p><br></p><p>¡Felicitaciones! Tus resultados demuestran un sólido conocimiento y habilidades destacadas en el área, lo cual nos ha dejado una impresión positiva.</p><p><br></p><p>Queremos destacar que tu desempeño fue excelente y cumples con los requisitos necesarios para avanzar en el proceso de selección. En este sentido, nos gustaría invitarte a una entrevista personal en nuestras instalaciones. Durante esta entrevista, tendrás la oportunidad de conocer más sobre nuestra empresa, nuestro equipo de trabajo y los detalles específicos del puesto al que estás aplicando.</p><p><br></p><p>A continuación, te proporcionamos la fecha y horario para tu presentación:</p><p><br></p><p>Fecha: [Fecha de la presentación]</p><p>Hora: [Hora de la presentación]</p><p>Lugar: [Dirección de nuestra empresa]</p><p><br></p><p>Si tienes alguna pregunta o necesitas más información, no dudes en contactarnos. Estamos aquí para ayudarte.</p><p><br></p><p><strong>¡Nos vemos pronto y te esperamos con entusiasmo!</strong></p><p><br></p><p>Atentamente,</p><p>[Nombre de la empresa]</p>', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcreaevaluaciones`
--

CREATE TABLE `tblcreaevaluaciones` (
  `IDEVALUACIONCREA` int(11) NOT NULL,
  `OCUPACIONID` int(11) NOT NULL,
  `TITULO` varchar(100) NOT NULL,
  `TAREA` text NOT NULL,
  `INDICACIONES` text NOT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT 0,
  `FECHAREGISTRO` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblcreaevaluaciones`
--

INSERT INTO `tblcreaevaluaciones` (`IDEVALUACIONCREA`, `OCUPACIONID`, `TITULO`, `TAREA`, `INDICACIONES`, `ESTADO`, `FECHAREGISTRO`) VALUES
(1, 42, 'Evaluación para el puesto de atención al cliente', '<h3><strong>¿Cuál es tu enfoque principal al interactuar con los clientes?</strong></h3><h3><strong>¿Cómo manejas las situaciones difíciles o clientes insatisfechos?</strong></h3><h3><strong>¿Cómo te mantienes actualizado sobre los productos/servicios de la empresa?</strong></h3><h3><strong>¿Cómo manejas múltiples tareas o solicitudes de clientes al mismo tiempo?</strong></h3><h3><strong>¿Cómo manejas los clientes que no hablan el idioma nativo?</strong></h3><p><br></p>', '- Lee cuidadosamente cada pregunta antes de responder. Asegúrate de entender completamente lo que se te está preguntando antes de proporcionar tu respuesta.\\n- Tómate tu tiempo para reflexionar antes de responder. No te apresures en dar una respuesta. Piensa en ejemplos relevantes de tu experiencia previa que puedas utilizar para respaldar tus respuestas.\\n- Sé claro y conciso en tus respuestas. Utiliza un lenguaje claro y evita respuestas demasiado largas o ambiguas. Sé directo y enfócate en brindar información relevante y precisa', 1, '2023-05-31 21:25:51'),
(2, 43, 'Evaluación para el puesto de prevención de riesgos laborales', '<ol><li><strong>Describe el proceso que seguirías para identificar y evaluar los riesgos laborales en un nuevo entorno de trabajo.</strong></li><li><strong>¿Cuál es tu enfoque para desarrollar e implementar programas de capacitación en seguridad y salud laboral para los empleados?</strong></li><li><strong>¿Cómo abordarías una situación en la que un trabajador no cumple con las medidas de seguridad establecidas?</strong></li><li><strong>Explique la importancia de llevar a cabo inspecciones regulares en el lugar de trabajo y cómo lo llevarías a cabo.</strong></li><li><strong>¿Cómo mantienes actualizado tu conocimiento sobre las leyes y regulaciones relacionadas con la seguridad y salud laboral?</strong></li></ol><p><br></p>', '- Proporciona instrucciones claras: Asegúrate de que las preguntas estén formuladas de manera clara y precisa, de modo que los candidatos entiendan claramente lo que se les está preguntando. Si es necesario, proporciona ejemplos o escenarios adicionales para ayudar a contextualizar las preguntas.\\n\\n- Evalúa el conocimiento teórico y las habilidades prácticas: Diseña preguntas que evalúen tanto el conocimiento teórico como las habilidades prácticas del candidato en el campo de la seguridad y salud laboral. Puedes incluir preguntas teóricas sobre regulaciones y procedimientos, así como situaciones prácticas en las que los candidatos deben demostrar su capacidad para identificar y resolver problemas relacionados con la seguridad y salud en el lugar de trabajo.', 1, '2023-05-31 21:27:39'),
(3, 44, 'Asistente contable', '<h2>Pregunta 1</h2><h2>Pregunta 2</h2><h2>Pregunta 3</h2><h2>Pregunta 4</h2><h2>Pregunta 5</h2><p><br></p>', 'Inidicaciones\\nAsistente contable', 1, '2023-05-31 21:59:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblemployees`
--

CREATE TABLE `tblemployees` (
  `INCID` int(11) NOT NULL,
  `APLICANTID` int(11) NOT NULL,
  `AREAID` int(11) NOT NULL,
  `OCUPACIONID` int(11) NOT NULL,
  `DATEHIRED` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `COMPANYID` int(11) NOT NULL,
  `CONTRATO` text NOT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tblemployees`
--

INSERT INTO `tblemployees` (`INCID`, `APLICANTID`, `AREAID`, `OCUPACIONID`, `DATEHIRED`, `COMPANYID`, `CONTRATO`, `ESTADO`) VALUES
(2, 3, 3, 42, '2023-05-31 19:58:32', 1, '', 0),
(3, 8, 24, 44, '2023-05-31 22:07:57', 1, '', 0),
(4, 7, 3, 42, '2023-06-01 13:32:34', 1, '', 0),
(5, 4, 18, 43, '2023-06-02 06:40:12', 1, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblevaluaciones`
--

CREATE TABLE `tblevaluaciones` (
  `EVALUACIONID` int(11) NOT NULL,
  `APPLICANTID` int(11) DEFAULT NULL,
  `TOKEN` varchar(390) DEFAULT NULL,
  `IDEVALUACIONCREA` text DEFAULT NULL,
  `RESULT` int(11) NOT NULL,
  `OCUPACIONID` int(11) NOT NULL,
  `AREAID` int(11) NOT NULL,
  `MSG` int(11) NOT NULL DEFAULT 0,
  `RESPUESTA` text NOT NULL,
  `DATE_END` datetime DEFAULT NULL,
  `DATE_IN` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblevaluaciones`
--

INSERT INTO `tblevaluaciones` (`EVALUACIONID`, `APPLICANTID`, `TOKEN`, `IDEVALUACIONCREA`, `RESULT`, `OCUPACIONID`, `AREAID`, `MSG`, `RESPUESTA`, `DATE_END`, `DATE_IN`) VALUES
(1, 4, 'eyJzdGFydCI6MTY4NTY4MjAwMCwiZXhwIjoxNjg2OTc4MDAwLCJBUFBMSUNBTlRJRCI6IjQiLCJJREVWQUxVQUNJT05DUkVBIjoiMiIsIkRBVEVfU1RBUlQiOiIyMDIzLTA2LTAyIiwiREFURV9PVVQiOiIyMDIzLTA2LTE3IiwiRVZBTFVBQ0lPTklEIjoxfQ==.99852a923b62901cc1480c5fe85278724422a7ccfed6741fd74778a99dce42d9', '2', 20, 43, 18, 1, '<p>- Proporciona instrucciones claras: Asegúrate de que las preguntas estén formuladas de manera clara y precisa, de modo que los candidatos entiendan claramente lo que se les está preguntando. Si es necesario, proporciona ejemplos o escenarios adicionales para ayudar a contextualizar las preguntas.nn- Evalúa el conocimiento teórico y las habilidades prácticas: Diseña preguntas que evalúen tanto el conocimiento teórico como las habilidades prácticas del candidato en el campo de la seguridad y salud laboral. Puedes incluir preguntas teóricas sobre regulaciones y procedimientos, así como situaciones prácticas en las que los candidatos deben demostrar su capacidad para identificar y resolver problemas relacionados con la seguridad y salud en el lugar de trabajo.- Proporciona instrucciones claras: Asegúrate de que las preguntas estén formuladas de manera clara y precisa, de modo que los candidatos entiendan claramente lo que se les está preguntando. Si es necesario, proporciona ejemplos o escenarios adicionales para ayudar a contextualizar las preguntas.nn- Evalúa el conocimiento teórico y las habilidades prácticas: Diseña preguntas que evalúen tanto el conocimiento teórico como las habilidades prácticas del candidato en el campo de la seguridad y salud laboral. Puedes incluir preguntas teóricas sobre regulaciones y procedimientos, así como situaciones prácticas en las que los candidatos deben demostrar su capacidad para identificar y resolver problemas relacionados con la seguridad y salud en el lugar de trabajo.- Proporciona instrucciones claras: Asegúrate de que las preguntas estén formuladas de manera clara y precisa, de modo que los candidatos entiendan claramente lo que se les está preguntando. Si es necesario, proporciona ejemplos o escenarios adicionales para ayudar a contextualizar las preguntas.nn- Evalúa el conocimiento teórico y las habilidades prácticas: Diseña preguntas que evalúen tanto el conocimiento teórico como las habilidades prácticas del candidato en el campo de la seguridad y salud laboral. Puedes incluir preguntas teóricas sobre regulaciones y procedimientos, así como situaciones prácticas en las que los candidatos deben demostrar su capacidad para identificar y resolver problemas relacionados con la seguridad y salud en el lugar de trabajo.- Proporciona instrucciones claras: Asegúrate de que las preguntas estén formuladas de manera clara y precisa, de modo que los candidatos entiendan claramente lo que se les está preguntando. Si es necesario, proporciona ejemplos o escenarios adicionales para ayudar a contextualizar las preguntas.nn- Evalúa el conocimiento teórico y las habilidades prácticas: Diseña preguntas que evalúen tanto el conocimiento teórico como las habilidades prácticas del candidato en el campo de la seguridad y salud laboral. Puedes incluir preguntas teóricas sobre regulaciones y procedimientos, así como situaciones prácticas en las que los candidatos deben demostrar su capacidad para identificar y resolver problemas relacionados con la seguridad y salud en el lugar de trabajo.</p>', '2023-06-02 01:36:40', '2023-06-02 00:36:40'),
(2, 6, 'eyJzdGFydCI6MTY4NTY4MjAwMCwiZXhwIjoxNjg3NTgyODAwLCJBUFBMSUNBTlRJRCI6IjYiLCJJREVWQUxVQUNJT05DUkVBIjoiMiIsIkRBVEVfU1RBUlQiOiIyMDIzLTA2LTAyIiwiREFURV9PVVQiOiIyMDIzLTA2LTI0IiwiRVZBTFVBQ0lPTklEIjoyfQ==.e55d0deb57a51b3c8b27476d4046f633a8c8b300ce2e23a1e462d7d3ea49cba7', '2', 0, 43, 18, 0, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblindicacioneseva`
--

CREATE TABLE `tblindicacioneseva` (
  `INDICACIONID` int(11) NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `ESTADO` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblindicacioneseva`
--

INSERT INTO `tblindicacioneseva` (`INDICACIONID`, `DESCRIPCION`, `ESTADO`) VALUES
(1, '<p>Antes de comenzar tu examen, es importante tener en cuenta algunas instrucciones clave:</p><ul><li>Dispondrás de 60 minutos para completar esta evaluación.</li><li>Una vez que transcurran los 60 minutos, el examen se guardará automáticamente y será enviado para su evaluación.</li><li>Recomendamos encarecidamente que realices el examen en un entorno libre de distracciones y te enfoques por completo en la tarea.</li><li>Antes de iniciar, tómate un momento para relajarte y concentrarte. Respira profundamente y confía en tus habilidades.</li><li>Recuerda que este examen es una oportunidad para demostrar tus conocimientos y habilidades, así que da lo mejor de ti.</li></ul><p><strong>¡Aprovecha cada minuto y buena suerte en tu evaluación!</strong></p>', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbljob`
--

CREATE TABLE `tbljob` (
  `JOBID` int(11) NOT NULL,
  `INFOJOB` text NOT NULL,
  `COMPANYID` int(11) NOT NULL,
  `AREAID` int(11) NOT NULL,
  `OCUPACIONID` int(11) NOT NULL,
  `REQ_EMPLOYEES` int(11) NOT NULL,
  `SUELDO` double NOT NULL,
  `WORKEXPERIENCE` text NOT NULL,
  `JOBDESCRIPTION` text NOT NULL,
  `BENEFICIOS` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `GENERO` varchar(30) NOT NULL,
  `TCONTRATOID` int(11) NOT NULL,
  `MODALIDAD` varchar(100) NOT NULL,
  `TIEMPO` varchar(100) NOT NULL,
  `JOBSTATUS` int(11) NOT NULL DEFAULT 0,
  `DATEPOSTED` timestamp NOT NULL DEFAULT current_timestamp(),
  `DATE_INT` datetime NOT NULL DEFAULT current_timestamp(),
  `DATE_END` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tbljob`
--

INSERT INTO `tbljob` (`JOBID`, `INFOJOB`, `COMPANYID`, `AREAID`, `OCUPACIONID`, `REQ_EMPLOYEES`, `SUELDO`, `WORKEXPERIENCE`, `JOBDESCRIPTION`, `BENEFICIOS`, `GENERO`, `TCONTRATOID`, `MODALIDAD`, `TIEMPO`, `JOBSTATUS`, `DATEPOSTED`, `DATE_INT`, `DATE_END`) VALUES
(1, '- Título universitario o técnico en Prevención de Riesgos Laborales, Salud Ocupacional o disciplina relacionada.<br>- Experiencia previa en un rol similar como Técnico en Prevención de Riesgos Laborales.<br>- Conocimiento profundo de las leyes y regulaciones de seguridad y salud laboral.<br>- Capacidad para realizar evaluaciones de riesgos y elaborar planes de prevención.<br>- Habilidades de comunicación efectiva y capacidad para brindar capacitación y asesoramiento.<br>- Capacidad para trabajar de manera independiente y en equipo.<br>- Excelentes habilidades organizativas y capacidad para gestionar múltiples tareas.>', 1, 18, 43, 1, 2200, '- Título universitario o técnico en Prevención de Riesgos Laborales, Salud Ocupacional o disciplina relacionada.<br>- Experiencia previa en un rol similar como Técnico en Prevención de Riesgos Laborales.<br>- Conocimiento profundo de las leyes y regulaciones de seguridad y salud laboral.<br>- Capacidad para realizar evaluaciones de riesgos y elaborar planes de prevención.<br>- Habilidades de comunicación efectiva y capacidad para brindar capacitación y asesoramiento.<br>- Capacidad para trabajar de manera independiente y en equipo.<br>- Excelentes habilidades organizativas y capacidad para gestionar múltiples tareas.>', ' - Realizar evaluaciones de riesgos en el lugar de trabajo y elaborar informes detallados.<br>- Desarrollar e implementar planes de prevención de riesgos y programas de seguridad.<br>- Realizar inspecciones regulares de seguridad para identificar posibles áreas de mejora.<br>- Asesorar a los empleados sobre prácticas seguras de trabajo y proporcionar capacitación en materia de seguridad y salud.<br>- Investigar accidentes y incidentes laborales, analizar las causas raíz y proponer medidas correctivas.<br>- Mantenerse actualizado sobre las leyes y regulaciones de seguridad y salud laboral y garantizar el cumplimiento de las mismas.<br>- Participar en comités de seguridad y colaborar con otros departamentos para implementar medidas de mejora.>', ' - Salario competitivo acorde con la experiencia y los conocimientos del candidato.<br>- Paquete completo de beneficios, que incluye seguro médico y de vida, plan de pensiones y vacaciones pagadas.<br>- Oportunidades de crecimiento y desarrollo profesional.<br>- Ambiente de trabajo colaborativo y en', 'Maculino/Femenino', 5, 'Presencial', 'Tiempo completo', 0, '2023-05-31', '2023-05-30', '2023-06-02'),
(2, '- Título universitario o técnico en Prevención de Riesgos Laborales, Salud Ocupacional o disciplina relacionada.<br>- Experiencia previa en un rol similar como Técnico en Prevención de Riesgos Laborales.<br>- Conocimiento profundo de las leyes y regulaciones de seguridad y salud laboral.<br>- Capacidad para realizar evaluaciones de riesgos y elaborar planes de prevención.<br>- Habilidades de comunicación efectiva y capacidad para brindar capacitación y asesoramiento.<br>- Capacidad para trabajar de manera independiente y en equipo.<br>- Excelentes habilidades organizativas y capacidad para gestionar múltiples tareas.>', 2, 3, 42, 3, 2300, '- Experiencia previa en atención al cliente, preferiblemente en un entorno similar o relacionado con el producto o servicio ofrecido por la empresa.<br>- Excelentes habilidades de comunicación verbal y escrita.<br>- Capacidad para manejar situaciones de conflicto y resolver problemas de manera efectiva.<br>- Orientación al cliente y capacidad para brindar un servicio amigable y profesional.<br>- Conocimientos básicos de informática y habilidad para trabajar con sistemas de gestión de atención al cliente.<br>- Capacidad para trabajar de manera autónoma y en equipo.<br>- Flexibilidad para trabajar en horarios variables, incluyendo fines de semana o turnos rotativos, según las necesidades de la empresa.>', ' - Atender llamadas, correos electrónicos y chats de los clientes, proporcionando información precisa y resolviendo sus consultas y problemas de manera efectiva.<br>- Gestionar y resolver quejas o reclamaciones de los clientes, manteniendo un enfoque orientado a la solución.<br>- Mantener registros precisos de las interacciones con los clientes y actualizar la base de datos de forma regular.<br>- Colaborar con otros departamentos para garantizar una resolución adecuada de los problemas de los clientes y cumplir con sus expectativas.<br>- Proporcionar asesoramiento y orientación a los clientes sobre nuestros productos o servicios.<br>- Identificar oportunidades para mejorar los procesos y procedimientos de atención al cliente y colaborar en su implementación.>', ' - Salario competitivo acorde con la experiencia y habilidades del candidato.<br>- Programa de incentivos basado en el desempeño y la satisfacción del cliente.<br>- Oportunidades de desarrollo profesional y crecimiento dentro de la empresa.<br>- Ambiente de trabajo colaborativo y enfocado en la exce', 'Femenino', 3, 'Remoto', 'Tiempo coordinado', 0, '2023-05-31', '2023-05-30', '2023-06-02'),
(3, '- Título universitario o técnico en Prevención de Riesgos Laborales, Salud Ocupacional o disciplina relacionada.<br>- Experiencia previa en un rol similar como Técnico en Prevención de Riesgos Laborales.<br>>>', 2, 24, 44, 2, 12000, 'ababbababababababa>>>>', '    ababbababababababa>>>>', '    ababbababababababa>>>>', 'Genero no definido', 5, 'Presencial/Remoto', 'Tiempo coordinado', 0, '2023-05-31', '2023-06-15', '2023-06-15'),
(4, 'Estamos buscando un Asistente Contable altamente motivado para unirse a nuestro equipo financiero. En esta posición, serás responsable de proporcionar apoyo administrativo y contable a nuestro departamento de contabilidad. El candidato ideal debe ser organizado, meticuloso y tener un fuerte sentido de la precisión y la atención al detalle.', 1, 29, 45, 2, 1200, 'Licenciatura en Contabilidad, Finanzas o campo relacionado.<br>Experiencia previa de al menos 2 años en un rol similar.<br>Conocimiento sólido de los principios contables y los procedimientos financieros.<br>Habilidades avanzadas en el uso de software contable y hojas de cálculo.<br>Capacidad para manejar múltiples tareas y cumplir con los plazos establecidos.<br>Excelentes habilidades de comunicación verbal y escrita.', 'Registrar y mantener registros precisos de transacciones financieras.<br>Preparar y revisar facturas, estados de cuenta y otros documentos contables.<br>Realizar conciliaciones bancarias y seguimiento de cuentas por cobrar y cuentas por pagar.<br>Asistir en la preparación de informes financieros y análisis de datos.<br>Apoyar en la elaboración de presupuestos y pronósticos financieros.<br>Colaborar con el equipo contable para garantizar la precisión y integridad de la información financiera.<br>Manejar tareas administrativas generales, como archivar documentos y responder llamadas telefónicas relacionadas con asuntos contables.', 'Salario competitivo acorde con la experiencia y las habilidades.<br>Oportunidades de crecimiento y desarrollo profesional.<br>Ambiente de trabajo colaborativo y dinámico.<br>Beneficios adicionales, como seguro médico y de vida.<br>Horario laboral flexible.', 'Femenino', 4, 'Presencial', 'Medio tiempo', 0, '2023-06-15', '2023-06-15', '2023-06-16'),
(5, 'Estamos buscando un abogado de derecho corporativo altamente calificado y comprometido para unirse a nuestro bufete de abogados. El candidato ideal será responsable de brindar asesoramiento legal a empresas en diversas áreas relacionadas con el derecho corporativo. Deberá tener un profundo conocimiento de las leyes y regulaciones comerciales, así como habilidades para negociar y redactar contratos.', 1, 14, 40, 3, 1, 'Título de abogado y licencia para ejercer la abogacía en el país correspondiente.<br>Experiencia previa en derecho corporativo, preferiblemente en un bufete de abogados.<br>Amplio conocimiento de las leyes y regulaciones comerciales.<br>Excelentes habilidades de negociación y redacción de contratos.<br>Capacidad para trabajar bajo presión y gestionar múltiples casos y plazos.<br>Habilidades de investigación y análisis jurídico.<br>Fuertes habilidades de comunicación verbal y escrita.<br>Orientación al cliente y capacidad para establecer relaciones sólidas.<br>Ética profesional y confidencialidad en el manejo de información sensible.', 'Asesorar a clientes en asuntos legales relacionados con el derecho corporativo, como fusiones y adquisiciones, estructura corporativa, cumplimiento normativo y contratos comerciales.<br>Negociar y redactar contratos, acuerdos de confidencialidad, estatutos sociales y otros documentos legales.<br>Realizar investigaciones legales y análisis de riesgos para evaluar la viabilidad de transacciones y operaciones comerciales.<br>Brindar asesoramiento sobre la creación y disolución de empresas, así como sobre cambios en la estructura corporativa.<br>Representar a clientes en litigios comerciales y resolver disputas legales en los tribunales.<br>Mantenerse actualizado sobre las leyes y regulaciones comerciales pertinentes y realizar análisis de su impacto en los clientes.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de crecimiento profesional y desarrollo de carrera.<br>Ambiente de trabajo colaborativo y de equipo.<br>Participación en casos legales desafiantes y de alto perfil.<br>Acceso a recursos y herramientas legales actualizadas.<br>Horarios fle', 'Masculino', 4, 'Presencial/Remoto', 'Medio tiempo', 0, '2023-06-17', '2023-06-17', '2023-06-30'),
(6, 'Estamos buscando un Inspector de Calidad meticuloso y orientado a los detalles para unirse a nuestro equipo de control de calidad. El candidato ideal será responsable de garantizar que nuestros productos cumplan con los estándares de calidad establecidos. Deberá realizar inspecciones exhaustivas, registrar los resultados y colaborar con el equipo de producción para mejorar los procesos y resolver problemas de calidad.', 1, 31, 1, 2, 12300, 'Diploma de escuela secundaria o equivalente.<br>Experiencia previa como inspector de calidad en la industria (preferiblemente en el sector manufacturero).<br>Conocimiento de técnicas y herramientas de control de calidad, como calibradores, micrómetros y equipos de prueba.<br>Familiaridad con normas de calidad y certificaciones aplicables.<br>Habilidades para interpretar planos técnicos y especificaciones.<br>Capacidad para identificar y resolver problemas de calidad.<br>Atención al detalle y precisión en la realización de inspecciones.<br>Habilidades de comunicación efectiva y capacidad para trabajar en equipo.<br>Conocimientos básicos de software de oficina y capacidad para generar informes y documentación.', 'Realizar inspecciones de calidad en productos y componentes utilizando herramientas y equipos de medición.<br>Verificar el cumplimiento de los estándares de calidad y las especificaciones técnicas establecidas.<br>Documentar y registrar los resultados de las inspecciones y preparar informes detallados.<br>Colaborar con el equipo de producción para identificar y resolver problemas de calidad.<br>Realizar pruebas y análisis de muestras de productos para evaluar su rendimiento y confiabilidad.<br>Participar en la implementación y seguimiento de programas de control de calidad.<br>Proponer mejoras en los procesos de producción para garantizar la calidad del producto final.<br>Capacitar al personal de producción en los estándares y requisitos de calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo de control de calidad.<br>Ambiente de trabajo seguro y colaborativo.<br>Participación en la mejora continua de los procesos y productos.<br>Formación y capacitación en técnicas de inspec', 'Masculino', 1, 'Presencial', 'Medio tiempo', 0, '2023-06-17', '2023-06-17', '2023-06-24'),
(9, 'stamos buscando un Ingeniero de Desarrollo de Productos altamente creativo y enfocado en la innovación para unirse a nuestro equipo. El candidato ideal será responsable de liderar el proceso de desarrollo de productos, desde la concepción hasta la implementación. Deberá combinar habilidades técnicas con un enfoque centrado en el cliente para diseñar y mejorar productos que cumplan con las necesidades del mercado.', 3, 34, 13, 2, 21, 'Licenciatura o grado equivalente en Ingeniería, preferiblemente Ingeniería de Producto o Ingeniería Industrial.<br>Experiencia previa en el desarrollo de productos o proyectos relacionados.<br>Fuertes habilidades técnicas y conocimientos en diseño asistido por computadora (CAD) y software de simulación.<br>Capacidad para comprender y aplicar principios de diseño ergonómico y fabricación eficiente.<br>Excelentes habilidades de resolución de problemas y capacidad para tomar decisiones basadas en datos.<br>Conocimientos sólidos de metodologías de desarrollo de productos, como el enfoque Lean o Agile.<br>Habilidades de comunicación efectiva y capacidad para trabajar en equipos multidisciplinarios.<br>Orientación al cliente y capacidad para traducir las necesidades del cliente en especificaciones técnicas.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguard', 'Femenino', 3, 'Presencial', 'Medio tiempo', 0, '2023-06-17', '2023-06-17', '2023-07-01'),
(10, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 3, 34, 15, 32, 23, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguard', 'Femenino', 3, 'Remoto', 'Tiempo completo', 0, '2023-06-17', '2023-06-17', '2023-06-30'),
(11, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 1, 34, 16, 2, 2, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguard', 'Masculino', 2, 'Remoto', 'Medio tiempo', 0, '2023-06-17', '2023-06-17', '2023-07-01'),
(12, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 3, 34, 14, 2, 2, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguard', 'Genero no definido', 3, 'Remoto', 'Medio tiempo', 0, '2023-06-17', '2023-06-17', '2023-07-01'),
(13, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 2, 1, 17, 2, 2, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguard', 'Femenino', 2, 'Remoto', 'Medio tiempo', 0, '2023-06-17', '2023-06-17', '2023-07-07'),
(14, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 2, 1, 18, 2, 2, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguard', 'Femenino', 1, 'Remoto', 'Medio tiempo', 0, '2023-06-17', '2023-06-17', '2023-07-08'),
(15, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 2, 1, 19, 3, 3, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguard', 'Masculino', 1, 'Remoto', 'Medio tiempo', 0, '2023-06-17', '2023-06-17', '2023-07-07'),
(16, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 1, 1, 20, 2, 233434, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguard', 'Masculino', 1, 'Remoto', 'Tiempo completo', 0, '2023-06-17', '2023-06-17', '2023-07-01'),
(17, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 10, 1, 37, 3, 3, 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguardia.<br>Posibilidad de trabajar en estrecha colaboración con equipos de investigación y desarrollo.<br>Horario de trabajo flexible y posibilidad de conciliación laboral.<br>Contribución al éxito y la reputación de la empresa mediante la introducción de productos exitosos y de alta calidad.', 'Salario competitivo y paquete de beneficios.<br>Oportunidades de desarrollo profesional y crecimiento en el campo del desarrollo de productos.<br>Ambiente de trabajo colaborativo y estimulante.<br>Participación en proyectos innovadores y desafiantes.<br>Acceso a tecnología y herramientas de vanguard', 'Femenino', 2, 'Remoto', 'Tiempo completo', 0, '2023-06-17', '2023-06-17', '2023-07-08'),
(18, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 10, 33, 10, 2, 2, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Cola', 'Masculino', 1, 'Remoto', 'Medio tiempo', 0, '2023-06-17', '2023-06-17', '2023-07-08'),
(19, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 10, 33, 11, 2, 2300, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Cola', 'Masculino', 2, 'Presencial/Remoto', 'Medio tiempo', 0, '2023-06-17', '2023-06-17', '2023-06-17'),
(20, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 10, 33, 12, 3, 3233, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Cola', 'Masculino', 1, 'Presencial', 'Tiempo completo', 0, '2023-06-17', '2023-06-17', '2023-06-24'),
(21, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 3, 4, 26, 2, 2000, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Cola', 'Masculino', 1, 'Presencial', 'Tiempo completo', 0, '2023-06-17', '2023-06-17', '2023-07-01'),
(22, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 3, 4, 27, 2, 2200, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Cola', 'Masculino', 2, 'Remoto', 'Tiempo completo', 0, '2023-06-17', '2023-06-10', '2023-07-08'),
(23, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 3, 4, 28, 2, 2200, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Cola', 'Genero no definido', 3, 'Presencial', 'Medio tiempo', 0, '2023-06-17', '2023-06-17', '2023-07-01');
INSERT INTO `tbljob` (`JOBID`, `INFOJOB`, `COMPANYID`, `AREAID`, `OCUPACIONID`, `REQ_EMPLOYEES`, `SUELDO`, `WORKEXPERIENCE`, `JOBDESCRIPTION`, `BENEFICIOS`, `GENERO`, `TCONTRATOID`, `MODALIDAD`, `TIEMPO`, `JOBSTATUS`, `DATEPOSTED`, `DATE_INT`, `DATE_END`) VALUES
(24, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 3, 4, 30, 2, 2300, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Cola', 'Femenino', 2, 'Presencial/Remoto', 'Tiempo completo', 0, '2023-06-17', '2023-06-17', '2023-07-08'),
(25, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 3, 4, 38, 2, 2333, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Cola', 'Femenino', 2, 'Presencial', 'Medio tiempo', 0, '2023-06-17', '2023-06-17', '2023-07-08'),
(26, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 2, 4, 39, 3, 3233, 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Colaborar con equipos multidisciplinarios, como diseño, producción y marketing, para garantizar el éxito del proyecto.<br>Diseñar prototipos y realizar pruebas para evaluar la viabilidad técnica y funcional de los productos.<br>Realizar análisis de costo y factibilidad para asegurar la rentabilidad del desarrollo.<br>Supervisar el proceso de fabricación y realizar mejoras continuas en el diseño y la calidad del producto.<br>Mantenerse actualizado sobre las tecnologías emergentes y las mejores prácticas de la industria.', 'Investigar y comprender las necesidades y expectativas de los clientes y el mercado.<br>Liderar el desarrollo de productos desde la etapa conceptual hasta la implementación final.<br>Realizar investigaciones de mercado y análisis de la competencia para identificar oportunidades y tendencias.<br>Cola', 'Femenino', 1, 'Remoto', 'Tiempo completo', 0, '2023-06-17', '2023-06-17', '2023-07-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblkeywords`
--

CREATE TABLE `tblkeywords` (
  `cod_keyword` int(11) NOT NULL,
  `OCUPACIONID` int(11) DEFAULT NULL,
  `keyword` varchar(50) DEFAULT NULL,
  `fecha_registro` timestamp DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblkeywords`
--

INSERT INTO `tblkeywords` (`cod_keyword`, `OCUPACIONID`, `keyword`, `fecha_registro`) VALUES
(1, 42, 'cliente', NULL),
(2, 42, 'atencion', NULL),
(3, 42, 'serenidad ', NULL),
(4, 41, 'desarrollo', NULL),
(5, 41, 'software', NULL),
(6, 41, 'php', NULL),
(7, 43, 'riesgo', NULL),
(8, 43, 'prevencion', NULL),
(9, 43, 'tecnico', NULL),
(10, 44, 'contable', NULL),
(11, 44, 'asistente', NULL),
(12, 22, 'implementación ', '0000-00-00'),
(13, 22, 'escalabilidad ', NULL),
(14, 22, 'redes ', NULL),
(15, 22, 'seguridad', '2023-06-13'),
(16, 43, 'key1', '2023-06-13'),
(17, 43, 'key2', '2023-06-13'),
(18, 22, 'key3', '2023-06-13'),
(19, 43, 'key4', '2023-06-13'),
(20, 5, 'key5', '2023-06-13'),
(21, 22, 'key6', '2023-06-13'),
(22, 22, 'key7', '2023-06-13'),
(23, 22, 'key88', '2023-06-13'),
(24, 42, 'hola1', '2023-06-14'),
(25, 42, 'hola2', '2023-06-14'),
(26, 42, 'hola6', '2023-06-14'),
(27, 42, 'hola7', '2023-06-14'),
(28, 42, 'hola8uuuuu', '2023-06-14'),
(29, 42, 'hola9999999999', '2023-06-14'),
(30, 42, 'hola110000', '2023-06-14'),
(31, 41, 'cccc', '2023-06-14'),
(32, 41, 'xxxxz', '2023-06-14'),
(33, 41, 'zxccx', '2023-06-14'),
(34, 41, 'xcxcvv', '2023-06-14'),
(35, 41, 'vcbxxc', '2023-06-14'),
(36, 41, 'zcvbv', '2023-06-14'),
(37, 41, 'qwqwaasss', '2023-06-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmodalidad`
--

CREATE TABLE `tblmodalidad` (
  `MODALIDADID` int(11) NOT NULL,
  `MODALIDAD` varchar(100) NOT NULL,
  `ESTADO` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblmodalidad`
--

INSERT INTO `tblmodalidad` (`MODALIDADID`, `MODALIDAD`, `ESTADO`) VALUES
(1, 'Presencial', 0),
(2, 'Remoto\r\n', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblocupaciones`
--

CREATE TABLE `tblocupaciones` (
  `OCUPACIONID` int(11) NOT NULL,
  `OCUPACION` varchar(100) DEFAULT NULL,
  `AREAID` int(11) NOT NULL,
  `FECHAREGISTRO` timestamp NOT NULL DEFAULT current_timestamp(),
  `OCUPACIONSTATUS` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblocupaciones`
--

INSERT INTO `tblocupaciones` (`OCUPACIONID`, `OCUPACION`, `AREAID`, `FECHAREGISTRO`, `OCUPACIONSTATUS`) VALUES
(1, 'Inspector de calidad\n', 31, '2023-05-05 00:00:00', 1),
(2, 'Analista de laboratorio\n', 31, '2023-05-05 00:00:00', 1),
(3, 'Especialista en aseguramiento de calidad\n', 31, '2023-05-05 00:00:00', 1),
(4, 'Coordinador de control de calidad\n', 31, '2023-05-05 00:00:00', 1),
(5, 'Analista de investigación de mercados\n', 32, '2023-05-05 00:00:00', 1),
(6, 'Investigador de mercados internacionales\n', 32, '2023-05-05 00:00:00', 0),
(7, 'Especialista en análisis de datos\n', 32, '2023-05-05 00:00:00', 0),
(8, 'Consultor de investigación de mercados\n', 32, '2023-05-05 00:00:00', 0),
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
(21, 'Encargado de gestión del talento', 2, '2023-05-05 00:00:00', 0),
(22, 'Agente de Seguridad Patrimonial', 8, '2023-05-05 00:00:00', 1),
(23, 'Personal de Limpieza ', 10, '2023-05-05 00:00:00', 0),
(24, 'Prevencionista de Seguridad Industrial Senior', 8, '2023-05-05 00:00:00', 1),
(25, 'Conductor de Semitrailer', 9, '2023-05-05 00:00:00', 0),
(26, 'Reparador de Calderas', 4, '2023-05-05 00:00:00', 1),
(27, 'Técnico en Mantenimiento de Maquinas', 4, '2023-05-05 00:00:00', 1),
(28, 'Técnico electromecánico', 4, '2023-05-05 00:00:00', 1),
(29, 'Ayudante/Operario para el área de Calidad', 2, '2023-05-05 00:00:00', 0),
(30, 'Auxiliar de mantenimiento de campamento', 4, '2023-05-05 00:00:00', 1),
(31, 'Auxiliar de atención al personal', 11, '2023-05-05 00:00:00', 0),
(32, 'Operador del Centro de Monitoreo', 8, '2023-05-05 00:00:00', 1),
(33, 'Operador de Montacargas', 12, '2023-05-05 00:00:00', 0),
(34, 'Operador Apilador', 12, '2023-05-05 00:00:00', 0),
(35, 'Operador de calderas', 12, '2023-05-05 00:00:00', 0),
(36, 'Técnico Frigorista Industrial', 13, '2023-05-05 00:00:00', 0),
(37, 'Jefe de Recursos Humanos', 1, '2023-05-06 00:00:00', 1),
(38, 'Operario mecánico o electromecánico ', 4, '2023-05-06 00:00:00', 1),
(39, 'Coordinador de Operaciones Sector Eléctrico', 4, '2023-05-06 00:00:00', 1),
(40, 'Abogado', 14, '2023-05-08 00:00:00', 0),
(41, 'Desarrollador de software', 7, '2023-05-09 00:00:00', 1),
(42, 'Puesto de atencion del cliente', 3, '2023-05-30 16:19:34', 1),
(43, 'Técnico en Prevención de Riesgos Laborales', 18, '2023-05-31 21:14:27', 1),
(44, 'Asistente contable', 24, '2023-05-31 21:54:13', 1),
(45, 'inge de Business Intelligence	', 29, '2023-06-03 06:57:53', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbltipocontrato`
--

CREATE TABLE `tbltipocontrato` (
  `TCONTRATOID` int(11) NOT NULL,
  `TIPOCONTRATO` varchar(100) NOT NULL,
  `CONTENIDO` text NOT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbltipocontrato`
--

INSERT INTO `tbltipocontrato` (`TCONTRATOID`, `TIPOCONTRATO`, `CONTENIDO`, `ESTADO`) VALUES
(1, 'Contrato laboral por tiempo determinado', '<p><b>CONTRATO POR TIEMPO DETERMINADO</b></p><p><br></p><p>En la ciudad de [Ciudad], a [Fecha de inicio del contrato]</p><p><br></p><p>Entre la empresa Gandules Inc SAC, con RUC [RUC de la empresa], con domicilio en [Dirección de la empresa], representada por [Nombre del representante legal], en adelante denominada \\\"la Empresa\\\", por una parte, y el señor/señora [Nombre completo del trabajador], con DNI [Número de DNI], con domicilio en [Dirección del trabajador], en adelante denominado/a \\\"el Trabajador\\\", por la otra parte, se celebra el presente contrato de trabajo por tiempo determinado, de conformidad con las siguientes cláusulas:</p><p><b style=\\\"background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\\\"><i><br></i></b></p><p><b style=\\\"background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\\\"><i>1. Objeto del contrato:</i></b></p><p>La Empresa contrata al Trabajador para desempeñar el cargo de [Cargo del Trabajador] en el área de [Área del Trabajador] durante un periodo determinado desde [Fecha de inicio del contrato] hasta [Fecha de finalización del contrato].</p><p><b style=\\\"background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\\\"><i><br></i></b></p><p><b style=\\\"background-color: var(--bs-modal-bg); color: var(--bs-modal-color); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\\\"><i>2. Obligaciones del Trabajador:</i></b></p><p>El Trabajador se compromete a cumplir con las siguientes obligaciones:</p><p><br></p><ul><li>Realizar las tareas y funciones correspondientes a su cargo de manera eficiente y profesional.</li><li>Cumplir con los horarios establecidos por la Empresa y acatar las normas internas de la misma.</li><li>Mantener la confidencialidad de la información y los secretos comerciales de la Empresa.</li></ul><p><b><i>3. Jornada laboral:</i></b></p><p>La jornada laboral del Trabajador será de [Número de horas] horas semanales, distribuidas de acuerdo con los horarios establecidos por la Empresa.</p><p><br></p><p><b><i>4. Remuneración:</i></b></p><p>La Empresa pagará al Trabajador una remuneración mensual de [Monto de la remuneración], la cual será abonada en [Frecuencia de pago] pagos mensuales.</p><p><br></p><p><b><i>5. Beneficios:</i></b></p><p>El Trabajador tendrá derecho a los beneficios establecidos por la legislación laboral vigente y por las políticas internas de la Empresa.</p><p><br></p><p><b><i>6. Confidencialidad:</i></b></p><p>El Trabajador se compromete a mantener la confidencialidad de la información y los secretos comerciales de la Empresa durante y después de la vigencia de este contrato.</p><p><br></p><p><b><i>7. Causales de terminación:</i></b></p><p>El presente contrato se considerará terminado en las siguientes situaciones:</p><p><br></p><ul><li>Vencimiento del plazo establecido en este contrato.</li><li>Por mutuo acuerdo entre ambas partes.</li><li>Por incumplimiento grave de alguna de las obligaciones establecidas en este contrato.</li></ul><p><b><i>8. Ley aplicable y jurisdicción:</i></b></p><p>Este contrato se regirá por las leyes de [País]. Cualquier controversia que surja en relación con este contrato será sometida a la jurisdicción de los tribunales competentes de [Ciudad].</p><p>En prueba de conformidad, ambas partes firman el presente contrato en dos ejemplares, en la fecha y lugar indicados al comienzo del contrato.</p><p><br></p><p><u>[Nombre del representante legal]</u></p><p><b>Gandules Inc SAC</b></p><p><br></p><p><u>[Nombre completo del trabajador]</u></p><p><b>Por el Trabajador</b></p><p><br></p><p><u>Fecha: [Fecha de firma del contrato]</u></p>', 1),
(2, 'Contrato laboral por tiempo indeterminado', '<p><b>CONTRATO LABORAL POR TIEMPO INDETERMINADO</b></p><p><br></p><p>En la ciudad de [Ciudad], a [Fecha de inicio del contrato]</p><p><br></p><p>Entre la empresa Gandules Inc SAC, con RUC [RUC de la empresa], con domicilio en [Dirección de la empresa], representada por [Nombre del representante legal], en adelante denominada \\\"la Empresa\\\", por una parte, y el señor/señora [Nombre completo del trabajador], con DNI [Número de DNI], con domicilio en [Dirección del trabajador], en adelante denominado/a \\\"el Trabajador\\\", por la otra parte, se celebra el presente contrato de trabajo por tiempo indeterminado, de conformidad con las siguientes cláusulas:</p><p><br></p><p><b>1. Objeto del contrato:</b></p><p>La Empresa contrata al Trabajador para desempeñar el cargo de [Cargo del Trabajador] en el área de [Área del Trabajador].</p><p><br></p><p><b>2. Obligaciones del Trabajador:</b></p><p>El Trabajador se compromete a cumplir con las siguientes obligaciones:</p><ul><li>Realizar las tareas y funciones correspondientes a su cargo de manera eficiente y profesional.</li><li>Cumplir con los horarios establecidos por la Empresa y acatar las normas internas de la misma.</li><li>Mantener la confidencialidad de la información y los secretos comerciales de la Empresa.</li><li>Cumplir con todas las demás obligaciones establecidas por la legislación laboral vigente y las políticas internas de la Empresa.</li></ul><p><b>3. Jornada laboral:</b></p><p>La jornada laboral del Trabajador será de [Número de horas] horas semanales, distribuidas de acuerdo con los horarios establecidos por la Empresa.</p><p><br></p><p><b>4. Remuneración:</b></p><p>La Empresa pagará al Trabajador una remuneración mensual de [Monto de la remuneración], la cual será abonada en [Frecuencia de pago] pagos mensuales.</p><p><br></p><p><b>5. Beneficios:</b></p><p>El Trabajador tendrá derecho a los beneficios establecidos por la legislación laboral vigente y por las políticas internas de la Empresa, los cuales podrán incluir, entre otros, seguro médico, seguro de vida, y subsidios.</p><p><br></p><p><b>6. Período de prueba:</b></p><p>Se establece un período de prueba de [Duración del período de prueba] a partir de la fecha de inicio del contrato. Durante este período, ambas partes podrán dar por terminado el contrato sin necesidad de preaviso ni indemnización.</p><p><br></p><p><b>7. Confidencialidad:</b></p><p>El Trabajador se compromete a mantener la confidencialidad de la información y los secretos comerciales de la Empresa durante y después de la vigencia de este contrato.</p><p><br></p><p><b>8. Causales de terminación:</b></p><p>El presente contrato podrá ser terminado en las siguientes situaciones:</p><p><br></p><ul><li>Por decisión unilateral de cualquiera de las partes, previo aviso escrito con una anticipación mínima de [Período de preaviso] días.</li><li>Por incumplimiento grave de alguna de las obligaciones establecidas en este contrato.</li><li>Por causas previstas por la legislación laboral vigente.</li></ul><p><b>9. Ley aplicable y jurisdicción:</b></p><p>Este contrato se regirá por las leyes de [País]. Cualquier controversia que surja en relación con este contrato será sometida a la jurisdicción de los tribunales competentes de [Ciudad</p>', 1),
(3, 'Contrato laboral temporal', '<p><br></p>', 1),
(4, 'Contrato para capacitación inicial', '<p><br></p>', 1),
(5, 'Contrato de periodo de prueba', '<p><span style=\\\"font-weight: bolder;\\\">CONTRATO LABORAL POR TIEMPO INDETERMINADO</span></p><p><br></p><p>En la ciudad de [Ciudad], a [Fecha de inicio del contrato]</p><p><br></p><p>Entre la empresa Gandules Inc SAC, con RUC [RUC de la empresa], con domicilio en [Dirección de la empresa], representada por [Nombre del representante legal], en adelante denominada \\\"la Empresa\\\", por una parte, y el señor/señora [Nombre completo del trabajador], con DNI [Número de DNI], con domicilio en [Dirección del trabajador], en adelante denominado/a \\\"el Trabajador\\\", por la otra parte, se celebra el presente contrato de trabajo por tiempo indeterminado, de conformidad con las siguientes cláusulas:</p><p><br></p><p><span style=\\\"font-weight: bolder;\\\">1. Objeto del contrato:</span></p><p>La Empresa contrata al Trabajador para desempeñar el cargo de [Cargo del Trabajador] en el área de [Área del Trabajador].</p><p><br></p><p><span style=\\\"font-weight: bolder;\\\">2. Obligaciones del Trabajador:</span></p><p>El Trabajador se compromete a cumplir con las siguientes obligaciones:</p><ul><li>Realizar las tareas y funciones correspondientes a su cargo de manera eficiente y profesional.</li><li>Cumplir con los horarios establecidos por la Empresa y acatar las normas internas de la misma.</li><li>Mantener la confidencialidad de la información y los secretos comerciales de la Empresa.</li><li>Cumplir con todas las demás obligaciones establecidas por la legislación laboral vigente y las políticas internas de la Empresa.</li></ul><p><span style=\\\"font-weight: bolder;\\\">3. Jornada laboral:</span></p><p>La jornada laboral del Trabajador será de [Número de horas] horas semanales, distribuidas de acuerdo con los horarios establecidos por la Empresa.</p><p><br></p><p><span style=\\\"font-weight: bolder;\\\">4. Remuneración:</span></p><p>La Empresa pagará al Trabajador una remuneración mensual de [Monto de la remuneración], la cual será abonada en [Frecuencia de pago] pagos mensuales.</p><p><br></p><p><span style=\\\"font-weight: bolder;\\\">5. Beneficios:</span></p><p>El Trabajador tendrá derecho a los beneficios establecidos por la legislación laboral vigente y por las políticas internas de la Empresa, los cuales podrán incluir, entre otros, seguro médico, seguro de vida, y subsidios.</p><p><br></p><p><span style=\\\"font-weight: bolder;\\\">6. Período de prueba:</span></p><p>Se establece un período de prueba de [Duración del período de prueba] a partir de la fecha de inicio del contrato. Durante este período, ambas partes podrán dar por terminado el contrato sin necesidad de preaviso ni indemnización.</p><p><br></p><p><span style=\\\"font-weight: bolder;\\\">7. Confidencialidad:</span></p><p>El Trabajador se compromete a mantener la confidencialidad de la información y los secretos comerciales de la Empresa durante y después de la vigencia de este contrato.</p><p><br></p><p><span style=\\\"font-weight: bolder;\\\">8. Causales de terminación:</span></p><p>El presente contrato podrá ser terminado en las siguientes situaciones:</p><p><br></p><ul><li>Por decisión unilateral de cualquiera de las partes, previo aviso escrito con una anticipación mínima de [Período de preaviso] días.</li><li>Por incumplimiento grave de alguna de las obligaciones establecidas en este contrato.</li><li>Por causas previstas por la legislación laboral vigente.</li></ul><p><span style=\\\"font-weight: bolder;\\\">9. Ley aplicable y jurisdicción:</span></p><p>Este contrato se regirá por las leyes de [País]. Cualquier controversia que surja en relación con este contrato será sometida a la jurisdicción de los tribunales competentes de [Ciudad</p>', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusers`
--

CREATE TABLE `tblusers` (
  `USERID` int(11) NOT NULL,
  `FULLNAME` varchar(40) NOT NULL,
  `USERNAME` varchar(90) NOT NULL,
  `CORREO` varchar(150) NOT NULL,
  `DNI` varchar(10) NOT NULL,
  `TELEFONO` varchar(10) NOT NULL,
  `PASS` varchar(90) NOT NULL,
  `ROLE` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FOTO` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `ESTADO` int(1) NOT NULL DEFAULT 0,
  `CREATEAT` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tblusers`
--

INSERT INTO `tblusers` (`USERID`, `FULLNAME`, `USERNAME`, `CORREO`, `DNI`, `TELEFONO`, `PASS`, `ROLE`, `FOTO`, `ESTADO`, `CREATEAT`) VALUES
(1, 'admin', 'root', 'root@gmail.com', '71574122', '965208467', 'root', 'Administrador', '30052023083637IMG_20220815_131834.jpg', 0, '2023-05-02'),
(8, 'Ysabel Yamunaque Santoyo', 'user', 'isabel@gmail.com', '17591502', '', '$2y$10$CbHWzgIYMTJErC9hprTjn.XHz5N7/kIm91ZxQ3z8C939oCf8Rjxae', 'Usuario', '01062023121235323001519_3362523854021398_545672291732002656_n.png', 1, '2023-05-31'),
(9, 'Aaron Gonzales Bellido', 'prueba', 'isabel@gmail.com', '74610577', '', '$2y$10$XRMmM4aZQQ82TgQPQdNutu5u5eDzeWO6UllGq6FPd3s.Udb5kHpMi', 'Usuario', '01062023030046323001519_3362523854021398_545672291732002656_n.png', 0, '2023-06-01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblapplicants`
--
ALTER TABLE `tblapplicants`
  ADD PRIMARY KEY (`APPLICANTID`);

--
-- Indices de la tabla `tblareas`
--
ALTER TABLE `tblareas`
  ADD PRIMARY KEY (`AREAID`);

--
-- Indices de la tabla `tblautonumbers`
--
ALTER TABLE `tblautonumbers`
  ADD PRIMARY KEY (`AUTOID`);

--
-- Indices de la tabla `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`COMPANYID`);

--
-- Indices de la tabla `tblcorreo`
--
ALTER TABLE `tblcorreo`
  ADD PRIMARY KEY (`CORREOID`);

--
-- Indices de la tabla `tblcreaevaluaciones`
--
ALTER TABLE `tblcreaevaluaciones`
  ADD PRIMARY KEY (`IDEVALUACIONCREA`);

--
-- Indices de la tabla `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`INCID`),
  ADD UNIQUE KEY `EMPLOYEEID` (`APLICANTID`),
  ADD KEY `AREAID` (`AREAID`),
  ADD KEY `PUESTOID` (`OCUPACIONID`),
  ADD KEY `COMPANYID` (`COMPANYID`);

--
-- Indices de la tabla `tblevaluaciones`
--
ALTER TABLE `tblevaluaciones`
  ADD PRIMARY KEY (`EVALUACIONID`);

--
-- Indices de la tabla `tblindicacioneseva`
--
ALTER TABLE `tblindicacioneseva`
  ADD PRIMARY KEY (`INDICACIONID`);

--
-- Indices de la tabla `tbljob`
--
ALTER TABLE `tbljob`
  ADD PRIMARY KEY (`JOBID`),
  ADD KEY `AREAID` (`AREAID`),
  ADD KEY `OCUPACIONID` (`OCUPACIONID`),
  ADD KEY `COMPANYID` (`COMPANYID`),
  ADD KEY `TCONTRATOID` (`TCONTRATOID`);

--
-- Indices de la tabla `tblkeywords`
--
ALTER TABLE `tblkeywords`
  ADD PRIMARY KEY (`cod_keyword`),
  ADD KEY `cod_ocupacion` (`OCUPACIONID`);

--
-- Indices de la tabla `tblmodalidad`
--
ALTER TABLE `tblmodalidad`
  ADD PRIMARY KEY (`MODALIDADID`);

--
-- Indices de la tabla `tblocupaciones`
--
ALTER TABLE `tblocupaciones`
  ADD PRIMARY KEY (`OCUPACIONID`),
  ADD KEY `AREAID` (`AREAID`);

--
-- Indices de la tabla `tbltipocontrato`
--
ALTER TABLE `tbltipocontrato`
  ADD PRIMARY KEY (`TCONTRATOID`);

--
-- Indices de la tabla `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`USERID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblapplicants`
--
ALTER TABLE `tblapplicants`
  MODIFY `APPLICANTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tblareas`
--
ALTER TABLE `tblareas`
  MODIFY `AREAID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `tblautonumbers`
--
ALTER TABLE `tblautonumbers`
  MODIFY `AUTOID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `COMPANYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tblcorreo`
--
ALTER TABLE `tblcorreo`
  MODIFY `CORREOID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tblcreaevaluaciones`
--
ALTER TABLE `tblcreaevaluaciones`
  MODIFY `IDEVALUACIONCREA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `INCID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tblevaluaciones`
--
ALTER TABLE `tblevaluaciones`
  MODIFY `EVALUACIONID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tblindicacioneseva`
--
ALTER TABLE `tblindicacioneseva`
  MODIFY `INDICACIONID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbljob`
--
ALTER TABLE `tbljob`
  MODIFY `JOBID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tblkeywords`
--
ALTER TABLE `tblkeywords`
  MODIFY `cod_keyword` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `tblmodalidad`
--
ALTER TABLE `tblmodalidad`
  MODIFY `MODALIDADID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tblocupaciones`
--
ALTER TABLE `tblocupaciones`
  MODIFY `OCUPACIONID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `tbltipocontrato`
--
ALTER TABLE `tbltipocontrato`
  MODIFY `TCONTRATOID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
