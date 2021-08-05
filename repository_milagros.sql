-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-08-2021 a las 04:25:14
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `repository_milagros`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `counters` ()  BEGIN
select count(nombre_archivo) into @publish from alumno,persona,archivo where persona.id_persona = alumno.id_persona and persona.id_persona = archivo.id_persona and estado = 1;
select count(nombre_archivo) into @obser from alumno,persona,archivo where persona.id_persona = alumno.id_persona and persona.id_persona = archivo.id_persona and estado = 2;
select count(nombre_archivo) into @pendin from alumno,persona,archivo where persona.id_persona = alumno.id_persona and persona.id_persona = archivo.id_persona and estado = 3;
select count(nombre_archivo) into @remov from alumno,persona,archivo where persona.id_persona = alumno.id_persona and persona.id_persona = archivo.id_persona and estado = 4;
select @publish,@obser,@pendin,@remov;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `count_resources` (IN `cod_user` VARCHAR(10))  BEGIN
	if exists(select id_persona from docente where codigo_docente = cod_user) then
    select id_persona into @id from docente where codigo_docente = cod_user;
    elseif exists (select id_persona from alumno where codigo_alumno = cod_user) then
    select id_persona into @id from alumno where codigo_alumno = cod_user;
    else 
    select 0 into @id;
    end if;
    select count(nombre_archivo) into @publicados from archivo where estado = 1 and id_persona = @id;
	select count(nombre_archivo) into @observados from archivo where estado = 2 and id_persona = @id;
	select count(nombre_archivo) into @pendientes from archivo where estado = 3 and id_persona = @id;
	select count(nombre_archivo) into @removidos from archivo where estado = 4 and id_persona = @id;
	select @publicados,@observados,@pendientes,@removidos;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `curses` (IN `cod` VARCHAR(20))  BEGIN
	if exists(select nombre_materia, id_materia,codigo_alumno from alumno,seccion,materia where seccion.id_seccion = alumno.id_seccion and seccion.id_seccion = materia.id_seccion and codigo_alumno = cod) then
    select nombre_materia, id_materia,codigo_alumno from alumno,seccion,materia where seccion.id_seccion = alumno.id_seccion and seccion.id_seccion = materia.id_seccion and codigo_alumno = cod;
    else 
    select nombre_materia from materia group by nombre_materia;
    end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `user_` VARCHAR(50))  BEGIN
set @codigo=null;
	if exists (select codigo_alumno from persona,alumno where persona.id_persona = alumno.id_persona and usuario = user_)then 
		select codigo_alumno into @codigo from persona,alumno where persona.id_persona = alumno.id_persona and usuario = user_;
	elseif exists (select codigo_docente from persona,docente where persona.id_persona = docente.id_persona and usuario = user_) then
		select codigo_docente into @codigo from persona,docente where persona.id_persona = docente.id_persona and usuario = user_;
	end if;
    select @codigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `my_resources` (IN `cod_user` VARCHAR(10), IN `type_query` INT(2))  BEGIN
		if exists(select id_persona from docente where codigo_docente = cod_user) then
			select id_persona into @id from docente where codigo_docente = cod_user;
        elseif exists(select id_persona from alumno where codigo_alumno = cod_user) then
			select id_persona into @id from alumno where codigo_alumno = cod_user;
		else
            select 0 into @id;
		end if;
	if(type_query = 1) then
		
		select nombre_archivo,nombre_materia,fecha_subida,fecha_publicacion,estado,nombre_tipo,id_archivo from archivo,materia,tipo_archivo where tipo_archivo.id_tipo = archivo.id_tipo and materia.id_materia = archivo.id_materia and  id_persona = @id and estado = 1;
	elseif (type_query = 2) then
        select nombre_archivo,nombre_materia,fecha_subida,fecha_publicacion,estado,nombre_tipo,id_archivo from archivo,materia,tipo_archivo where tipo_archivo.id_tipo = archivo.id_tipo and materia.id_materia = archivo.id_materia and  id_persona = @id and estado = 2;
	elseif(type_query = 3)then
		select nombre_archivo,nombre_materia,fecha_subida,fecha_publicacion,estado,nombre_tipo,id_archivo from archivo,materia,tipo_archivo where tipo_archivo.id_tipo = archivo.id_tipo and materia.id_materia = archivo.id_materia and  id_persona = @id and estado = 3;
	elseif(type_query = 4)then
		select nombre_archivo,nombre_materia,fecha_subida,fecha_publicacion,estado,nombre_tipo,id_archivo from archivo,materia,tipo_archivo where tipo_archivo.id_tipo = archivo.id_tipo and materia.id_materia = archivo.id_materia and  id_persona = @id and estado = 4;
	else
    select "no data"  as resultado;
    end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_persona` (IN `codigo` VARCHAR(10))  BEGIN
	if exists(select id_persona from docente where codigo_docente = codigo) then
    select id_persona from docente where codigo_docente = codigo;
    elseif exists(select id_persona from alumno where codigo_alumno = codigo) then
    select id_persona from alumno where codigo_alumno = codigo;
    else 
    select "no data" as id;
    end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registro_resource` (IN `file_` VARCHAR(350), IN `tipo` VARCHAR(50), IN `title` VARCHAR(200), IN `id_curse` INT(11), IN `date_s` VARCHAR(20), IN `codigo` VARCHAR(20), IN `descript` VARCHAR(1500), IN `formate` VARCHAR(10))  BEGIN
	select id_persona into @id from alumno where codigo_alumno = codigo;
    select id_categoria into @categoria from categoria_archivo where nombre_categoria like tipo;
    select id_tipo into @tipo from tipo_archivo where nombre_tipo like formate;
    select id_seccion into @seccion from materia where id_materia = id_curse;
    
    insert into archivo(nombre_archivo,descripcion,fecha_subida,estado,ubicacion,id_persona,id_seccion,id_tipo,id_categoria,id_materia) 
    values(title,descript,date_s,3,file_,@id,@seccion,@tipo,@categoria,id_curse);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `resourse_persona` (IN `code_user` VARCHAR(10))  BEGIN
set @extracting = substring(code_user,1,2);
    if(INSTR(@extracting , 'DC')>0) then 
		select id_persona into @id_p from docente where codigo_docente = code_user;
		/*select @id_p;*/
		if exists(select count(nombre_archivo) from archivo,categoria_archivo where categoria_archivo.id_categoria = archivo.id_categoria and id_persona = @id_p group by tipo_categoria) then
			select count(nombre_archivo) from archivo,categoria_archivo where categoria_archivo.id_categoria = archivo.id_categoria and id_persona = @id_p group by tipo_categoria;
        else
			select "no data" as dato;
		end if;
    elseif(INSTR(@extracting , 'AL')>0) then
		select id_persona into @id_p from alumno where codigo_alumno = code_user;
		/*select @id_p;*/
		IF exists(select count(nombre_archivo) from archivo,categoria_archivo where categoria_archivo.id_categoria = archivo.id_categoria and id_persona = @id_p group by tipo_categoria) then
			select count(nombre_archivo) from archivo,categoria_archivo where categoria_archivo.id_categoria = archivo.id_categoria and id_persona = @id_p group by tipo_categoria;
		else
			select "no data" as dato;
            end if;
    end if;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `id_seccion` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `codigo_alumno` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `id_docente`, `id_seccion`, `id_persona`, `codigo_alumno`) VALUES
(1, 1, 8, 2, 'AL_1'),
(3, 1, 7, 4, 'AL_2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE `archivo` (
  `id_archivo` int(11) NOT NULL,
  `nombre_archivo` varchar(100) DEFAULT NULL,
  `tema` varchar(50) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fecha_publicacion` date DEFAULT NULL,
  `fecha_subida` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `ubicacion` varchar(200) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_seccion` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `archivo`
--

INSERT INTO `archivo` (`id_archivo`, `nombre_archivo`, `tema`, `descripcion`, `fecha_publicacion`, `fecha_subida`, `fecha_baja`, `estado`, `ubicacion`, `id_persona`, `id_seccion`, `id_tipo`, `id_categoria`, `id_materia`) VALUES
(1, 'solo se aceptan estos formatos', 'Informacion', 'El presente archivo tiene como objetivo el informar a los usuarios los tipos de archivos permitidos subir a la plataforma', '2021-07-19', '2021-07-19', '0000-00-00', 2, 'pdf1.pdf', 1, 1, 2, 2, 2),
(2, 'Formatos aceptados', 'Informacion', 'El presente archivo tiene como objetivo el informar a los usuarios los tipos de archivos permitidos subir a la plataforma', '2021-07-19', '2021-07-19', '0000-00-00', 1, 'pdf1.pdf', 1, 1, 2, 2, 2),
(3, 'solo se aceptan estos formatos', 'Informacion', 'El presente archivo tiene como objetivo el informar a los usuarios los tipos de archivos permitidos subir a la plataforma', '2021-07-19', '2021-07-19', '0000-00-00', 3, 'pdf1.pdf', 1, 1, 2, 1, 2),
(4, 'solo se aceptan estos formatos', 'Informacion', 'El presente archivo tiene como objetivo el informar a los usuarios los tipos de archivos permitidos subir a la plataforma', '2021-07-19', '2021-07-19', '0000-00-00', 1, 'pdf1.pdf', 1, 1, 3, 1, 2),
(5, 'solo se aceptan estos formatos', 'Informacion', 'El presente archivo tiene como objetivo el informar a los usuarios los tipos de archivos permitidos subir a la plataforma', '2021-07-19', '2021-07-19', '0000-00-00', 1, 'pdf1.pdf', 1, 1, 1, 1, 2),
(6, 'solo se aceptan estos formatos', 'Informacion', 'El presente archivo tiene como objetivo el informar a los usuarios los tipos de archivos permitidos subir a la plataforma', '2021-07-19', '2021-07-19', '0000-00-00', 1, 'pdf1.pdf', 1, 1, 2, 3, 2),
(7, 'solo se aceptan estos formatos', 'Informacion', 'El presente archivo tiene como objetivo el informar a los usuarios los tipos de archivos permitidos subir a la plataforma', '2021-07-19', '2021-07-19', '0000-00-00', 1, 'pdf1.pdf', 1, 1, 2, 3, 3),
(8, 'solo se aceptan estos formatos', 'Informacion', 'El presente archivo tiene como objetivo el informar a los usuarios los tipos de archivos permitidos subir a la plataforma', '2021-07-19', '2021-07-19', '0000-00-00', 4, 'pdf1.pdf', 1, 1, 2, 3, 5),
(9, 'Archivos como estos', 'Informacion', 'El presente archivo tiene como objetivo el informar a los usuarios los tipos de archivos permitidos subir a la plataforma', '2021-07-19', '2021-07-19', '0000-00-00', 1, 'pdf1.pdf', 2, 1, 3, 3, 5),
(23, 'metodos de busqueda', NULL, 'es un archivo de datos relacionados al tema buscado', NULL, '2021-08-02', NULL, 3, 'metodos-de-busqueda.pdf', 4, 7, 2, 2, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_archivo`
--

CREATE TABLE `categoria_archivo` (
  `id_categoria` int(11) NOT NULL,
  `tipo_categoria` varchar(20) DEFAULT NULL,
  `nombre_categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_archivo`
--

INSERT INTO `categoria_archivo` (`id_categoria`, `tipo_categoria`, `nombre_categoria`) VALUES
(1, 'T1', 'Trabajos'),
(2, 'I1', 'Investigacion'),
(3, 'L1', 'Libro');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `category`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `category` (
`nombre_materia` varchar(20)
,`cantidad` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL,
  `tutoria` int(1) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL,
  `id_seccion` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `codigo_docente` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id_docente`, `tutoria`, `id_materia`, `id_seccion`, `id_persona`, `codigo_docente`) VALUES
(1, 1, 2, 1, 1, 'DC_1');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `edith_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `edith_view` (
`nombre_archivo` varchar(100)
,`extencion` varchar(50)
,`nombre_categoria` varchar(50)
,`text_grado` varchar(20)
,`letra_g` varchar(2)
,`fecha_subida` date
,`fecha_baja` date
,`ubicacion` varchar(200)
,`descripcion` varchar(500)
,`nombre_materia` varchar(20)
,`estado` int(1)
,`id_archivo` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id_grado` int(11) NOT NULL,
  `nro_grado` int(2) DEFAULT NULL,
  `text_grado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `nro_grado`, `text_grado`) VALUES
(1, 5, 'Quinto'),
(3, 1, 'Primero'),
(4, 2, 'Segundo'),
(5, 3, 'Tercero'),
(6, 4, 'Cuarto'),
(7, 6, 'Todos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `nombre_materia` varchar(20) DEFAULT NULL,
  `id_seccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `nombre_materia`, `id_seccion`) VALUES
(2, 'Matematicas', 1),
(3, 'Quimica', 1),
(5, 'Arte', 1),
(6, 'Historia', 1),
(7, 'Fisica', 1),
(8, 'Geografia', 1),
(9, 'Computacion', 1),
(10, 'Arte', 3),
(11, 'Historia', 3),
(12, 'Fisica', 3),
(13, 'Geografia', 3),
(14, 'Computacion', 3),
(15, 'Quimica', 3),
(16, 'Arte', 4),
(17, 'Historia', 4),
(18, 'Fisica', 4),
(19, 'Geografia', 4),
(20, 'Computacion', 4),
(21, 'Quimica', 4),
(22, 'Arte', 5),
(23, 'Historia', 5),
(24, 'Fisica', 5),
(25, 'Geografia', 5),
(26, 'Computacion', 5),
(27, 'Quimica', 5),
(28, 'Arte', 6),
(29, 'Historia', 6),
(30, 'Fisica', 6),
(31, 'Geografia', 6),
(32, 'Computacion', 6),
(33, 'Quimica', 6),
(34, 'Arte', 7),
(35, 'Historia', 7),
(36, 'Fisica', 7),
(37, 'Geografia', 7),
(38, 'Computacion', 7),
(39, 'Quimica', 7),
(42, 'Arte', 8),
(43, 'Historia', 8),
(44, 'Fisica', 8),
(45, 'Geografia', 8),
(46, 'Computación', 8),
(47, 'Química', 8),
(48, 'Matematicas', 3),
(49, 'Matematicas', 4),
(50, 'Matematicas', 5),
(51, 'Matematicas', 6),
(52, 'Matematicas', 7),
(53, 'Matematicas', 8);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `materia_alumnos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `materia_alumnos` (
`nombre_materia` varchar(20)
,`id_materia` int(11)
,`codigo_alumno` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `perfil_alumno`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `perfil_alumno` (
`nombre_persona` varchar(20)
,`apellido_persona` varchar(40)
,`fecha_nacimiento` date
,`edad` int(2)
,`estado_user` int(1)
,`genero` varchar(20)
,`usuario` varchar(50)
,`codigo_alumno` varchar(10)
,`letra_g` varchar(2)
,`text_grado` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `perfil_docente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `perfil_docente` (
`nombre_persona` varchar(20)
,`apellido_persona` varchar(40)
,`fecha_nacimiento` date
,`edad` int(2)
,`estado_user` int(1)
,`genero` varchar(20)
,`usuario` varchar(50)
,`codigo_docente` varchar(10)
,`nombre_materia` varchar(20)
,`letra_g` varchar(2)
,`text_grado` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `nombre_persona` varchar(20) DEFAULT NULL,
  `apellido_persona` varchar(40) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `edad` int(2) DEFAULT NULL,
  `estado_user` int(1) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `clave` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `nombre_persona`, `apellido_persona`, `fecha_nacimiento`, `edad`, `estado_user`, `genero`, `usuario`, `clave`) VALUES
(1, 'Fernando', 'Flores Condori', '1999-02-28', 22, 1, 'MASCULINO', 'ffloresc@gmail.com', '123fernando'),
(2, 'Erik', 'Perez Loayza', '2006-02-28', 15, 1, 'MASCULINO', 'perez@gmail.com', '123perez'),
(4, 'Mark', 'Morales Rath', '2007-06-12', 14, 1, 'MASCULINO', 'mark@gmail.com', '123mark');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `reading`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `reading` (
`nombre_tipo` varchar(50)
,`estado` int(1)
,`nombre_archivo` varchar(100)
,`ubicacion` varchar(200)
,`fecha_publicacion` date
,`fecha_subida` date
,`fecha_baja` date
,`text_grado` varchar(20)
,`nombre_categoria` varchar(50)
,`nombre_materia` varchar(20)
,`nombre_persona` varchar(20)
,`apellido_persona` varchar(40)
,`letra_g` varchar(2)
,`descripcion` varchar(500)
,`id_archivo` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `resource_alum`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `resource_alum` (
`nombre_archivo` varchar(100)
,`nombre_materia` varchar(20)
,`fecha_subida` date
,`fecha_publicacion` date
,`estado` int(1)
,`nombre_tipo` varchar(50)
,`id_archivo` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `resourses_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `resourses_view` (
`nombre_archivo` varchar(100)
,`fecha_publicacion` date
,`estado` int(1)
,`nombre_tipo` varchar(50)
,`nombre_categoria` varchar(50)
,`text_grado` varchar(20)
,`nombre_materia` varchar(20)
,`id_persona` int(11)
,`id_archivo` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id_seccion` int(11) NOT NULL,
  `letra_g` varchar(2) DEFAULT NULL,
  `id_grado` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id_seccion`, `letra_g`, `id_grado`) VALUES
(1, 'A', 1),
(3, 'A', 7),
(4, 'A', 3),
(5, 'A', 4),
(6, 'A', 5),
(7, 'A', 6),
(8, 'B', 1),
(10, 'B', 3),
(11, 'B', 4),
(12, 'B', 5),
(13, 'B', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_archivo`
--

CREATE TABLE `tipo_archivo` (
  `id_tipo` int(11) NOT NULL,
  `nombre_tipo` varchar(50) DEFAULT NULL,
  `extencion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_archivo`
--

INSERT INTO `tipo_archivo` (`id_tipo`, `nombre_tipo`, `extencion`) VALUES
(1, 'Docx.', 'Documento Word'),
(2, 'PDF.', 'Documento PDF'),
(3, 'xlsx.', 'Documento Excel');

-- --------------------------------------------------------

--
-- Estructura para la vista `category`
--
DROP TABLE IF EXISTS `category`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `category`  AS SELECT `materia`.`nombre_materia` AS `nombre_materia`, count(`archivo`.`id_archivo`) AS `cantidad` FROM (`archivo` join `materia`) WHERE `materia`.`id_materia` = `archivo`.`id_materia` GROUP BY `materia`.`nombre_materia` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `edith_view`
--
DROP TABLE IF EXISTS `edith_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `edith_view`  AS SELECT `archivo`.`nombre_archivo` AS `nombre_archivo`, `tipo_archivo`.`extencion` AS `extencion`, `categoria_archivo`.`nombre_categoria` AS `nombre_categoria`, `grado`.`text_grado` AS `text_grado`, `seccion`.`letra_g` AS `letra_g`, `archivo`.`fecha_subida` AS `fecha_subida`, `archivo`.`fecha_baja` AS `fecha_baja`, `archivo`.`ubicacion` AS `ubicacion`, `archivo`.`descripcion` AS `descripcion`, `materia`.`nombre_materia` AS `nombre_materia`, `archivo`.`estado` AS `estado`, `archivo`.`id_archivo` AS `id_archivo` FROM (((((`archivo` join `categoria_archivo`) join `tipo_archivo`) join `grado`) join `seccion`) join `materia`) WHERE `grado`.`id_grado` = `seccion`.`id_grado` AND `seccion`.`id_seccion` = `materia`.`id_seccion` AND `archivo`.`id_materia` = `materia`.`id_materia` AND `archivo`.`id_categoria` = `categoria_archivo`.`id_categoria` AND `archivo`.`id_tipo` = `tipo_archivo`.`id_tipo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `materia_alumnos`
--
DROP TABLE IF EXISTS `materia_alumnos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `materia_alumnos`  AS SELECT `materia`.`nombre_materia` AS `nombre_materia`, `materia`.`id_materia` AS `id_materia`, `alumno`.`codigo_alumno` AS `codigo_alumno` FROM ((`alumno` join `seccion`) join `materia`) WHERE `seccion`.`id_seccion` = `alumno`.`id_seccion` AND `seccion`.`id_seccion` = `materia`.`id_seccion` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `perfil_alumno`
--
DROP TABLE IF EXISTS `perfil_alumno`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perfil_alumno`  AS SELECT `persona`.`nombre_persona` AS `nombre_persona`, `persona`.`apellido_persona` AS `apellido_persona`, `persona`.`fecha_nacimiento` AS `fecha_nacimiento`, `persona`.`edad` AS `edad`, `persona`.`estado_user` AS `estado_user`, `persona`.`genero` AS `genero`, `persona`.`usuario` AS `usuario`, `alumno`.`codigo_alumno` AS `codigo_alumno`, `seccion`.`letra_g` AS `letra_g`, `grado`.`text_grado` AS `text_grado` FROM (((`persona` join `alumno`) join `seccion`) join `grado`) WHERE `persona`.`id_persona` = `alumno`.`id_persona` AND `grado`.`id_grado` = `seccion`.`id_grado` AND `seccion`.`id_seccion` = `alumno`.`id_seccion` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `perfil_docente`
--
DROP TABLE IF EXISTS `perfil_docente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perfil_docente`  AS SELECT `persona`.`nombre_persona` AS `nombre_persona`, `persona`.`apellido_persona` AS `apellido_persona`, `persona`.`fecha_nacimiento` AS `fecha_nacimiento`, `persona`.`edad` AS `edad`, `persona`.`estado_user` AS `estado_user`, `persona`.`genero` AS `genero`, `persona`.`usuario` AS `usuario`, `docente`.`codigo_docente` AS `codigo_docente`, `materia`.`nombre_materia` AS `nombre_materia`, `seccion`.`letra_g` AS `letra_g`, `grado`.`text_grado` AS `text_grado` FROM ((((`persona` join `docente`) join `materia`) join `seccion`) join `grado`) WHERE `persona`.`id_persona` = `docente`.`id_persona` AND `docente`.`id_materia` = `materia`.`id_materia` AND `grado`.`id_grado` = `seccion`.`id_grado` AND `seccion`.`id_seccion` = `materia`.`id_seccion` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `reading`
--
DROP TABLE IF EXISTS `reading`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reading`  AS SELECT `tipo_archivo`.`nombre_tipo` AS `nombre_tipo`, `archivo`.`estado` AS `estado`, `archivo`.`nombre_archivo` AS `nombre_archivo`, `archivo`.`ubicacion` AS `ubicacion`, `archivo`.`fecha_publicacion` AS `fecha_publicacion`, `archivo`.`fecha_subida` AS `fecha_subida`, `archivo`.`fecha_baja` AS `fecha_baja`, `grado`.`text_grado` AS `text_grado`, `categoria_archivo`.`nombre_categoria` AS `nombre_categoria`, `materia`.`nombre_materia` AS `nombre_materia`, `persona`.`nombre_persona` AS `nombre_persona`, `persona`.`apellido_persona` AS `apellido_persona`, `seccion`.`letra_g` AS `letra_g`, `archivo`.`descripcion` AS `descripcion`, `archivo`.`id_archivo` AS `id_archivo` FROM ((((((`grado` join `seccion`) join `materia`) join `tipo_archivo`) join `categoria_archivo`) join `archivo`) join `persona`) WHERE `grado`.`id_grado` = `seccion`.`id_grado` AND `seccion`.`id_seccion` = `materia`.`id_seccion` AND `materia`.`id_materia` = `archivo`.`id_materia` AND `categoria_archivo`.`id_categoria` = `archivo`.`id_categoria` AND `tipo_archivo`.`id_tipo` = `archivo`.`id_tipo` AND `persona`.`id_persona` = `archivo`.`id_persona` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `resource_alum`
--
DROP TABLE IF EXISTS `resource_alum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `resource_alum`  AS SELECT `archivo`.`nombre_archivo` AS `nombre_archivo`, `materia`.`nombre_materia` AS `nombre_materia`, `archivo`.`fecha_subida` AS `fecha_subida`, `archivo`.`fecha_publicacion` AS `fecha_publicacion`, `archivo`.`estado` AS `estado`, `tipo_archivo`.`nombre_tipo` AS `nombre_tipo`, `archivo`.`id_archivo` AS `id_archivo` FROM ((((`archivo` join `materia`) join `tipo_archivo`) join `alumno`) join `persona`) WHERE `tipo_archivo`.`id_tipo` = `archivo`.`id_tipo` AND `materia`.`id_materia` = `archivo`.`id_materia` AND `persona`.`id_persona` = `alumno`.`id_persona` AND `persona`.`id_persona` = `archivo`.`id_persona` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `resourses_view`
--
DROP TABLE IF EXISTS `resourses_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `resourses_view`  AS SELECT `archivo`.`nombre_archivo` AS `nombre_archivo`, `archivo`.`fecha_publicacion` AS `fecha_publicacion`, `archivo`.`estado` AS `estado`, `tipo_archivo`.`nombre_tipo` AS `nombre_tipo`, `categoria_archivo`.`nombre_categoria` AS `nombre_categoria`, `grado`.`text_grado` AS `text_grado`, `materia`.`nombre_materia` AS `nombre_materia`, `archivo`.`id_persona` AS `id_persona`, `archivo`.`id_archivo` AS `id_archivo` FROM (((((`archivo` join `tipo_archivo`) join `categoria_archivo`) join `seccion`) join `grado`) join `materia`) WHERE `tipo_archivo`.`id_tipo` = `archivo`.`id_tipo` AND `categoria_archivo`.`id_categoria` = `archivo`.`id_categoria` AND `grado`.`id_grado` = `seccion`.`id_grado` AND `seccion`.`id_seccion` = `materia`.`id_seccion` AND `materia`.`id_materia` = `archivo`.`id_materia` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indices de la tabla `categoria_archivo`
--
ALTER TABLE `categoria_archivo`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id_docente`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`),
  ADD KEY `id_seccion` (`id_seccion`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id_seccion`),
  ADD KEY `id_grado` (`id_grado`);

--
-- Indices de la tabla `tipo_archivo`
--
ALTER TABLE `tipo_archivo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `archivo`
--
ALTER TABLE `archivo`
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `categoria_archivo`
--
ALTER TABLE `categoria_archivo`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tipo_archivo`
--
ALTER TABLE `tipo_archivo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD CONSTRAINT `archivo_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_archivo` (`id_categoria`),
  ADD CONSTRAINT `archivo_ibfk_2` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_archivo` (`id_tipo`);

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id_seccion`);

--
-- Filtros para la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD CONSTRAINT `seccion_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
