-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2020 a las 19:21:40
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbventaslarabel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `idArticulo` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `Codigo` varchar(50) DEFAULT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Descripcion` varchar(512) DEFAULT NULL,
  `Imagen` varchar(50) DEFAULT NULL,
  `Estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`idArticulo`, `idCategoria`, `Codigo`, `Nombre`, `Stock`, `Descripcion`, `Imagen`, `Estado`) VALUES
(1, 1, '0001', 'Impresora Epson', 10, NULL, 'impresora.jpg', 'Inactivo'),
(2, 1, '0002', 'Impresora Epson', 15, 'impresora', 'impre.jpg', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(256) DEFAULT NULL,
  `Condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Nombre`, `Descripcion`, `Condicion`) VALUES
(1, 'Equipos de Cómputo', 'Accesorios de cómputo', 1),
(2, 'Limpieza', 'Artículos de limpieza', 1),
(3, 'Comestible', 'Artículos comestibles', 1),
(4, 'Líquidos', 'Productos líquidos', 1),
(5, 'Perfumería', 'Artículos de perfumería ', 1),
(6, 'Bazar', 'Artículos de bazar', 1),
(7, 'Lácteos', 'Productos lácteos', 1),
(8, 'Golosinas', 'Artículos de golosinas', 1),
(9, 'Juguetes', 'Accesorios de juguetes', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ingreso`
--

CREATE TABLE `detalle_ingreso` (
  `idDetalle_ingreso` int(11) NOT NULL,
  `idIngreso` int(11) NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio_compra` decimal(11,2) NOT NULL,
  `Precio_venta` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `idDetalle_venta` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio_venta` decimal(11,2) NOT NULL,
  `Descuento` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `idIngreso` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `Tipo_comprobante` varchar(20) NOT NULL,
  `Serie_comprobante` varchar(7) DEFAULT NULL,
  `Num_comprobante` varchar(10) NOT NULL,
  `Fecha_hora` datetime NOT NULL,
  `Impuesto` decimal(4,2) NOT NULL,
  `Estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`idIngreso`, `idProveedor`, `Tipo_comprobante`, `Serie_comprobante`, `Num_comprobante`, `Fecha_hora`, `Impuesto`, `Estado`) VALUES
(1, 4, 'Boleta', '007', '0008', '2016-01-23 21:00:08', '18.00', 'A'),
(2, 4, 'Boleta', '004', '00010', '2014-10-05 07:38:22', '18.00', 'A'),
(3, 4, 'Boleta', '001', '0005', '2019-01-28 10:18:54', '18.00', 'A'),
(4, 4, 'Boleta', '006', '0001', '2016-11-18 09:32:17', '18.00', 'A'),
(5, 4, 'Boleta', '002', '0007', '2011-04-10 12:37:47', '18.00', 'A'),
(6, 4, 'Boleta', '003', '0001', '2015-02-25 08:35:20', '18.00', 'A'),
(7, 4, 'Boleta', '001', '0001', '2010-05-31 12:10:33', '18.00', 'A'),
(8, 4, 'Factura', '001', '0001', '2010-06-24 09:36:00', '18.00', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idPersona` int(11) NOT NULL,
  `Tipo_persona` varchar(20) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Tipo_documento` varchar(20) DEFAULT NULL,
  `Num_documento` varchar(15) DEFAULT NULL,
  `Direccion` varchar(70) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idPersona`, `Tipo_persona`, `Nombre`, `Tipo_documento`, `Num_documento`, `Direccion`, `Telefono`, `Email`) VALUES
(1, 'Cliente', 'Paula Robles', 'DNI', '24551002', 'Las Heras 222', '03865-421563', 'pr90@gmail.com'),
(2, 'Cliente', 'Jorge Contreras', 'DNI', '33754187', 'Suipacha 1054', '03865-745895', 'jorgecont@gmail.com'),
(3, 'Cliente', 'Lautaro Soria', 'PAS', '34120415', 'San Martín 2014', NULL, NULL),
(4, 'Proveedor', 'Soluciones Innovadoras S.A', 'DNI', '44561234', 'Laprida 105', '01147112466', 'solucionesin@gmail.com'),
(5, 'Inactivo', 'Insumos Informático S.A', 'DOC', '24000458', 'Juangorena 1000', '03657588454', 'insumos3@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idVenta` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `Tipo_comprobante` varchar(20) NOT NULL,
  `Serie_comprobante` varchar(7) NOT NULL,
  `Num_comprobante` varchar(10) NOT NULL,
  `Fecha_hora` datetime NOT NULL,
  `Impuesto` decimal(4,2) NOT NULL,
  `Total_venta` decimal(11,2) NOT NULL,
  `Estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`idArticulo`),
  ADD KEY `fk_articulo_categoria_idx` (`idCategoria`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD PRIMARY KEY (`idDetalle_ingreso`),
  ADD KEY `fk_detalle_ingreso_idx` (`idIngreso`),
  ADD KEY `fk_detalle_ingreso_articulo_idx` (`idArticulo`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`idDetalle_venta`),
  ADD KEY `fk_detalle_venta_articulo_idx` (`idArticulo`),
  ADD KEY `fk_detalle_venta_idx` (`idVenta`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`idIngreso`),
  ADD KEY `fk_ingreso_persona_idx` (`idProveedor`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `fk_venta_cliente_idx` (`idCliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idArticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  MODIFY `idDetalle_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `idDetalle_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `idIngreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `fk_articulo_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD CONSTRAINT `fk_detalle_ingreso` FOREIGN KEY (`idIngreso`) REFERENCES `ingreso` (`idIngreso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ingreso_articulo` FOREIGN KEY (`idArticulo`) REFERENCES `articulo` (`idArticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_articulo` FOREIGN KEY (`idArticulo`) REFERENCES `articulo` (`idArticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `fk_ingreso_persona` FOREIGN KEY (`idProveedor`) REFERENCES `persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`idCliente`) REFERENCES `persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
