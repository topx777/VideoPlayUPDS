-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2018 a las 10:49:37
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nombreCategoria` varchar(45) NOT NULL,
  `icono` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentariovideo`
--

CREATE TABLE `comentariovideo` (
  `id_comentariovideo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  `comentario` longtext NOT NULL,
  `fechaComentario` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(55) NOT NULL,
  `email` varchar(95) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `fechaIngreso` datetime DEFAULT CURRENT_TIMESTAMP,
  `cantSuscriptores` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariofavorito`
--

CREATE TABLE `usuariofavorito` (
  `idUsuarioFavorito` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosucripcion`
--

CREATE TABLE `usuariosucripcion` (
  `idUsuarioSucripcion` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idSuscripcion` int(11) NOT NULL,
  `fechaSuscripcion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video`
--

CREATE TABLE `video` (
  `idVideo` int(11) NOT NULL,
  `codVideo` varchar(30) NOT NULL,
  `nombreVideo` varchar(50) NOT NULL,
  `descVideo` longtext,
  `fechaSubida` datetime DEFAULT CURRENT_TIMESTAMP,
  `cantVistas` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `categoria` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `directorio` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `duracion` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `comentariovideo`
--
ALTER TABLE `comentariovideo`
  ADD PRIMARY KEY (`id_comentariovideo`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idVideo` (`idVideo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `nombreUsuario_UNIQUE` (`nombreUsuario`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indices de la tabla `usuariofavorito`
--
ALTER TABLE `usuariofavorito`
  ADD PRIMARY KEY (`idUsuarioFavorito`),
  ADD KEY `usuario_favorito_idx` (`idUsuario`),
  ADD KEY `video_favorito_idx` (`idVideo`);

--
-- Indices de la tabla `usuariosucripcion`
--
ALTER TABLE `usuariosucripcion`
  ADD PRIMARY KEY (`idUsuarioSucripcion`),
  ADD KEY `Usuario_suscrito_idx` (`idUsuario`),
  ADD KEY `Usuario_suscripcion_idx` (`idSuscripcion`);

--
-- Indices de la tabla `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`idVideo`),
  ADD UNIQUE KEY `codVideo_UNIQUE` (`codVideo`),
  ADD KEY `video_categoria_idx` (`categoria`),
  ADD KEY `video_usuario_idx` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comentariovideo`
--
ALTER TABLE `comentariovideo`
  MODIFY `id_comentariovideo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuariofavorito`
--
ALTER TABLE `usuariofavorito`
  MODIFY `idUsuarioFavorito` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `video`
--
ALTER TABLE `video`
  MODIFY `idVideo` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentariovideo`
--
ALTER TABLE `comentariovideo`
  ADD CONSTRAINT `comentariovideo_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comentariovideo_ibfk_2` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuariofavorito`
--
ALTER TABLE `usuariofavorito`
  ADD CONSTRAINT `usuario_favorito` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `video_favorito` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuariosucripcion`
--
ALTER TABLE `usuariosucripcion`
  ADD CONSTRAINT `Usuario_suscripcion` FOREIGN KEY (`idSuscripcion`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Usuario_suscrito` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`idCategoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `video_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`idUsuario`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
