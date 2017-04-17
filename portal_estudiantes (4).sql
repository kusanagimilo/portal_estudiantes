-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2017 at 09:07 PM
-- Server version: 5.7.16
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal_estudiantes`
--

-- --------------------------------------------------------

--
-- Table structure for table `campos`
--

CREATE TABLE `campos` (
  `id_campo` int(11) NOT NULL,
  `nombre_campo` varchar(200) DEFAULT NULL,
  `tipo_campo` int(11) DEFAULT NULL,
  `opciones` varchar(500) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario_creo` int(11) DEFAULT NULL,
  `id_usuario_modifico` int(11) DEFAULT NULL,
  `campo_identi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campos`
--

INSERT INTO `campos` (`id_campo`, `nombre_campo`, `tipo_campo`, `opciones`, `fecha_creacion`, `fecha_modificacion`, `id_usuario_creo`, `id_usuario_modifico`, `campo_identi`) VALUES
(1, 'NOMBRES COMPLETOS', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 19:44:26', 1, 1, 'nombre'),
(2, 'TIPO DOCUMENTO', 1, 'T.I;C.C;C.E;PASAPORTE', '2016-12-11 00:00:00', '2016-12-11 19:44:28', 1, 1, 'tipo_documento'),
(3, 'NUMERO DOCUMENTO', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 19:57:20', 1, 1, 'numero_documento'),
(4, 'ID INSTITUCIONAL', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 19:57:20', 1, 1, 'id_javeriana'),
(5, 'CICLO DE RETIRO', 1, '1710;1730;1810;1830;1910;1930', '2016-12-11 00:00:00', '2016-12-11 19:57:20', 1, 1, 'ciclo_retiro'),
(6, 'CICLO DE INGRESO', 1, '1730;1810;1830;1910;1930', '2016-12-11 00:00:00', '2016-12-11 19:57:20', 1, 1, 'ciclo_ingreso'),
(7, 'MOTIVO', 1, 'CURSO EN EL EXTERIOR O INTERCAMBIO;PROBLEMA DE TIPO MEDICO;PERSONAL O INCONVENIENTE DE FUERZA MAYOR', '2016-12-11 00:00:00', '2016-12-11 19:57:20', 1, 1, 'motivo'),
(13, 'TELEFONO', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 20:03:37', 1, 1, 'telefono'),
(14, 'DIRECCION', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 20:03:37', 1, 1, 'direccion'),
(20, 'CORREO ELECTRONICO INSTITUCIONAL', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 20:03:39', 1, 1, 'correo_electronico'),
(21, 'NOMBRE DEL RESPONSABLE EN LA EMPRESA', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 20:03:39', 1, 1, 'nombre_responsable_empresa'),
(22, 'CARGO DEL RESPONSABLE EN LA EMPRESA', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 20:03:39', 1, 1, 'cargo_responsable_empresa'),
(23, 'NOMBRE DE LA EMPRESA ', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 20:11:35', 1, 1, 'nombre_empresa'),
(25, 'NOMBRE DEL PROFESOR', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 20:28:14', 1, 1, 'nombre_profesor'),
(26, 'FECHA INASISTENCIA', 3, NULL, '2016-12-11 00:00:00', '2016-12-11 20:28:14', 1, 1, 'fecha_inasistencia'),
(27, 'MOTIVO INASISTENCIA', 1, 'CITA MEDICA;INCAPACIDAD MEDICA;INCONVENIENTE PERSONAL;REPRESENTACION DE LA UNIVERSIDAD EN EVENTOS ACADEMICOS, CULTURALES O DEPORTIVOS;OTRO', NULL, '2016-12-11 20:28:14', 1, 1, 'motivo_inasistencia'),
(28, 'NOMBRE ASIGNATURA', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 20:28:14', 1, 1, 'nombre_asignatura'),
(29, 'MOTIVO INASISTENCIA PARCIAL', 1, 'CITACIÓN DE SERVICIO MILITAR O DE ORDEN JUDICIAL;REPRESENTACIÓN DE LA UNIVERSIDAD EN EVENTOS ACADÉMICOS, CULTURALES O DEPORTIVOS;INTERVENCIÓN QUIRÚRGICA QUE NO ADMITE APLAZAMIENTO;INCAPACIDAD MÉDICA;CRUCE DE EXÁMENES PARCIALES PROGRAMADOS POR LA UNIVERSIDAD;FUNERAL DE PARIENTE EN PRIMER GRADO DE CONSANGUINIDAD;PRIMERO DE AFINIDAD Y ÚNICO CIVIL;OTRO', NULL, '2016-12-11 20:28:14', NULL, NULL, 'motivo_inasistencia_parcial'),
(30, 'NUMERO DE CLASE', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 20:31:56', 1, 1, 'numero_clase'),
(31, 'PARCIAL NUMERO', 1, 'PRIMER PARCIAL;SEGUNDO PARCIAL;TERCER PARCIAL;CUARTO PARCIAL', '2016-12-11 00:00:00', '2016-12-11 20:31:56', 1, 1, 'parcial_numero'),
(32, 'TIPO DE ESPACIO', 1, 'AUDITORIO;SALÓN;SALA DE CÓMPUTO', '2016-12-11 00:00:00', '2016-12-11 20:47:36', 1, 1, 'tipo_espacio'),
(33, 'CAPACIDAD DEL SITIO', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 20:47:36', 1, 1, 'capacidad_sitio'),
(34, 'NOMBRE DEL EVENTO', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 20:47:36', 1, 1, 'nombre_evento'),
(35, 'ELEMENTOS A UTILIZAR', 1, 'VIDEO BEAM;COMPUTADOR;T.V;D.V.D;OTRO;NINGUNO', '2016-12-11 00:00:00', '2016-12-11 20:47:36', 1, 1, 'elemento_utilizar'),
(36, 'FECHA DEL EVENTO', 3, NULL, '2016-12-11 00:00:00', '2016-12-11 20:47:36', 1, 1, 'fecha_evento'),
(37, 'HORA INICIO', 4, NULL, '2016-12-11 00:00:00', '2016-12-11 21:42:04', 1, 1, 'hora_inicio'),
(38, 'HORA FIN', 4, NULL, '2016-12-11 00:00:00', '2016-12-11 21:42:04', 1, 1, 'hora_fin'),
(39, 'NOMBRE DEL RESPONSABLE', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 21:42:04', 1, 1, 'nombre_responsable'),
(40, 'MEDIO POR EL CUAL CUMPLIÓ EL REQUISITO', 1, 'NIVELES CURSADOS EN LA UNIVERSIDAD;PRESENTÓ EXAMEN INTERNACIONAL', '2016-12-11 00:00:00', '2016-12-11 21:42:04', 1, 1, 'medio_cumplio_requisito'),
(41, 'NÚMERO DE CRÉDITOS PARA CAMBIO DE RECIBO', 1, '1 CRÉDITOS;2 CRÉDITOS;3 CRÉDITOS;4 CRÉDITOS;11 CRÉDITOS;12 CRÉDITOS;13 CRÉDITOS;14 CRÉDITOS', '2016-12-11 00:00:00', '2016-12-11 21:42:04', 1, 1, 'numero_creditos_para_cambio_recibo'),
(42, 'ASIGNATURAS FALTANTES POR CURSAR', 2, NULL, '2016-12-11 00:00:00', '2016-12-11 21:42:04', 1, 1, 'asignaturas_faltantes_cursar'),
(43, 'PERIODO DE RETIRO', 1, 'PRIMER;TERCER', '2017-02-22 00:00:00', '2017-02-22 11:22:49', 2, NULL, 'periodo_retiro'),
(44, 'PERIODO DE INGRESO', 1, 'PRIMER;TERCER', '2017-02-22 00:00:00', '2017-02-22 11:29:10', 2, NULL, 'periodo_ingreso'),
(45, 'AÑO RETIRO', 5, '2000-2050', '2017-02-22 00:00:00', '2017-02-22 11:32:31', 2, NULL, 'anio_retiro'),
(46, 'AÑO INGRESO', 5, '2000-2050', '2017-02-22 00:00:00', '2017-02-22 11:36:05', 2, NULL, 'anio_ingreso'),
(47, 'DESCRIPCION MOTIVO', 6, NULL, '2017-02-22 00:00:00', '2017-02-22 11:38:35', 2, NULL, 'descripcion_motivo');

-- --------------------------------------------------------

--
-- Table structure for table `caso`
--

CREATE TABLE `caso` (
  `id_caso` int(11) NOT NULL,
  `id_tipo_proceso` int(11) DEFAULT NULL,
  `id_usuario_creo` int(11) DEFAULT NULL,
  `id_usuario_modifico` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_dato` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `caso`
--

INSERT INTO `caso` (`id_caso`, `id_tipo_proceso`, `id_usuario_creo`, `id_usuario_modifico`, `id_estado`, `id_dato`, `fecha_creacion`, `fecha_modificacion`) VALUES
(1, 1, 2, NULL, 1, 1, '2017-02-08 08:44:57', '2017-02-08 15:44:57'),
(2, 7, 2, NULL, 1, 2, '2017-02-08 10:00:55', '2017-02-08 17:00:55'),
(3, 5, 2, NULL, 1, 3, '2017-02-08 10:12:49', '2017-02-08 17:12:49'),
(4, 1, 2, NULL, 1, 4, '2017-02-13 08:16:12', '2017-02-13 15:16:12'),
(5, 7, 4, NULL, 1, 5, '2017-02-21 09:49:19', '2017-02-21 04:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `dato`
--

CREATE TABLE `dato` (
  `id_dato` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `tipo_documento` varchar(100) DEFAULT NULL,
  `numero_documento` varchar(100) DEFAULT NULL,
  `id_javeriana` varchar(100) DEFAULT NULL,
  `ciclo_retiro` varchar(200) DEFAULT NULL,
  `ciclo_ingreso` varchar(200) DEFAULT NULL,
  `motivo` varchar(200) DEFAULT NULL,
  `telefono` varchar(200) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `correo_electronico` varchar(200) DEFAULT NULL,
  `nombre_responsable_empresa` varchar(200) DEFAULT NULL,
  `cargo_responsable_empresa` varchar(200) DEFAULT NULL,
  `nombre_empresa` varchar(200) DEFAULT NULL,
  `nombre_asignatura` varchar(200) DEFAULT NULL,
  `nombre_profesor` varchar(200) DEFAULT NULL,
  `fecha_inasistencia` date DEFAULT NULL,
  `motivo_inasistencia` varchar(200) DEFAULT NULL,
  `motivo_inasistencia_parcial` varchar(200) DEFAULT NULL,
  `numero_clase` varchar(100) DEFAULT NULL,
  `parcial_numero` varchar(150) DEFAULT NULL,
  `tipo_espacio` varchar(150) DEFAULT NULL,
  `capacidad_sitio` varchar(150) DEFAULT NULL,
  `nombre_evento` varchar(200) DEFAULT NULL,
  `elemento_utilizar` varchar(200) DEFAULT NULL,
  `fecha_evento` date DEFAULT NULL,
  `hora_inicio` varchar(45) DEFAULT NULL,
  `hora_fin` varchar(45) DEFAULT NULL,
  `nombre_responsable` varchar(200) DEFAULT NULL,
  `medio_cumplio_requisito` varchar(200) DEFAULT NULL,
  `numero_creditos_para_cambio_recibo` varchar(200) DEFAULT NULL,
  `asignaturas_faltantes_cursar` varchar(200) DEFAULT NULL,
  `periodo_retiro` varchar(100) DEFAULT NULL,
  `periodo_ingreso` varchar(100) DEFAULT NULL,
  `anio_retiro` varchar(50) DEFAULT NULL,
  `anio_ingreso` varchar(50) DEFAULT NULL,
  `descripcion_motivo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dato`
--

INSERT INTO `dato` (`id_dato`, `nombre`, `tipo_documento`, `numero_documento`, `id_javeriana`, `ciclo_retiro`, `ciclo_ingreso`, `motivo`, `telefono`, `direccion`, `correo_electronico`, `nombre_responsable_empresa`, `cargo_responsable_empresa`, `nombre_empresa`, `nombre_asignatura`, `nombre_profesor`, `fecha_inasistencia`, `motivo_inasistencia`, `motivo_inasistencia_parcial`, `numero_clase`, `parcial_numero`, `tipo_espacio`, `capacidad_sitio`, `nombre_evento`, `elemento_utilizar`, `fecha_evento`, `hora_inicio`, `hora_fin`, `nombre_responsable`, `medio_cumplio_requisito`, `numero_creditos_para_cambio_recibo`, `asignaturas_faltantes_cursar`, `periodo_retiro`, `periodo_ingreso`, `anio_retiro`, `anio_ingreso`, `descripcion_motivo`) VALUES
(1, 'JUAN CAMILO CRUZ', 'C.C', '1019075739', '1234', '1710', '1730', 'CURSO EN EL EXTERIOR O INTERCAMBIO', '6975575', 'CALLE 123', 'kusanagimilo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(2, 'JUAN CAMILO', 'C.C', '1019075739', '12345', NULL, NULL, NULL, '6975575', NULL, 'kusanagimilo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4 CRï¿½DITOS', '3', NULL, NULL, NULL, NULL, ''),
(3, NULL, 'T.I', '1019075739', '1234567', NULL, NULL, NULL, '7621621621', NULL, 'jccruz08@misena.edu.co', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AUDITORIO', '23', 'capacitacion programacion', 'VIDEO BEAM', '2017-02-09', '1:14', '7:13', 'JUAN CAMILO CRUZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(4, 'LALALA', 'C.C', '32984734827342', '8237', '1710', '1810', 'CURSO EN EL EXTERIOR O INTERCAMBIO', '29832198', 'SAJHDKJSAH', 'DSJKHDS@SKJADHS.COM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(5, 'JUAN CAMILO', 'C.C', '92103153680', '3', NULL, NULL, NULL, '6975575', NULL, 'JA@JA.COM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4 CRÃ‰DITOS', '3', NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `documento`
--

CREATE TABLE `documento` (
  `id_documento` int(11) NOT NULL,
  `extension` varchar(150) DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_usr_creo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documento`
--

INSERT INTO `documento` (`id_documento`, `extension`, `nombre`, `url`, `fecha_creacion`, `id_usr_creo`) VALUES
(1, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'Formato Acta Retiro Temporal', 'lib/Documentos/Formato Acta Retiro Temporal.docx', '2017-02-08 10:43:29', 2),
(2, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'Formato Carta solicitud Retiro Temporal y Definitivo (RT-RD)', 'lib/Documentos/Formato Carta solicitud Retiro Temporal y Definitivo (RT-RD).xlsx', '2017-02-08 10:43:29', 2),
(3, 'application/pdf', 'Retiro Temporal', 'lib/Documentos/Retiro Temporal.pdf', '2017-02-08 10:43:29', 2),
(4, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'Formato Acta Retiro Definitivo', 'lib/Documentos/Formato Acta Retiro Definitivo.docx', '2017-02-08 10:54:33', 2),
(5, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'Formato Carta solicitud Retiro Temporal y Definitivo (RT-RD)', 'lib/Documentos/Formato Carta solicitud Retiro Temporal y Definitivo (RT-RD).xlsx', '2017-02-08 10:54:33', 2),
(6, 'application/pdf', 'Retiro Definitivo', 'lib/Documentos/Retiro Definitivo.pdf', '2017-02-08 10:54:33', 2),
(7, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'Formato Excusa', 'lib/Documentos/Formato Excusa.docx', '2017-02-08 11:06:03', 2),
(8, 'application/pdf', 'Solicitud Excusa para profesores', 'lib/Documentos/Solicitud Excusa para profesores.pdf', '2017-02-08 11:06:03', 2),
(9, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'Formato Supletorio', 'lib/Documentos/Formato Supletorio.docx', '2017-02-08 11:19:55', 2),
(10, 'application/pdf', 'Solicitud Supletorio', 'lib/Documentos/Solicitud Supletorio.pdf', '2017-02-08 11:19:55', 2),
(11, 'application/pdf', 'Solicitud Reserva de espacios', 'lib/Documentos/Solicitud Reserva de espacios.pdf', '2017-02-08 11:24:07', 2),
(12, 'application/pdf', 'ActualizacioÌn requisito de ingleÌs', 'lib/Documentos/ActualizacioÌn requisito de ingleÌs.pdf', '2017-02-08 11:49:04', 2),
(13, 'application/pdf', 'Solicitud Cambio de carga acadeÌmica', 'lib/Documentos/Solicitud Cambio de carga acadeÌmica.pdf', '2017-02-08 11:59:44', 2),
(14, 'application/msword', 'Carta PresentacioÌn a Empresa', 'lib/Documentos/Carta PresentacioÌn a Empresa.doc', '2017-02-08 12:10:29', 2),
(15, 'application/pdf', 'Solicitud Carta de presentacioÌn a Empresa', 'lib/Documentos/Solicitud Carta de presentacioÌn a Empresa.pdf', '2017-02-08 12:10:29', 2),
(16, 'application/pdf', 'Hoja De Vida Anny !.pdf', 'lib/Documentos/20170212051722_Hoja De Vida Anny !.pdf', '2017-02-12 17:17:22', 2),
(17, 'application/pdf', '9999pnnr.pdf', 'lib/Documentos/20170213101612_9999pnnr.pdf', '2017-02-13 10:16:12', 2),
(18, 'image/png', 'logoFooter.png', 'lib/Documentos/20170220114919_logoFooter.png', '2017-02-20 23:49:19', 4),
(19, 'image/png', 'logo_jave.png', 'lib/Documentos/20170220114947_logo_jave.png', '2017-02-20 23:49:47', 4),
(20, 'image/png', 'maleta.png', 'lib/Documentos/20170220115106_maleta.png', '2017-02-20 23:51:06', 2);

-- --------------------------------------------------------

--
-- Table structure for table `documento_caso`
--

CREATE TABLE `documento_caso` (
  `id_documento_caso` int(11) NOT NULL,
  `id_documento` int(11) DEFAULT NULL,
  `id_caso` int(11) DEFAULT NULL,
  `id_usuario_creo` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documento_caso`
--

INSERT INTO `documento_caso` (`id_documento_caso`, `id_documento`, `id_caso`, `id_usuario_creo`, `fecha_creacion`) VALUES
(1, 16, 1, 2, '2017-02-12 17:17:22'),
(2, 17, 4, 2, '2017-02-13 10:16:12'),
(3, 18, 5, 4, '2017-02-20 23:49:19'),
(4, 19, 5, 4, '2017-02-20 23:49:47'),
(5, 20, 5, 2, '2017-02-20 23:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `documento_tipo_proceso`
--

CREATE TABLE `documento_tipo_proceso` (
  `id_documento_tipo_proceso` int(11) NOT NULL,
  `id_tipo_proceso` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_usr_creo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documento_tipo_proceso`
--

INSERT INTO `documento_tipo_proceso` (`id_documento_tipo_proceso`, `id_tipo_proceso`, `id_documento`, `fecha_creacion`, `id_usr_creo`) VALUES
(1, 1, 1, '2017-02-08 10:43:29', 2),
(2, 1, 2, '2017-02-08 10:43:29', 2),
(3, 1, 3, '2017-02-08 10:43:29', 2),
(4, 2, 4, '2017-02-08 10:54:33', 2),
(5, 2, 5, '2017-02-08 10:54:33', 2),
(6, 2, 6, '2017-02-08 10:54:33', 2),
(7, 3, 7, '2017-02-08 11:06:03', 2),
(8, 3, 8, '2017-02-08 11:06:03', 2),
(9, 4, 9, '2017-02-08 11:19:55', 2),
(10, 4, 10, '2017-02-08 11:19:55', 2),
(11, 5, 11, '2017-02-08 11:24:07', 2),
(12, 6, 12, '2017-02-08 11:49:04', 2),
(13, 7, 13, '2017-02-08 11:59:44', 2),
(14, 8, 14, '2017-02-08 12:10:29', 2),
(15, 8, 15, '2017-02-08 12:10:29', 2);

-- --------------------------------------------------------

--
-- Table structure for table `estado_proceso`
--

CREATE TABLE `estado_proceso` (
  `id_estado_proceso` int(11) NOT NULL,
  `estado_proceso` varchar(150) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `id_usr_creo` int(11) DEFAULT NULL,
  `id_usr_modifico` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estado_proceso`
--

INSERT INTO `estado_proceso` (`id_estado_proceso`, `estado_proceso`, `estado`, `id_usr_creo`, `id_usr_modifico`, `fecha_creacion`, `fecha_modificacion`) VALUES
(1, 'SOLICITUD REGISTRADA', 'AC', 1, NULL, '2017-01-17 07:43:01', '2017-01-17 19:43:01'),
(2, 'SOLICITUD EN PROCESO', 'AC', 1, NULL, '2017-01-17 07:43:21', '2017-01-17 19:43:21'),
(3, 'SOLICITUD FINALIZADA', 'AC', 1, NULL, '2017-01-17 07:43:30', '2017-01-17 19:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id_links` int(11) NOT NULL,
  `link` varchar(150) NOT NULL,
  `accion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id_links`, `link`, `accion`) VALUES
(1, 'USUARIOS', 'CargarVistaUsuarios()'),
(2, 'ROLES', 'CargarVistaRoles()'),
(3, 'ESTADOS', 'CargarVistaEstados()'),
(4, 'TIPO PROCESO', 'CargarTipoProceso()'),
(5, 'CREAR CASO', 'CargarCasosDisponi()'),
(6, 'VER CASOS', 'VerTotCasos()'),
(7, 'VER MIS CASOS', 'VerMisCasos()'),
(8, 'REPORTES', 'VerReportes()');

-- --------------------------------------------------------

--
-- Table structure for table `links_rol`
--

CREATE TABLE `links_rol` (
  `id_links_rol` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_links` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usr_creo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `links_rol`
--

INSERT INTO `links_rol` (`id_links_rol`, `id_rol`, `id_links`, `fecha_creacion`, `id_usr_creo`) VALUES
(1, 8, 1, '2016-12-14 12:27:59', 1),
(2, 8, 2, '2016-12-14 12:27:59', 1),
(3, 8, 3, '2016-12-14 12:28:15', 1),
(4, 8, 4, '2016-12-14 12:28:15', 1),
(5, 8, 5, '2017-01-17 12:42:07', 2),
(6, 8, 6, '2017-01-17 06:21:59', 2),
(7, 10, 5, '2017-01-17 07:45:48', 2),
(9, 8, 7, '2017-01-18 01:55:06', 2),
(10, 10, 7, '2017-01-18 03:31:46', 2),
(11, 8, 8, '2017-02-12 06:46:23', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(100) DEFAULT NULL,
  `id_usr_creo` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `id_usr_modifico` int(11) DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`, `id_usr_creo`, `fecha_creacion`, `id_usr_modifico`, `fecha_modificacion`, `estado`) VALUES
(8, 'Administrador', 1, '2016-11-14 01:37:11', 1, '2016-11-14 13:37:11', 'AC'),
(10, 'Estudiante', 1, '2016-11-14 01:39:51', 1, '2016-11-14 13:39:51', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `rol_tipo_proceso`
--

CREATE TABLE `rol_tipo_proceso` (
  `id_rol_tipo_proceso` int(11) NOT NULL,
  `id_tipo_proceso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_usr_creo` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol_tipo_proceso`
--

INSERT INTO `rol_tipo_proceso` (`id_rol_tipo_proceso`, `id_tipo_proceso`, `id_rol`, `id_usr_creo`, `fecha_creacion`) VALUES
(1, 1, 8, 2, '2017-02-08 10:44:11'),
(2, 2, 8, 2, '2017-02-08 11:06:12'),
(3, 3, 8, 2, '2017-02-08 11:06:14'),
(4, 4, 8, 2, '2017-02-08 11:20:04'),
(5, 5, 8, 2, '2017-02-08 11:24:16'),
(6, 6, 8, 2, '2017-02-08 11:49:14'),
(7, 7, 8, 2, '2017-02-08 11:59:52'),
(8, 8, 8, 2, '2017-02-08 12:10:39'),
(9, 1, 10, 2, '2017-02-20 11:48:04'),
(10, 2, 10, 2, '2017-02-20 11:48:06'),
(11, 4, 10, 2, '2017-02-20 11:48:12'),
(12, 3, 10, 2, '2017-02-20 11:48:15'),
(13, 5, 10, 2, '2017-02-20 11:48:17'),
(14, 6, 10, 2, '2017-02-20 11:48:20'),
(15, 7, 10, 2, '2017-02-20 11:48:22'),
(16, 8, 10, 2, '2017-02-20 11:48:25');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_campo`
--

CREATE TABLE `tipo_campo` (
  `id_tipo_campo` int(11) NOT NULL,
  `tipo_campo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_campo`
--

INSERT INTO `tipo_campo` (`id_tipo_campo`, `tipo_campo`) VALUES
(1, 'LISTA'),
(2, 'TEXTO'),
(3, 'FECHA'),
(4, 'HORA'),
(5, 'DESDE_HASTA'),
(6, 'TEXT_AREA');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_proceso`
--

CREATE TABLE `tipo_proceso` (
  `id_tipo_proceso` int(11) NOT NULL,
  `icono` varchar(300) NOT NULL,
  `tipo_proceso` varchar(200) DEFAULT NULL,
  `id_usr_creo` int(11) DEFAULT NULL,
  `id_usr_modifico` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_proceso`
--

INSERT INTO `tipo_proceso` (`id_tipo_proceso`, `icono`, `tipo_proceso`, `id_usr_creo`, `id_usr_modifico`, `fecha_creacion`, `fecha_modificacion`, `estado`) VALUES
(1, 'ico_Proceso Retiro.png', 'RETIRO TEMPORAL', 2, 2, '2017-02-08 10:43:29', '2017-02-08 10:43:29', 'AC'),
(2, 'ico_Proceso Retiro.png', 'RETIRO DEFINITIVO', 2, 2, '2017-02-08 10:54:33', '2017-02-08 10:54:33', 'AC'),
(3, 'ico_Proceso Solicitud Excusa para profesores.png', 'SOLICITUD EXCUSA PARA PROFESORES', 2, NULL, '2017-02-08 11:06:03', '2017-02-08 11:06:03', 'AC'),
(4, 'ico_Proceso Solicitud Supletorio.png', 'SOLICITUD SUPLETORIO', 2, NULL, '2017-02-08 11:19:55', '2017-02-08 11:19:55', 'AC'),
(5, 'ico_Proceso Solicitud Reserva de Salones-Auditorios-Salas de C_mputo.png', 'SOLICITUD RESERVA DE ESPACIOS', 2, NULL, '2017-02-08 11:24:07', '2017-02-08 11:24:07', 'AC'),
(6, 'ico_Proceso Actualizacion Requisito Ingles.png', 'ACTUALIZACION REQUISITO DE INGLES', 2, 2, '2017-02-08 11:49:04', '2017-02-08 11:49:04', 'AC'),
(7, 'ico_Proceso Cambio Carga Academica.png', 'SOLICITUD CAMBIO DE CARGA ACADEMICA', 2, 2, '2017-02-08 11:59:44', '2017-02-08 11:59:44', 'AC'),
(8, 'ico_Proceso Solicitud Carta Empresaa.png', 'SOLICITUD CARTA DE PRESENTACION A EMPRESA', 2, NULL, '2017-02-08 12:10:29', '2017-02-08 12:10:29', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_proceso_campo`
--

CREATE TABLE `tipo_proceso_campo` (
  `id_tipo_proceso_campo` int(11) NOT NULL,
  `id_tipo_proceso` int(11) NOT NULL,
  `id_campo` int(11) NOT NULL,
  `id_usr_creo` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_proceso_campo`
--

INSERT INTO `tipo_proceso_campo` (`id_tipo_proceso_campo`, `id_tipo_proceso`, `id_campo`, `id_usr_creo`, `fecha_creacion`) VALUES
(1, 1, 1, 2, '2017-02-08 10:43:29'),
(2, 1, 2, 2, '2017-02-08 10:43:29'),
(3, 1, 3, 2, '2017-02-08 10:43:29'),
(4, 1, 4, 2, '2017-02-08 10:43:29'),
(5, 1, 43, 2, '2017-02-08 10:43:29'),
(6, 1, 45, 2, '2017-02-08 10:43:29'),
(7, 1, 7, 2, '2017-02-08 10:43:29'),
(8, 1, 13, 2, '2017-02-08 10:43:29'),
(9, 1, 14, 2, '2017-02-08 10:43:29'),
(10, 1, 20, 2, '2017-02-08 10:43:29'),
(11, 2, 1, 2, '2017-02-08 10:54:33'),
(12, 2, 2, 2, '2017-02-08 10:54:33'),
(13, 2, 3, 2, '2017-02-08 10:54:33'),
(14, 2, 4, 2, '2017-02-08 10:54:33'),
(15, 2, 5, 2, '2017-02-08 10:54:33'),
(16, 2, 7, 2, '2017-02-08 10:54:33'),
(17, 2, 13, 2, '2017-02-08 10:54:33'),
(18, 2, 14, 2, '2017-02-08 10:54:33'),
(19, 2, 20, 2, '2017-02-08 10:54:33'),
(20, 3, 1, 2, '2017-02-08 11:06:03'),
(21, 3, 2, 2, '2017-02-08 11:06:03'),
(22, 3, 3, 2, '2017-02-08 11:06:03'),
(23, 3, 4, 2, '2017-02-08 11:06:03'),
(24, 3, 7, 2, '2017-02-08 11:06:03'),
(25, 3, 13, 2, '2017-02-08 11:06:03'),
(26, 3, 20, 2, '2017-02-08 11:06:03'),
(27, 3, 26, 2, '2017-02-08 11:06:03'),
(28, 3, 28, 2, '2017-02-08 11:06:03'),
(29, 4, 1, 2, '2017-02-08 11:19:55'),
(30, 4, 2, 2, '2017-02-08 11:19:55'),
(31, 4, 3, 2, '2017-02-08 11:19:55'),
(32, 4, 4, 2, '2017-02-08 11:19:55'),
(33, 4, 13, 2, '2017-02-08 11:19:55'),
(34, 4, 20, 2, '2017-02-08 11:19:55'),
(35, 4, 25, 2, '2017-02-08 11:19:55'),
(36, 4, 26, 2, '2017-02-08 11:19:55'),
(37, 4, 28, 2, '2017-02-08 11:19:55'),
(38, 4, 29, 2, '2017-02-08 11:19:55'),
(39, 4, 30, 2, '2017-02-08 11:19:55'),
(40, 4, 31, 2, '2017-02-08 11:19:55'),
(41, 5, 2, 2, '2017-02-08 11:24:07'),
(42, 5, 3, 2, '2017-02-08 11:24:07'),
(43, 5, 4, 2, '2017-02-08 11:24:07'),
(44, 5, 13, 2, '2017-02-08 11:24:07'),
(45, 5, 20, 2, '2017-02-08 11:24:07'),
(46, 5, 32, 2, '2017-02-08 11:24:07'),
(47, 5, 33, 2, '2017-02-08 11:24:07'),
(48, 5, 34, 2, '2017-02-08 11:24:07'),
(49, 5, 35, 2, '2017-02-08 11:24:07'),
(50, 5, 36, 2, '2017-02-08 11:24:07'),
(51, 5, 37, 2, '2017-02-08 11:24:07'),
(52, 5, 38, 2, '2017-02-08 11:24:07'),
(53, 5, 39, 2, '2017-02-08 11:24:07'),
(54, 6, 1, 2, '2017-02-08 11:49:04'),
(55, 6, 2, 2, '2017-02-08 11:49:04'),
(56, 6, 3, 2, '2017-02-08 11:49:04'),
(57, 6, 4, 2, '2017-02-08 11:49:04'),
(58, 6, 13, 2, '2017-02-08 11:49:04'),
(59, 6, 20, 2, '2017-02-08 11:49:04'),
(60, 6, 40, 2, '2017-02-08 11:49:04'),
(61, 7, 1, 2, '2017-02-08 11:59:44'),
(62, 7, 2, 2, '2017-02-08 11:59:44'),
(63, 7, 3, 2, '2017-02-08 11:59:44'),
(64, 7, 4, 2, '2017-02-08 11:59:44'),
(65, 7, 13, 2, '2017-02-08 11:59:44'),
(66, 7, 20, 2, '2017-02-08 11:59:44'),
(67, 7, 41, 2, '2017-02-08 11:59:44'),
(68, 7, 42, 2, '2017-02-08 11:59:44'),
(69, 8, 1, 2, '2017-02-08 12:10:29'),
(70, 8, 2, 2, '2017-02-08 12:10:29'),
(71, 8, 3, 2, '2017-02-08 12:10:29'),
(72, 8, 13, 2, '2017-02-08 12:10:29'),
(73, 8, 21, 2, '2017-02-08 12:10:29'),
(74, 8, 22, 2, '2017-02-08 12:10:29'),
(75, 8, 23, 2, '2017-02-08 12:10:29'),
(76, 8, 25, 2, '2017-02-08 12:10:29'),
(77, 8, 28, 2, '2017-02-08 12:10:29'),
(78, 1, 44, 2, '2017-02-22 11:54:37'),
(79, 1, 46, 2, '2017-02-22 11:54:37'),
(80, 1, 47, 2, '2017-02-22 11:55:15');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(150) DEFAULT NULL,
  `nombres` varchar(150) DEFAULT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `clave` varchar(300) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `LDAP` varchar(5) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `nombres`, `apellidos`, `clave`, `correo`, `LDAP`, `estado`, `fecha_creacion`, `fecha_modificacion`) VALUES
(2, 'antares', 'Juan Camilo', 'Cruz Franco', 'f2ccf97e0987f5452ba6bf4e90560d7faf15f34030c2b1641294c0940edffc26eba798f6d372c72333a345006603f993b0a3d8e4bdadb2d96b43b65930b25335', 'kusanagimilo@gmail.com', 'NO', 'AC', '2016-11-14 03:08:36', '2016-11-14 15:08:36'),
(3, 'checho2_5', 'Diego', 'Eduardo', '4ee4b97f5f212fa8f491b5e27e7a461bfc9468965c4a0e78969ba330b551194de756d5b8d45805da3e6c9b7551241af19b1b1e69fc36784ca024de8b0f44ef41', 'checho2_7@hotmail.com', 'NO', 'AC', '2017-01-13 10:18:52', '2017-01-13 10:18:52'),
(4, 'kusanagimilo', 'Antares', 'Cruz', 'ba9b28c5bf9d2709c294f21e71c54c88132b4f6916e8073ced48f531443d443bce89707ef7be62dfcad9aa5b6f8ec853f4750b21756dfbf5ac2f78fd39595324', 'antares@gmail.com', 'NO', 'AC', '2017-01-18 03:30:37', '2017-01-18 15:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario_rol` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario_rol`
--

INSERT INTO `usuario_rol` (`id_usuario_rol`, `id_usuario`, `id_rol`, `fecha_creacion`) VALUES
(1, 2, 8, '2016-12-14 12:29:31'),
(2, 3, 10, '2017-01-13 10:18:52'),
(3, 4, 10, '2017-01-18 15:30:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campos`
--
ALTER TABLE `campos`
  ADD PRIMARY KEY (`id_campo`);

--
-- Indexes for table `caso`
--
ALTER TABLE `caso`
  ADD PRIMARY KEY (`id_caso`);

--
-- Indexes for table `dato`
--
ALTER TABLE `dato`
  ADD PRIMARY KEY (`id_dato`);

--
-- Indexes for table `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id_documento`);

--
-- Indexes for table `documento_caso`
--
ALTER TABLE `documento_caso`
  ADD PRIMARY KEY (`id_documento_caso`);

--
-- Indexes for table `documento_tipo_proceso`
--
ALTER TABLE `documento_tipo_proceso`
  ADD PRIMARY KEY (`id_documento_tipo_proceso`);

--
-- Indexes for table `estado_proceso`
--
ALTER TABLE `estado_proceso`
  ADD PRIMARY KEY (`id_estado_proceso`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id_links`);

--
-- Indexes for table `links_rol`
--
ALTER TABLE `links_rol`
  ADD PRIMARY KEY (`id_links_rol`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `rol_tipo_proceso`
--
ALTER TABLE `rol_tipo_proceso`
  ADD PRIMARY KEY (`id_rol_tipo_proceso`);

--
-- Indexes for table `tipo_campo`
--
ALTER TABLE `tipo_campo`
  ADD PRIMARY KEY (`id_tipo_campo`);

--
-- Indexes for table `tipo_proceso`
--
ALTER TABLE `tipo_proceso`
  ADD PRIMARY KEY (`id_tipo_proceso`);

--
-- Indexes for table `tipo_proceso_campo`
--
ALTER TABLE `tipo_proceso_campo`
  ADD PRIMARY KEY (`id_tipo_proceso_campo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id_usuario_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campos`
--
ALTER TABLE `campos`
  MODIFY `id_campo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `caso`
--
ALTER TABLE `caso`
  MODIFY `id_caso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `dato`
--
ALTER TABLE `dato`
  MODIFY `id_dato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `documento`
--
ALTER TABLE `documento`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `documento_caso`
--
ALTER TABLE `documento_caso`
  MODIFY `id_documento_caso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `documento_tipo_proceso`
--
ALTER TABLE `documento_tipo_proceso`
  MODIFY `id_documento_tipo_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `estado_proceso`
--
ALTER TABLE `estado_proceso`
  MODIFY `id_estado_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id_links` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `links_rol`
--
ALTER TABLE `links_rol`
  MODIFY `id_links_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `rol_tipo_proceso`
--
ALTER TABLE `rol_tipo_proceso`
  MODIFY `id_rol_tipo_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tipo_campo`
--
ALTER TABLE `tipo_campo`
  MODIFY `id_tipo_campo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tipo_proceso`
--
ALTER TABLE `tipo_proceso`
  MODIFY `id_tipo_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tipo_proceso_campo`
--
ALTER TABLE `tipo_proceso_campo`
  MODIFY `id_tipo_proceso_campo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usuario_rol`
--
ALTER TABLE `usuario_rol`
  MODIFY `id_usuario_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
