-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2024 a las 23:58:16
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fts`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `initialize_inventario_ids` ()   BEGIN
  DECLARE finished INTEGER DEFAULT 0;
  DECLARE inv_id INT;
  DECLARE cur CURSOR FOR SELECT id_inventario FROM inventario WHERE id_inventario IS NULL OR id_inventario = 0;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;

  OPEN cur;

  get_inv: LOOP
    FETCH cur INTO inv_id;
    IF finished THEN
      LEAVE get_inv;
    END IF;

    SET inv_id = FLOOR(100 + RAND() * 900); -- Genera un número aleatorio de tres dígitos

    UPDATE inventario
    SET id_inventario = inv_id
    WHERE id_inventario IS NULL OR id_inventario = 0;

  END LOOP get_inv;

  CLOSE cur;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `descripcion_categoria` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`) VALUES
(1, 'd', 'dd'),
(123, '111', 'ddd'),
(150, 'Deportivo', 'Productos para uso deportivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id_entrada` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id_entrada`, `fecha`, `id_producto`, `cantidad`, `id_proveedor`) VALUES
(2434, '2024-06-08', 123, 10, 201),
(123455, '2024-06-21', 123, 20, 201);

--
-- Disparadores `entradas`
--
DELIMITER $$
CREATE TRIGGER `after_entrada_delete` AFTER DELETE ON `entradas` FOR EACH ROW BEGIN
    UPDATE inventario
    SET cantidad_disponible = cantidad_disponible - OLD.cantidad, fecha_actualizacion = CURRENT_DATE()
    WHERE id_producto = OLD.id_producto;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_entrada_insert` AFTER INSERT ON `entradas` FOR EACH ROW BEGIN
    DECLARE nombre_producto VARCHAR(255);
    DECLARE inv_id INT;

    -- Obtener el nombre del producto de la tabla productos
    SELECT nombre INTO nombre_producto FROM productos WHERE id_producto = NEW.id_producto;

    -- Generar un ID único de tres dígitos para el inventario si es necesario
    SET inv_id = (SELECT id_inventario FROM inventario WHERE id_producto = NEW.id_producto);
    IF inv_id IS NULL THEN
        SET inv_id = FLOOR(100 + RAND() * 900);
        INSERT INTO inventario (id_inventario, id_producto, nombre_producto, cantidad_disponible, fecha_actualizacion)
        VALUES (inv_id, NEW.id_producto, nombre_producto, NEW.cantidad, CURRENT_DATE())
        ON DUPLICATE KEY UPDATE cantidad_disponible = cantidad_disponible + NEW.cantidad, fecha_actualizacion = CURRENT_DATE();
    ELSE
        UPDATE inventario
        SET cantidad_disponible = cantidad_disponible + NEW.cantidad, fecha_actualizacion = CURRENT_DATE()
        WHERE id_producto = NEW.id_producto;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_entrada_update` AFTER UPDATE ON `entradas` FOR EACH ROW BEGIN
    DECLARE diff INT;

    SET diff = NEW.cantidad - OLD.cantidad;

    UPDATE inventario
    SET cantidad_disponible = cantidad_disponible + diff, fecha_actualizacion = CURRENT_DATE()
    WHERE id_producto = NEW.id_producto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `nombre_producto` varchar(255) DEFAULT NULL,
  `cantidad_disponible` int(11) DEFAULT NULL,
  `fecha_actualizacion` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `id_producto`, `nombre_producto`, `cantidad_disponible`, `fecha_actualizacion`) VALUES
(780, 1, 'MESSI250', -10, '2024-06-28'),
(847, 123, 'Messi', 30, '2024-06-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `id_categoria`, `descripcion`, `precio`, `id_proveedor`) VALUES
(1, 'MESSI250', 1, 'DDGBBV', 5.5, 201),
(2, 'MESSI123', 1, 'ddd', 0, 201),
(123, 'Messi', 1, 'jdkdjkd', 90, 201),
(10101, 'Monitor ASUS ROG', 1, 'Monitor Gaming ASUS ROG', 1400, 201),
(10102, 'Carro', 123, 'Honda', 123, 201),
(10103, 'Pelota', 150, 'Pelota de basketball', 120, 201);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `direccion`, `telefono`, `email`) VALUES
(201, 'Sebas', '14 av 16-50 Zona 6 de mixcA', '54235027', 'sebas@gmail.com'),
(13343, 'fggg', 'DD', '1233', 'sebas1@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `id_salida` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `destino` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`id_salida`, `fecha`, `id_producto`, `cantidad`, `destino`) VALUES
(1, '2024-06-28', 1, 10, 'Walmart');

--
-- Disparadores `salidas`
--
DELIMITER $$
CREATE TRIGGER `after_salida_delete` AFTER DELETE ON `salidas` FOR EACH ROW BEGIN
    UPDATE inventario
    SET cantidad_disponible = cantidad_disponible + OLD.cantidad, fecha_actualizacion = CURRENT_DATE()
    WHERE id_producto = OLD.id_producto;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_salida_insert` AFTER INSERT ON `salidas` FOR EACH ROW BEGIN
    DECLARE nombre_producto VARCHAR(255);
    DECLARE inv_id INT;

    -- Obtener el nombre del producto de la tabla productos
    SELECT nombre INTO nombre_producto FROM productos WHERE id_producto = NEW.id_producto;

    -- Generar un ID único de tres dígitos para el inventario si es necesario
    SET inv_id = (SELECT id_inventario FROM inventario WHERE id_producto = NEW.id_producto);
    IF inv_id IS NULL THEN
        SET inv_id = FLOOR(100 + RAND() * 900);
        INSERT INTO inventario (id_inventario, id_producto, nombre_producto, cantidad_disponible, fecha_actualizacion)
        VALUES (inv_id, NEW.id_producto, nombre_producto, -NEW.cantidad, CURRENT_DATE())
        ON DUPLICATE KEY UPDATE cantidad_disponible = cantidad_disponible - NEW.cantidad, fecha_actualizacion = CURRENT_DATE();
    ELSE
        UPDATE inventario
        SET cantidad_disponible = cantidad_disponible - NEW.cantidad, fecha_actualizacion = CURRENT_DATE()
        WHERE id_producto = NEW.id_producto;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_salida_update` AFTER UPDATE ON `salidas` FOR EACH ROW BEGIN
    DECLARE diff INT;

    SET diff = NEW.cantidad - OLD.cantidad;

    UPDATE inventario
    SET cantidad_disponible = cantidad_disponible - diff, fecha_actualizacion = CURRENT_DATE()
    WHERE id_producto = NEW.id_producto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `fk_entradas_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD UNIQUE KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123456;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10104;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_entradas_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
