-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-06-2023 a las 06:02:23
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
  `DATEADD` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`APPLICANTID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcompany`
--

DROP TABLE IF EXISTS `tblcompany`;
CREATE TABLE IF NOT EXISTS `tblcompany` (
  `COMPANYID` int NOT NULL AUTO_INCREMENT,
  `COMPANYNAME` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `COMPANYADDRESS` varchar(90) NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `COMPANYSTATUS` int NOT NULL DEFAULT '0',
  `FECHAREGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`COMPANYID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcorreo`
--

DROP TABLE IF EXISTS `tblcorreo`;
CREATE TABLE IF NOT EXISTS `tblcorreo` (
  `CORREOID` int NOT NULL AUTO_INCREMENT,
  `ASUNTO` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `CONTENIDO` text COLLATE utf8mb4_general_ci NOT NULL,
  `ESTADO` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`CORREOID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `CONTRATO` text NOT NULL,
  `ESTADO` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`INCID`),
  UNIQUE KEY `EMPLOYEEID` (`APLICANTID`),
  KEY `AREAID` (`AREAID`),
  KEY `PUESTOID` (`OCUPACIONID`),
  KEY `COMPANYID` (`COMPANYID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblindicacioneseva`
--

DROP TABLE IF EXISTS `tblindicacioneseva`;
CREATE TABLE IF NOT EXISTS `tblindicacioneseva` (
  `INDICACIONID` int NOT NULL AUTO_INCREMENT,
  `DESCRIPCION` text COLLATE utf8mb4_general_ci NOT NULL,
  `ESTADO` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`INDICACIONID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbljob`
--

DROP TABLE IF EXISTS `tbljob`;
CREATE TABLE IF NOT EXISTS `tbljob` (
  `JOBID` int NOT NULL AUTO_INCREMENT,
  `INFOJOB` text NOT NULL,
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
  `DATE_INT` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATE_END` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`JOBID`),
  KEY `AREAID` (`AREAID`),
  KEY `OCUPACIONID` (`OCUPACIONID`),
  KEY `COMPANYID` (`COMPANYID`),
  KEY `TCONTRATOID` (`TCONTRATOID`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblkeywords`
--

DROP TABLE IF EXISTS `tblkeywords`;
CREATE TABLE IF NOT EXISTS `tblkeywords` (
  `cod_keyword` int NOT NULL AUTO_INCREMENT,
  `OCUPACIONID` int DEFAULT NULL,
  `keyword` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cod_keyword`),
  KEY `cod_ocupacion` (`OCUPACIONID`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmodalidad`
--

DROP TABLE IF EXISTS `tblmodalidad`;
CREATE TABLE IF NOT EXISTS `tblmodalidad` (
  `MODALIDADID` int NOT NULL AUTO_INCREMENT,
  `MODALIDAD` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ESTADO` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`MODALIDADID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusers`
--

DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE IF NOT EXISTS `tblusers` (
  `USERID` int NOT NULL AUTO_INCREMENT,
  `FULLNAME` varchar(40) NOT NULL,
  `USERNAME` varchar(90) NOT NULL,
  `CORREO` varchar(150) NOT NULL,
  `DNI` varchar(10) NOT NULL,
  `TELEFONO` varchar(10) NOT NULL,
  `PASS` varchar(90) NOT NULL,
  `ROLE` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `FOTO` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `ESTADO` int NOT NULL DEFAULT '0',
  `CREATEAT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`USERID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblusers`
--

INSERT INTO `tblusers` (`USERID`, `FULLNAME`, `USERNAME`, `CORREO`, `DNI`, `TELEFONO`, `PASS`, `ROLE`, `FOTO`, `ESTADO`, `CREATEAT`) VALUES
(1, 'admin', 'root', 'root@gmail.com', '71574122', '965208467', '$2y$10$CbHWzgIYMTJErC9hprTjn.XHz5N7/kIm91ZxQ3z8C939oCf8Rjxae', 'Administrador', '30052023083637IMG_20220815_131834.jpg', 0, '2023-05-02 00:00:00'),
(8, 'Ysabel Yamunaque Santoyo', 'user', 'isabel@gmail.com', '17591502', '', '$2y$10$CbHWzgIYMTJErC9hprTjn.XHz5N7/kIm91ZxQ3z8C939oCf8Rjxae', 'Usuario', '01062023121235323001519_3362523854021398_545672291732002656_n.png', 1, '2023-05-31 00:00:00'),
(9, 'Aaron Gonzales Bellido', 'prueba', 'isabel@gmail.com', '74610577', '', '$2y$10$XRMmM4aZQQ82TgQPQdNutu5u5eDzeWO6UllGq6FPd3s.Udb5kHpMi', 'Usuario', '01062023030046323001519_3362523854021398_545672291732002656_n.png', 0, '2023-06-01 00:00:00');

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
