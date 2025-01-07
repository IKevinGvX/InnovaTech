-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2025 a las 02:50:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp_web`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ContarRegistrosDetalleMovimiento` (OUT `total` INT)   BEGIN
    SELECT COUNT(*) INTO total
    FROM detalle_movimiento;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ingresar_usuario` (IN `p_email` VARCHAR(255), IN `p_contrasena` VARCHAR(255), IN `p_fecha` DATETIME, IN `p_rol_id` INT)   BEGIN
    DECLARE v_rol_id INT DEFAULT 7; -- Asignar rol por defecto como 7
    
    INSERT INTO usuario (
        email,
        contrasena,
        rol_id,
        fecha_creacion
    ) VALUES (
        p_email,
        p_contrasena,
        v_rol_id, -- Rol fijo: 7
        NOW() -- Fecha actual
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ingresar_usuarios` (IN `email` VARCHAR(255), IN `contraseña` VARCHAR(255), IN `fecha_creacion` DATE, IN `rol_id` INT)   BEGIN
    -- Verificar si el rol_id es NULL o no se ha proporcionado, y asignar 7
    IF rol_id IS NULL THEN
        SET rol_id = 7;
    END IF;
    
    -- Insertar usuario con rol_id determinado
    INSERT INTO usuarios (email, contrasena, fecha_creacion, rol_id) 
    VALUES (email, contraseña, fecha_creacion, rol_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerallproducts` ()   begin
declare total int;
select count(*) into total from productos;
select total as total_productos;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerproductocategoria` ()   begin
select b.producto_id,b.nombre_producto,b.descripcion,b.precio,b.stock,a.descripcion 
from categoria a inner join productos b
on a.idcategoria= b.idcategoria; end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajustes_inventario`
--

CREATE TABLE `ajustes_inventario` (
  `ajuste_id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad_ajustada` int(11) DEFAULT NULL,
  `tipo_ajuste` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ajustes_inventario`
--

INSERT INTO `ajustes_inventario` (`ajuste_id`, `producto_id`, `cantidad_ajustada`, `tipo_ajuste`, `fecha`) VALUES
(41, 25, 46, 'Incremento', '2024-01-12'),
(42, 10, 10, 'Incremento', '2024-10-27'),
(43, 17, -42, 'Decremento', '2024-01-16'),
(44, 45, 40, 'Corrección', '2024-06-04'),
(45, 43, -30, 'Corrección', '2024-10-10'),
(46, 32, -27, 'Incremento', '2024-02-17'),
(47, 21, 15, 'Corrección', '2024-08-22'),
(48, 19, -23, 'Decremento', '2024-12-01'),
(49, 28, 30, 'Incremento', '2024-03-18'),
(50, 45, 20, 'Corrección', '2024-05-12'),
(51, 8, -19, 'Decremento', '2024-11-05'),
(52, 12, 25, 'Incremento', '2024-07-13'),
(53, 9, 35, 'Corrección', '2024-04-26'),
(54, 41, -50, 'Decremento', '2024-09-02'),
(55, 9, 48, 'Incremento', '2024-06-20'),
(56, 7, -5, 'Decremento', '2024-01-08'),
(57, 23, 17, 'Corrección', '2024-02-05'),
(58, 14, 42, 'Incremento', '2024-10-03'),
(59, 18, -29, 'Decremento', '2024-08-10'),
(60, 35, 28, 'Corrección', '2024-03-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `almacenid` int(11) NOT NULL,
  `nombrealmacen` varchar(255) DEFAULT NULL,
  `direccionalmacen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`almacenid`, `nombrealmacen`, `direccionalmacen`) VALUES
(1, 'Berlin Central Warehouse', 'Berliner Str. 15, Berlin, Germanyee'),
(2, 'Hamburg North Storage', 'Hamburger Allee 120, Hamburg, Germany'),
(3, 'Munich Logistics Hub', 'Munich Allee 45, Munich, Germany'),
(4, 'Frankfurt Main Depot', 'Frankfurter Str. 80, Frankfurt, Germany'),
(5, 'Cologne Distribution Center', 'Cologne Str. 25, Cologne, Germany'),
(6, 'Stuttgart South Warehouse', 'Stuttgart Allee 60, Stuttgart, Germany'),
(7, 'Dresden Regional Storage', 'Dresdner Str. 35, Dresden, Germany'),
(8, 'Bremen Logistics Point', 'Bremer Weg 90, Bremen, Germany'),
(9, 'Leipzig East Depot', 'Leipziger Str. 50, Leipzig, Germany'),
(10, 'Hannover Central Hub', 'Hannover Str. 65, Hannover, Germany'),
(11, 'Boston Storage Facility', 'Boston Ave 100, Boston, USA'),
(12, 'New York Main Warehouse', 'New York St 200, New York, USA'),
(13, 'Chicago Distribution Point', 'Chicago Ave 75, Chicago, USA'),
(14, 'Miami Logistics Center', 'Miami Blvd 50, Miami, USA'),
(15, 'San Francisco Depot', 'San Francisco St 120, San Francisco, USA'),
(16, 'Dallas Storage Unit', 'Dallas Pkwy 45, Dallas, USA'),
(17, 'Los Angeles West Warehouse', 'Los Angeles Blvd 95, Los Angeles, USA'),
(18, 'Houston South Depot', 'Houston Str. 35, Houston, USA'),
(19, 'Seattle North Logistics', 'Seattle Ave 125, Seattle, USA'),
(20, 'Denver Distribution Center', 'Denver St 70, Denver, USA'),
(21, 'Potsdam Regional Hub', 'Potsdamer Str. 30, Potsdam, Germany'),
(22, 'Lübeck Central Storage', 'Lübecker Weg 45, Lübeck, Germany'),
(23, 'Rostock Logistics Depot', 'Rostocker Str. 65, Rostock, Germany'),
(24, 'Magdeburg Warehouse', 'Magdeburger Allee 40, Magdeburg, Germany'),
(25, 'Kiel Storage Facility', 'Kiel Str. 55, Kiel, Germany'),
(26, 'Heidelberg Logistics Point', 'Heidelberger Str. 15, Heidelberg, Germany'),
(27, 'Freiburg Depot', 'Freiburger Str. 120, Freiburg, Germany'),
(28, 'Erlangen Hub', 'Erlanger Str. 35, Erlangen, Germany'),
(29, 'Mainz Distribution Unit', 'Mainzer Allee 50, Mainz, Germany'),
(30, 'Bonn Storage Center', 'Bonn Str. 90, Bonn, Germany'),
(31, 'San Diego Warehouse', 'San Diego St 110, San Diego, USA'),
(32, 'Atlanta Logistics Depot', 'Atlanta Ave 80, Atlanta, USA'),
(33, 'Austin Storage Hub', 'Austin Blvd 40, Austin, USA'),
(34, 'Phoenix Main Storage', 'Phoenix Str. 25, Phoenix, USA'),
(35, 'Portland Regional Unit', 'Portland Ave 95, Portland, USA'),
(36, 'Las Vegas Storage Facility', 'Las Vegas Blvd 60, Las Vegas, USA'),
(37, 'Philadelphia North Depot', 'Philadelphia St 75, Philadelphia, USA'),
(38, 'Charlotte Warehouse', 'Charlotte St 30, Charlotte, USA'),
(39, 'Detroit Logistics Point', 'Detroit Str. 85, Detroit, USA'),
(40, 'Salt Lake City Storage', 'Salt Lake Blvd 50, Salt Lake City, USA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen_productos`
--

CREATE TABLE `almacen_productos` (
  `productoid` int(11) DEFAULT NULL,
  `almacenid` int(11) DEFAULT NULL,
  `fechaenvio` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `almproid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacen_productos`
--

INSERT INTO `almacen_productos` (`productoid`, `almacenid`, `fechaenvio`, `estado`, `almproid`) VALUES
(17, 25, '2024-02-24 00:00:00', 'Entregado', 1),
(28, 17, '2024-12-18 00:00:00', 'Cancelado', 2),
(27, 19, '2024-04-19 00:00:00', 'Enviado', 3),
(31, 9, '2024-09-15 00:00:00', 'Cancelado', 4),
(28, 29, '2024-06-22 00:00:00', 'Pendiente', 5),
(14, 11, '2024-01-12 00:00:00', 'Pendiente', 6),
(9, 6, '2024-05-30 00:00:00', 'Entregado', 7),
(7, 15, '2024-08-02 00:00:00', 'Pendiente', 8),
(36, 20, '2024-07-19 00:00:00', 'Cancelado', 9),
(33, 3, '2024-03-01 00:00:00', 'Enviado', 10),
(29, 14, '2024-04-25 00:00:00', 'Pendiente', 11),
(20, 27, '2024-10-10 00:00:00', 'Entregado', 12),
(42, 18, '2024-11-11 00:00:00', 'Cancelado', 13),
(8, 22, '2024-12-01 00:00:00', 'Enviado', 14),
(40, 10, '2024-09-04 00:00:00', 'Pendiente', 15),
(5, 2, '2024-06-20 00:00:00', 'Cancelado', 16),
(16, 8, '2024-03-15 00:00:00', 'Enviado', 17),
(38, 12, '2024-02-10 00:00:00', 'Entregado', 18),
(21, 23, '2024-07-06 00:00:00', 'Pendiente', 19),
(11, 1, '2024-05-09 00:00:00', 'Cancelado', 20),
(8, 5, '2025-01-02', 'Enviado', 21),
(0, 1, '2025-01-02', 'Pendiente', 22),
(0, 1, '2025-01-02', 'Pendiente', 23),
(44, 34, '2025-01-02', 'Cancelado', 24),
(50, 40, '2025-01-02', 'Enviado', 25),
(0, 1, '2025-01-02', 'Pendiente', 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `descripcioncate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `descripcioncate`) VALUES
(1, 'Laptops'),
(2, 'Electrodomésticos'),
(3, 'Refrigeradores'),
(4, 'Lavadoras'),
(5, 'Secadoras de Ropa'),
(6, 'Microondas'),
(7, 'Cocinas'),
(8, 'Hornos Eléctricos'),
(9, 'Aspiradoras'),
(10, 'Ventiladores'),
(11, 'Aires Acondicionados'),
(12, 'Calentadores de Agua'),
(13, 'Freidoras de Aire'),
(14, 'Licuadoras'),
(15, 'Batidoras'),
(16, 'Tostadoras'),
(17, 'Cafeteras'),
(18, 'Extractores de Jugo'),
(19, 'Máquinas de Café Expreso'),
(20, 'Purificadores de Aire'),
(21, 'Congeladores'),
(22, 'Planchas'),
(23, 'Cocinas de Inducción'),
(24, 'Estufas Eléctricas'),
(25, 'Hornos de Pizza'),
(26, 'Robot de Cocina'),
(27, 'Deshumificadores de Aire'),
(28, 'Reparación de Electrodomésticos'),
(29, 'Sistemas de Refrigeración de Agua'),
(30, 'Herramientas de Reparación de Electrodomésticos'),
(31, 'Tecnología de Consumo'),
(32, 'Computadoras de Escritorio'),
(33, 'Laptops'),
(34, 'Tabletas'),
(35, 'Monitores'),
(36, 'Teclados y Ratones'),
(37, 'Cámaras Web'),
(38, 'Impresoras y Escáneres'),
(39, 'Sistemas de Sonido'),
(40, 'Cámaras de Seguridad'),
(41, 'Drones'),
(42, 'Consolas de Videojuegos'),
(43, 'Computadoras para Gaming'),
(44, 'Discos Duros Externos'),
(45, 'Memorias RAM'),
(46, 'Tarjetas Gráficas'),
(47, 'Placas Base para Computadoras'),
(48, 'Redes WiFi y Router'),
(49, 'UPS (Sistemas de Energía Ininterrumpida)'),
(50, 'Servicios de Reparación de Computadoras'),
(51, 'Instalación de Sistemas de Video Vigilancia'),
(52, 'Servicio Técnico de Mantenimiento Computacional'),
(53, 'Mantenimiento de Redes y Equipos Informáticos'),
(54, 'Instalación de Software y Actualización'),
(55, 'Sistemas de Backup y Recuperación de Datos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cliente_id` int(20) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `fecha_nac` varchar(255) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `ruc` int(11) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cliente_id`, `usuario_id`, `nombre`, `apellido`, `fecha_nac`, `dni`, `ruc`, `correo`, `telefono`, `direccion`) VALUES
(2, 4, 'Ana gomez', 'González', '1990-11-22', 23456789, 2147483647, 'ana.gonzalez@yahoo.com', '+1-555-2345678', 'Av. Libertador 2345, Buenos Aires, Argentina'),
(3, 4, 'Luis', 'Martínez', '1982-02-14', 34567890, 2147483647, 'luis.martinez@hotmail.com', '+44-7911-234567', '10 Downing Street, Londres, Reino Unido'),
(4, 4, 'Marta', 'López', '1995-04-17', 45678901, 2147483647, 'marta.lopez@outlook.com', '+33-612345678', 'Rue de Paris 45, París, Francia'),
(5, 4, 'José', 'Hernández', '1978-09-05', 56789012, 2147483647, 'jose.hernandez@mail.com', '+52-55-12345678', 'Calle Reforma 101, Ciudad de México, México'),
(6, 4, 'María', 'Rodríguez', '1992-08-30', 67890123, 2147483647, 'maria.rodriguez@icloud.com', '+49-151-23456789', 'Alexanderplatz 15, Berlín, Alemania'),
(7, 4, 'Pedro', 'García', '1990-01-12', 78901234, 2147483647, 'pedro.garcia@aol.com', '+1-800-2345678', 'Main Street 500, Los Angeles, USA'),
(8, 4, 'Laura', 'Sánchez', '1988-03-20', 89012345, 2147483647, 'laura.sanchez@live.com', '+61-412345678', 'King Street 50, Sídney, Australia'),
(9, 4, 'Ricardo', 'Ramírez', '1993-07-25', 90123456, 2147483647, 'ricardo.ramirez@gmail.com', '+34-612345679', 'Gran Via 15, Barcelona, España'),
(10, 4, 'Beatriz', 'Díaz', '1987-10-08', 12345679, 2147483647, 'beatriz.diaz@yahoo.com', '+39-320-1234567', 'Via Roma 55, Roma, Italia'),
(11, 4, 'Sofía', 'Martín', '1994-09-15', 12346789, 2147483647, 'sofia.martin@outlook.com', '+34-622345679', 'Carrer de Balmes 101, Barcelona, España'),
(12, 4, 'Javier', 'Fernández', '1980-01-11', 23457890, 2147483647, 'javier.fernandez@icloud.com', '+54-911-2345678', 'Av. 9 de Julio 750, Buenos Aires, Argentina'),
(13, 4, 'Esteban', 'Vázquez', '1992-03-30', 34568901, 2147483647, 'esteban.vazquez@hotmail.com', '+1-212-2345678', '5th Ave 200, New York, USA'),
(14, 4, 'Elena', 'Torres', '1986-12-22', 45679012, 2147483647, 'elena.torres@mail.com', '+44-793-234567', 'Oxford Street 80, Londres, Reino Unido'),
(15, 4, 'Gabriel', 'Gutiérrez', '1990-05-05', 56789123, 2147483647, 'gabriel.gutierrez@aol.com', '+33-670123456', 'Champs-Élysées 75, París, Francia'),
(16, 4, 'Clara', 'Jiménez', '1988-07-14', 67890234, 2147483647, 'clara.jimenez@gmail.com', '+52-55-23456789', 'Paseo de la Reforma 120, Ciudad de México, México'),
(17, 4, 'Andrés', 'Alvarez', '1995-06-28', 78901345, 2147483647, 'andres.alvarez@live.com', '+49-1701234567', 'Kurfürstendamm 40, Berlín, Alemania'),
(18, 4, 'Patricia', 'Moreno', '1983-08-19', 89012456, 2147483647, 'patricia.moreno@outlook.com', '+61-412345678', 'George St 75, Sídney, Australia'),
(19, 4, 'Felipe', 'Ruiz', '1989-10-10', 90123567, 2147483647, 'felipe.ruiz@gmail.com', '+34-612345680', 'Avenida Brasil 500, Madrid, España'),
(20, 4, 'Beatriz', 'Serrano', '1984-02-23', 12346790, 2147483647, 'beatriz.serrano@yahoo.com', '+1-415-2345678', 'Mission Street 120, San Francisco, USA'),
(21, 4, 'Santiago', 'Vega', '1982-03-17', 12347890, 2147483647, 'santiago.vega@gmail.com', '+34-612345681', 'Calle del Mar 200, Valencia, España'),
(22, 4, 'Carla', 'Santos', '1991-07-22', 23457901, 2147483647, 'carla.santos@yahoo.com', '+1-555-2345679', 'Av. Paulista 800, São Paulo, Brasil'),
(23, 4, 'Felipe', 'Castro', '1994-06-12', 34568012, 2147483647, 'felipe.castro@hotmail.com', '+44-7911-234568', '1 Kingsway, Londres, Reino Unido'),
(24, 4, 'Lorena', 'Gutiérrez', '1988-04-25', 45679123, 2147483647, 'lorena.gutierrez@outlook.com', '+33-612345679', 'Avenue des Champs-Élysées 78, París, Francia'),
(25, 4, 'Manuel', 'Torres', '1980-11-05', 56789234, 2147483647, 'manuel.torres@mail.com', '+52-55-34567890', 'Calle Juárez 10, Guadalajara, México'),
(26, 4, 'Gabriela', 'Mendoza', '1992-10-15', 67890345, 2147483647, 'gabriela.mendoza@icloud.com', '+49-1702345678', 'Münchener Str. 12, Berlín, Alemania'),
(27, 4, 'Diego', 'Serrano', '1995-02-02', 78901456, 2147483647, 'diego.serrano@live.com', '+61-412345679', 'Flinders Street 65, Melbourne, Australia'),
(28, 4, 'Nuria', 'Paredes', '1983-09-09', 89012567, 2147483647, 'nuria.paredes@aol.com', '+39-3202345678', 'Piazza del Duomo 5, Milán, Italia'),
(29, 4, 'Oscar', 'Ruiz', '1990-05-14', 90123678, 2147483647, 'oscar.ruiz@outlook.com', '+34-672345680', 'Avenida de América 99, Madrid, España'),
(30, 4, 'Lina', 'García', '1984-08-01', 12347901, 2147483647, 'lina.garcia@gmail.com', '+1-408-2345678', 'Silicon Valley 400, San Francisco, USA'),
(31, 4, 'Raúl', 'Rodríguez', '1996-12-10', 23458012, 2147483647, 'raul.rodriguez@hotmail.com', '+44-7944-234569', 'High Street 50, Edimburgo, Reino Unido'),
(32, 4, 'Elisa', 'Márquez', '1991-01-05', 34568123, 2147483647, 'elisa.marquez@icloud.com', '+52-55-45678901', 'Av. Insurgentes 850, Ciudad de México, México'),
(33, 4, 'Fernando', 'Jiménez', '1987-06-17', 45679234, 2147483647, 'fernando.jimenez@aol.com', '+33-632123456', 'Rue de la République 35, Lyon, Francia'),
(34, 4, 'Silvia', 'Morales', '1989-04-30', 56789345, 2147483647, 'silvia.morales@mail.com', '+49-1603456789', 'Gendarmenmarkt 18, Berlín, Alemania'),
(35, 4, 'Antonio', 'Castillo', '1993-09-23', 67890456, 2147483647, 'antonio.castillo@outlook.com', '+1-646-2345678', 'Broadway 400, New York, USA'),
(36, 4, 'Julia', 'Ríos', '1990-01-22', 78901567, 2147483647, 'julia.rios@live.com', '+44-7421-234570', 'Oxford Street 120, Londres, Reino Unido'),
(37, 4, 'Ricardo', 'Vázquez', '1986-03-14', 89012678, 2147483647, 'ricardo.vazquez@icloud.com', '+33-612234567', 'Boulevard Saint-Germain 50, París, Francia'),
(38, 4, 'Valeria', 'Moreno', '1995-08-19', 90124789, 2147483647, 'valeria.moreno@gmail.com', '+34-612345681', 'Carrer de Pau Claris 90, Barcelona, España'),
(39, 4, 'Sergio', 'Núñez', '1988-12-28', 12348012, 2147483647, 'sergio.nunez@yahoo.com', '+52-55-56789012', 'Av. Paseo de la Reforma 100, Ciudad de México, México'),
(40, 4, 'Claudia', 'Álvarez', '1985-06-05', 23459123, 2147483647, 'claudia.alvarez@hotmail.com', '+49-1703456789', 'Grote Markt 45, Ámsterdam, Países Bajos'),
(41, 4, 'Tomás', 'Herrera', '1992-11-17', 34560234, 2147483647, 'tomas.herrera@aol.com', '+1-213-2345678', 'Sunset Blvd 600, Los Angeles, USA'),
(42, 4, 'Victoria', 'Fuentes', '1993-03-29', 45671345, 2147483647, 'victoria.fuentes@outlook.com', '+44-7911-234571', 'Baker Street 221B, Londres, Reino Unido'),
(43, 4, 'Jorge', 'González', '1989-02-19', 56782456, 2147483647, 'jorge.gonzalez@mail.com', '+52-55-67890123', 'Calle Reforma 1050, Ciudad de México, México'),
(44, 4, 'Isabel', 'Ruiz', '1982-07-01', 67893567, 2147483647, 'isabel.ruiz@gmail.com', '+49-1704567890', 'Karl-Marx-Allee 100, Berlín, Alemania'),
(45, 4, 'Luis', 'Castro', '1991-05-13', 78904678, 2147483647, 'luis.castro@live.com', '+34-672345682', 'Avenida 9 de Julio 600, Buenos Aires, Argentina'),
(46, 4, 'Juliana', 'Reyes', '1990-02-09', 89015789, 2147483647, 'juliana.reyes@outlook.com', '+33-612345678', 'Rue de Rivoli 101, París, Francia'),
(47, 4, 'Ricardo', 'Martín', '1984-04-25', 90126890, 2147483647, 'ricardo.martin@icloud.com', '+61-412345680', 'Queen St 120, Brisbane, Australia'),
(48, 4, 'Cristina Riveras', 'Molina', '1987-01-15', 12349101, 2147483647, 'cristina.molina@gmail.com', '+1-212-2345689', 'Park Ave 450, New York, USA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_movimiento`
--

CREATE TABLE `detalle_movimiento` (
  `detalle_movimiento_id` bigint(20) NOT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  `movimiento_id` int(11) DEFAULT NULL,
  `precio` double(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `fecha` varchar(255) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_movimiento`
--

INSERT INTO `detalle_movimiento` (`detalle_movimiento_id`, `almacen_id`, `movimiento_id`, `precio`, `cantidad`, `subtotal`, `fecha`, `producto_id`) VALUES
(589, 4, 2, 134.44, 10, 1344.4, '2024-07-27', 29),
(590, 4, 9, 161.08, 5, 805.4, '2024-02-09', 30),
(591, 30, 5, 483.83, 15, 7257.45, '2024-11-23', 31),
(592, 25, 12, 15.85, 20, 317, '2024-09-16', 32),
(593, 30, 16, 26.15, 10, 261.5, '2024-09-20', 33),
(594, 2, 18, 480.74, 1, 480.74, '2024-06-04', 34),
(595, 3, 11, 317.86, 3, 953.58, '2024-01-11', 35),
(596, 26, 11, 78.16, 6, 468.96, '2024-10-12', 36),
(597, 20, 15, 107.43, 8, 859.44, '2024-05-21', 37),
(598, 6, 14, 39.81, 9, 358.29, '2024-02-14', 38),
(599, 1, 12, 422.58, 5, 2112.9, '2024-11-28', 39),
(600, 29, 6, 124.19, 15, 1862.85, '2024-01-23', 40),
(601, 18, 7, 150.75, 2, 301.5, '2024-06-08', 41),
(602, 19, 3, 223.62, 7, 1565.34, '2024-03-11', 42),
(603, 8, 2, 36.96, 12, 443.52, '2024-08-14', 29),
(604, 10, 2, 173.68, 19, 3299.92, '2024-12-03', 30),
(605, 15, 8, 95.37, 14, 1335.18, '2024-04-25', 31),
(606, 11, 1, 320.81, 6, 1924.86, '2024-09-05', 32),
(607, 12, 1, 245.68, 8, 1965.44, '2024-10-22', 33),
(608, 9, 1, 97.19, 11, 1069.09, '2024-05-18', 34),
(609, 5, 6, 180.44, 10, 1804.4, '2024-07-13', 35),
(610, 28, 12, 491.72, 5, 2458.6, '2024-02-15', 36),
(611, 27, 11, 125.63, 16, 2010.08, '2024-06-02', 37),
(612, 7, 17, 212.43, 12, 2549.16, '2024-11-15', 38),
(613, 24, 17, 321.12, 3, 963.36, '2024-04-14', 39),
(614, 30, 2, 50.23, 13, 652.99, '2024-05-19', 40),
(615, 22, 5, 481.16, 9, 4330.44, '2024-09-30', 41),
(616, 13, 6, 90.39, 20, 1807.8, '2024-01-26', 42),
(617, 16, 7, 102.87, 7, 720.09, '2024-02-20', 29),
(618, 21, 9, 487.58, 18, 8776.44, '2024-08-29', 30),
(619, 14, 11, 378.95, 6, 2273.7, '2024-10-07', 31),
(620, 17, 12, 429.14, 2, 858.28, '2024-12-05', 32),
(621, 23, 7, 120.49, 11, 1325.39, '2024-01-09', 33),
(622, 25, 8, 58.34, 13, 758.42, '2024-06-16', 34),
(623, 6, 9, 103.27, 12, 1239.24, '2024-03-17', 35),
(624, 4, 8, 229.63, 9, 2066.67, '2024-05-27', 36),
(625, 26, 7, 450.76, 8, 3606.08, '2024-08-08', 37),
(626, 2, 6, 190.25, 19, 3614.75, '2024-09-18', 38),
(627, 3, 5, 421.18, 4, 1684.72, '2024-04-21', 39),
(628, 18, 11, 344.56, 15, 5168.4, '2024-03-31', 40),
(629, 19, 15, 78.49, 17, 1334.33, '2024-07-23', 41),
(630, 20, 15, 296.27, 14, 4147.78, '2024-08-10', 42),
(631, 8, 12, 85.71, 6, 514.26, '2024-01-03', 29),
(632, 15, 11, 365.50, 10, 3655, '2024-12-09', 30),
(633, 11, 14, 148.19, 3, 444.57, '2024-10-25', 31),
(634, 12, 15, 215.62, 13, 2803.06, '2024-02-12', 32),
(635, 9, 12, 94.78, 2, 189.56, '2024-06-07', 33),
(636, 5, 18, 200.13, 20, 4002.6, '2024-03-08', 34),
(637, 29, 12, 381.24, 7, 2668.68, '2024-07-04', 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `empleadoid` int(20) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `rango` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `fecha_nac` varchar(255) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`empleadoid`, `usuario_id`, `rango`, `nombre`, `apellido`, `fecha_nac`, `dni`, `correo`, `telefono`, `direccion`) VALUES
(1, 1, 'Gerente', 'Anna', 'Müller', '1990-01-05', 75615274, 'anna.mueller@xyzcorp.de', '+49 30 123456', 'Berliner Str. 25, Berlin, Germany'),
(2, 1, 'Supervisor', 'Max', 'Schmidt', '1985-05-20', 0, 'max.schmidt@globaltech.de', '+49 40 987654', 'Hamburger Allee 100, Hamburg, Germany'),
(3, 1, 'Analista', 'Emma', 'Schneider', '1993-12-15', 0, 'emma.schneider@abccompany.de', '+49 69 543210', 'Frankfurter Str. 55, Frankfurt, Germany'),
(4, 1, 'Asistente', 'Paul', 'Fischer', '1987-03-11', 0, 'paul.fischer@xyzcorp.de', '+49 341 678901', 'Leipziger Str. 12, Leipzig, Germany'),
(5, 1, 'Gerente', 'Lara', 'Weber', '1992-07-22', 0, 'lara.weber@globaltech.de', '+49 711 234567', 'Stuttgart Allee 33, Stuttgart, Germany'),
(6, 1, 'Operador', 'Julia', 'Becker', '1990-09-14', 0, 'julia.becker@abccompany.de', '+49 351 345678', 'Dresdner Str. 90, Dresden, Germany'),
(7, 1, 'Supervisor', 'Luca', 'Hoffmann', '1995-11-30', 0, 'luca.hoffmann@xyzcorp.de', '+49 421 456789', 'Bremer Weg 45, Bremen, Germany'),
(8, 1, 'Analista', 'Sophie', 'Meyer', '1991-02-17', 0, 'sophie.meyer@globaltech.de', '+49 511 567890', 'Hannover Str. 80, Hannover, Germany'),
(9, 1, 'Asistente', 'Leo', 'Wagner', '1986-06-25', 0, 'leo.wagner@abccompany.de', '+49 89 678901', 'Munich Allee 23, Munich, Germany'),
(10, 1, 'Operador', 'Maria', 'Koch', '1988-04-18', 0, 'maria.koch@xyzcorp.de', '+49 221 789012', 'Cologne Str. 10, Cologne, Germany'),
(11, 1, 'Gerente', 'Alex', 'Bauer', '1985-07-09', 123456789, 'alex.bauer@globaltech.de', '+1 617 1234567', 'Boston Ave 22, Boston, USA'),
(12, 1, 'Supervisor', 'Clara', 'Zimmermann', '1990-08-15', 234567890, 'clara.zimmermann@abccompany.com', '+1 212 2345678', 'New York St 88, New York, USA'),
(13, 1, 'Analista', 'Nina', 'Schäfer', '1993-11-20', 345678901, 'nina.schaefer@xyzcorp.com', '+1 312 3456789', 'Chicago Ave 47, Chicago, USA'),
(14, 1, 'Asistente', 'Daniel', 'Krause', '1989-03-03', 456789012, 'daniel.krause@globaltech.com', '+1 305 4567890', 'Miami Blvd 30, Miami, USA'),
(15, 1, 'Gerente', 'Mia', 'Lehmann', '1994-10-10', 567890123, 'mia.lehmann@abccompany.com', '+1 415 5678901', 'San Francisco St 54, San Francisco, USA'),
(16, 1, 'Operador', 'Henry', 'Schulz', '1987-06-18', 678901234, 'henry.schulz@xyzcorp.com', '+1 972 6789012', 'Dallas Pkwy 18, Dallas, USA'),
(17, 1, 'Supervisor', 'Eva', 'Maier', '1992-01-14', 789012345, 'eva.maier@globaltech.com', '+1 310 7890123', 'Los Angeles Blvd 29, Los Angeles, USA'),
(18, 1, 'Analista', 'Lisa', 'Huber', '1991-05-22', 890123456, 'lisa.huber@abccompany.com', '+1 713 8901234', 'Houston Str. 60, Houston, USA'),
(19, 1, 'Asistente', 'Erik', 'König', '1986-12-01', 901234567, 'erik.koenig@xyzcorp.com', '+1 206 9012345', 'Seattle Ave 77, Seattle, USA'),
(20, 1, 'Operador', 'Olivia', 'Frank', '1995-09-27', 12345678, 'olivia.frank@globaltech.com', '+1 303 0123456', 'Denver St 31, Denver, USA'),
(21, 1, 'Gerente', 'Hans', 'Gruber', '1985-08-09', 0, 'hans.gruber@xyzcorp.de', '+49 6221 123456', 'Heidelberger Str. 50, Heidelberg, Germany'),
(22, 1, 'Supervisor', 'Greta', 'Wolf', '1993-10-05', 0, 'greta.wolf@globaltech.de', '+49 761 987654', 'Freiburger Str. 75, Freiburg, Germany'),
(23, 1, 'Analista', 'Lukas', 'Hartmann', '1990-06-12', 0, 'lukas.hartmann@abccompany.de', '+49 6131 543210', 'Mainzer Allee 32, Mainz, Germany'),
(24, 1, 'Asistente', 'Sara', 'Neumann', '1994-11-25', 0, 'sara.neumann@xyzcorp.de', '+49 621 678901', 'Mannheimer Str. 19, Mannheim, Germany'),
(25, 1, 'Gerente', 'Felix', 'Scholz', '1987-02-15', 0, 'felix.scholz@globaltech.de', '+49 231 234567', 'Dortmunder Weg 45, Dortmund, Germany'),
(26, 1, 'Operador', 'Emma', 'Lang', '1991-05-18', 0, 'emma.lang@abccompany.de', '+49 228 345678', 'Bonn Str. 65, Bonn, Germany'),
(27, 1, 'Supervisor', 'Noah', 'Klein', '1989-12-02', 0, 'noah.klein@xyzcorp.de', '+49 241 456789', 'Aachener Str. 22, Aachen, Germany'),
(28, 1, 'Analista', 'Lara', 'Seidel', '1995-03-29', 0, 'lara.seidel@globaltech.de', '+49 9131 567890', 'Erlanger Str. 50, Erlangen, Germany'),
(29, 1, 'Asistente', 'Julia', 'Walter', '1988-09-03', 0, 'julia.walter@abccompany.de', '+49 931 678901', 'Würzburger Str. 75, Würzburg, Germany'),
(30, 1, 'Operador', 'Oliver', 'Zimmer', '1992-07-22', 0, 'oliver.zimmer@xyzcorp.de', '+49 541 789012', 'Osnabrücker Str. 18, Osnabrück, Germany'),
(31, 1, 'Gerente', 'Hanna', 'Krämer', '1985-11-11', 901283746, 'hanna.kraemer@globaltech.de', '+1 801 1234567', 'Salt Lake Blvd 40, Salt Lake City, USA'),
(32, 1, 'Supervisor', 'Leo', 'Schuster', '1989-03-14', 801234567, 'leo.schuster@abccompany.com', '+1 619 2345678', 'San Diego St 90, San Diego, USA'),
(33, 1, 'Analista', 'Mia', 'Brandt', '1993-08-29', 701234567, 'mia.brandt@xyzcorp.com', '+1 404 3456789', 'Atlanta Ave 60, Atlanta, USA'),
(34, 1, 'Asistente', 'Eva', 'Lorenz', '1991-12-22', 601234567, 'eva.lorenz@globaltech.com', '+1 512 4567890', 'Austin Blvd 20, Austin, USA'),
(35, 1, 'Gerente', 'Henry', 'Arnold', '1986-10-07', 501234567, 'henry.arnold@abccompany.com', '+1 602 5678901', 'Phoenix Str. 12, Phoenix, USA'),
(36, 1, 'Operador', 'Alex', 'Simon', '1990-05-19', 401234567, 'alex.simon@xyzcorp.com', '+1 503 6789012', 'Portland Ave 42, Portland, USA'),
(37, 1, 'Supervisor', 'Clara', 'Hauser', '1995-02-13', 301234567, 'clara.hauser@globaltech.com', '+1 702 7890123', 'Las Vegas Blvd 77, Las Vegas, USA'),
(38, 1, 'Analista', 'Daniel', 'Koch', '1987-01-18', 201234567, 'daniel.koch@abccompany.com', '+1 215 8901234', 'Philadelphia St 30, Philadelphia, USA'),
(39, 1, 'Asistente', 'Lisa', 'Meier', '1992-06-05', 101234567, 'lisa.meier@xyzcorp.com', '+1 704 9012345', 'Charlotte St 54, Charlotte, USA'),
(40, 1, 'Operador', 'Nina', 'Berg', '1988-04-09', 91234567, 'nina.berg@globaltech.com', '+1 313 0123456', 'Detroit Str. 90, Detroit, USA'),
(41, 1, 'Gerente', 'Hans', 'Fuchs', '1990-03-15', 0, 'hans.fuchs@abccompany.de', '+49 431 123456', 'Kiel Str. 28, Kiel, Germany'),
(42, 1, 'Supervisor', 'Anna', 'Reuter', '1994-09-12', 7627285, 'anna.reuter@xyzcorp.de', '+49 331 987654', 'Potsdamer Str. 19, Potsdam, Germany'),
(43, 1, 'Analista', 'Max', 'Kuhn', '1991-10-08', 0, 'max.kuhn@globaltech.de', '+49 451 543210', 'Lübecker Weg 50, Lübeck, Germany'),
(44, 1, 'Asistente', 'Emma', 'Stein', '1989-12-25', 0, 'emma.stein@abccompany.de', '+49 381 678901', 'Rostocker Str. 10, Rostock, Germany');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_costos`
--

CREATE TABLE `historial_costos` (
  `historial_id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_costos`
--

INSERT INTO `historial_costos` (`historial_id`, `producto_id`, `costo`, `fecha`) VALUES
(1, 29, 151.20, '2024-03-29'),
(2, 30, 438.84, '2024-12-01'),
(3, 31, 408.05, '2024-06-23'),
(4, 32, 497.01, '2024-12-03'),
(5, 33, 135.22, '2024-03-17'),
(6, 34, 283.94, '2024-07-15'),
(7, 35, 463.87, '2024-01-08'),
(8, 36, 334.77, '2024-02-20'),
(9, 37, 270.50, '2024-08-05'),
(10, 38, 420.61, '2024-05-26'),
(11, 39, 381.73, '2024-02-14'),
(12, 40, 108.44, '2024-11-18'),
(13, 41, 246.34, '2024-10-11'),
(14, 42, 487.29, '2024-06-21'),
(15, 29, 168.56, '2024-01-01'),
(16, 30, 224.90, '2024-08-14'),
(17, 31, 453.62, '2024-03-05'),
(18, 32, 187.39, '2024-12-09'),
(19, 33, 316.28, '2024-04-28'),
(20, 34, 478.59, '2024-07-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_almacen_destinado`
--

CREATE TABLE `movimiento_almacen_destinado` (
  `movimiento_id` int(11) NOT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  `fecha_envio` varchar(255) DEFAULT NULL,
  `tipo_movimiento` varchar(255) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimiento_almacen_destinado`
--

INSERT INTO `movimiento_almacen_destinado` (`movimiento_id`, `almacen_id`, `fecha_envio`, `tipo_movimiento`, `total`, `cliente_id`) VALUES
(1, 6, '2024-11-04', 'Salida', 2683.23, 23),
(2, 20, '2024-07-15', 'Entrada', 2823.98, 33),
(3, 8, '2024-08-19', 'Transferencia', 8179.75, 26),
(4, 15, '2024-08-20', 'Entrada', 3755.86, 33),
(5, 9, '2024-05-11', 'Salida', 763.01, 33),
(6, 2, '2024-12-01', 'Transferencia', 1485.77, NULL),
(7, 14, '2024-01-28', 'Salida', 5438.64, NULL),
(8, 19, '2024-03-12', 'Entrada', 3265.49, NULL),
(9, 3, '2024-10-06', 'Transferencia', 1874.26, NULL),
(10, 22, '2024-02-17', 'Salida', 914.52, NULL),
(11, 5, '2024-11-22', 'Entrada', 7945.12, NULL),
(12, 17, '2024-07-07', 'Transferencia', 1896.11, NULL),
(13, 13, '2024-03-22', 'Salida', 1432.77, NULL),
(14, 12, '2024-06-18', 'Entrada', 4168.29, NULL),
(15, 25, '2024-09-13', 'Transferencia', 2342.89, NULL),
(16, 30, '2024-04-29', 'Salida', 6194.42, NULL),
(17, 7, '2024-12-15', 'Entrada', 5038.33, NULL),
(18, 11, '2024-10-21', 'Transferencia', 2943.12, NULL),
(19, 26, '2024-08-02', 'Salida', 1872.35, NULL),
(20, 1, '2024-05-19', 'Entrada', 7183.44, NULL),
(71, 1, '2025-01-01', 'Salida', 1200.5, 32),
(72, 2, '2025-01-02', 'Transferencia', 800, 42),
(73, 3, '2025-01-03', 'Enviado', 3500.75, 42),
(74, 4, '2025-01-04', 'Salida', 450.25, 32),
(75, 5, '2025-01-05', 'Transferencia', 2200.1, 24),
(76, 1, '2025-01-06', 'Enviado', 950, 12),
(77, 2, '2025-01-07', 'Salida', 1100.8, 2),
(78, 3, '2025-01-08', 'Transferencia', 4200, 4),
(79, 4, '2025-01-09', 'Enviado', 5200.3, 32),
(80, 5, '2025-01-10', 'Salida', 700.6, 23),
(81, 1, '2025-01-11', 'Transferencia', 1300.4, 12),
(82, 2, '2025-01-12', 'Enviado', 3400.2, 23),
(83, 3, '2025-01-13', 'Salida', 2300.8, 25),
(84, 4, '2025-01-14', 'Transferencia', 2100.7, 24),
(85, 5, '2025-01-15', 'Enviado', 4100.5, 24),
(86, 1, '2025-01-16', 'Salida', 950.8, 26),
(87, 2, '2025-01-17', 'Transferencia', 3300.1, 42),
(88, 3, '2025-01-18', 'Enviado', 4700.9, 42),
(89, 4, '2025-01-19', 'Salida', 300, 42),
(90, 5, '2025-01-20', 'Transferencia', 520.5, 42),
(91, 1, '2025-01-21', 'Enviado', 2500.4, 42),
(92, 2, '2025-01-22', 'Salida', 810.1, 22),
(93, 3, '2025-01-23', 'Transferencia', 1600.7, 24),
(94, 4, '2025-01-24', 'Enviado', 5400, 25),
(95, 5, '2025-01-25', 'Salida', 4100.1, 26),
(96, 1, '2025-01-26', 'Transferencia', 1200, 21),
(97, 2, '2025-01-27', 'Enviado', 5000.2, 21),
(98, 3, '2025-01-28', 'Salida', 4300.3, 25),
(99, 4, '2025-01-29', 'Transferencia', 3700.8, 32),
(100, 5, '2025-01-30', 'Enviado', 1500.4, 33),
(101, 1, '2025-01-31', 'Salida', 600, 33),
(102, 2, '2025-02-01', 'Transferencia', 2800.2, 32),
(103, 3, '2025-02-02', 'Enviado', 3500.3, 26),
(104, 4, '2025-02-03', 'Salida', 470.6, 26),
(105, 5, '2025-02-04', 'Transferencia', 2100.4, 32),
(106, 1, '2025-02-05', 'Enviado', 3400.7, 32),
(107, 2, '2025-02-06', 'Salida', 1800.8, 32),
(108, 3, '2025-02-07', 'Transferencia', 4300.5, 32),
(109, 4, '2025-02-08', 'Enviado', 6200.3, 32),
(110, 5, '2025-02-09', 'Salida', 1900.1, 32),
(111, 1, '2025-02-10', 'Transferencia', 2700.8, 26),
(112, 2, '2025-02-11', 'Enviado', 4500.5, 26),
(113, 3, '2025-02-12', 'Salida', 1500.7, 27),
(114, 4, '2025-02-13', 'Transferencia', 2400.9, 42),
(115, 5, '2025-02-14', 'Enviado', 7000, 44),
(116, 1, '2025-02-15', 'Salida', 3300.4, 42),
(117, 2, '2025-02-16', 'Transferencia', 2100.7, 42),
(118, 3, '2025-02-17', 'Enviado', 5200.9, 25),
(119, 4, '2025-02-18', 'Salida', 1200, 26),
(120, 5, '2025-02-19', 'Transferencia', 4100.6, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `productoid` int(20) NOT NULL,
  `nombreproducto` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`productoid`, `nombreproducto`, `descripcion`, `precio`, `stock`, `idcategoria`) VALUES
(0, 'Laptop', 'Laptop Ryzen 7G', 1222, 12, 1),
(5, 'Refrigerador LG', 'Refrigerador de alta capacidad', 4999, 1001, 1),
(6, 'Microondas Samsung', 'Microondas digital con múltiples funciones', 350, 50, 2),
(7, 'Licuadora Oster', 'Licuadora de 10 velocidades', 212, 100, 3),
(8, 'Aspiradora Dyson', 'Aspiradora sin bolsa de alta potencia', 600, 30, 4),
(9, 'Plancha Philips', 'Plancha de vapor con suela antiadherente', 40, 80, 5),
(10, 'Lavadora Whirlpool', 'Lavadora automática de 15 kg', 700, 15, 1),
(11, 'Secadora Samsung', 'Secadora eléctrica de ropa', 800, 12, 1),
(12, 'Batidora Kitchenaid', 'Batidora de pedestal con 10 velocidades', 500, 25, 3),
(13, 'Horno eléctrico Teka', 'Horno eléctrico empotrable', 400, 18, 2),
(14, 'Extractor de jugos Philips', 'Extractor de jugos de acero inoxidable', 120, 45, 3),
(15, 'Televisor LG 55\"', 'Televisor 4K UHD con Smart TV', 900, 22, 6),
(16, 'Freidora de aire Tefal', 'Freidora sin aceite de gran capacidad', 150, 40, 3),
(17, 'Cafetera Nespresso', 'Cafetera automática de cápsulas', 200, 35, 3),
(18, 'Ventilador Taurus', 'Ventilador de pie con 3 velocidades', 60, 70, 7),
(19, 'Calefactor Xiaomi', 'Calefactor eléctrico portátil', 100, 50, 7),
(20, 'Horno tostador Hamilton Beach', 'Horno tostador compacto', 70, 60, 2),
(21, 'Termoeléctrico Bosch', 'Calentador de agua eléctrico', 250, 20, 1),
(22, 'Parrilla eléctrica Oster', 'Parrilla eléctrica antiadherente', 110, 50, 3),
(23, 'Máquina de pan Panasonic', 'Máquina para hacer pan en casa', 180, 30, 3),
(24, 'Cortadora de pelo Wahl', 'Cortadora de pelo profesional', 50, 80, 8),
(25, 'Secadora de cabello Remington', 'Secadora de cabello con ionizador', 60, 65, 8),
(26, 'Horno de gas Mabe', 'Horno de gas empotrable', 700, 10, 2),
(27, 'Televisor Samsung 65\"', 'Televisor 4K UHD con panel QLED', 1200, 12, 6),
(28, 'Hidrolavadora Karcher', 'Hidrolavadora a presión compacta', 250, 40, 9),
(29, 'Humidificador Philips', 'Humidificador ultrasónico', 120, 30, 7),
(30, 'Cámara de seguridad Xiaomi', 'Cámara IP con visión nocturna', 80, 50, 10),
(31, 'Purificador de aire Dyson', 'Purificador con filtro HEPA', 400, 20, 7),
(32, 'Ventilador de torre Rowenta', 'Ventilador silencioso con mando', 150, 30, 7),
(33, 'Robot aspirador iRobot', 'Robot aspirador con mapeo inteligente', 600, 15, 4),
(34, 'Frigobar Mabe', 'Mini refrigerador de 90L', 250, 25, 1),
(35, 'Congelador Whirlpool', 'Congelador horizontal de 200L', 500, 10, 1),
(36, 'Dispensador de agua LG', 'Dispensador de agua caliente y fría', 300, 20, 1),
(37, 'Cocina a gas Indurama', 'Cocina de 4 quemadores', 400, 18, 2),
(38, 'Plancha de cabello Babyliss', 'Plancha de cabello profesional', 120, 50, 8),
(39, 'Batidora de inmersión Braun', 'Batidora manual con accesorios', 80, 60, 3),
(40, 'Deshumidificador DeLonghi', 'Deshumidificador para grandes espacios', 300, 15, 7),
(41, 'Refrigerador Samsung', 'Refrigerador French Door con dispensador', 1500, 8, 1),
(42, 'Horno microondas Panasonic', 'Microondas con grill', 200, 50, 2),
(43, 'Extractor de cocina Teka', 'Campana extractora de acero inoxidable', 350, 10, 2),
(44, 'Cafetera Oster', 'Cafetera de goteo programable', 90, 40, 3),
(45, 'Olla de presión eléctrica Instant Pot', 'Olla multifuncional', 140, 30, 3),
(46, 'Tostadora Cuisinart', 'Tostadora para 4 rebanadas', 60, 70, 3),
(47, 'Cortador de alimentos Black+Decker', 'Procesador de alimentos compacto', 100, 50, 3),
(48, 'Hervidor eléctrico Philips', 'Hervidor rápido con filtro', 50, 80, 3),
(49, 'Máquina para waffles Black+Decker', 'Máquina para waffles antiadherente', 60, 60, 3),
(50, 'Enfriador de aire portátil Honeywell', 'Enfriador de aire con depósito de agua', 250, 20, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `proveedor_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `fecha_nac` varchar(255) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `ruc` int(11) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`proveedor_id`, `usuario_id`, `nombre`, `apellido`, `fecha_nac`, `dni`, `ruc`, `correo`, `telefono`, `direccion`) VALUES
(2, 5, 'John', 'Smith', '1990-01-15', 12345678, 2147483647, 'john.smith@gmail.com', '+44 123456789', '123 Main St, London, UK'),
(3, 5, 'Jane', 'Doe', '1985-05-20', 87654321, 2147483647, 'jane.doe@yahoo.com', '+33 987654321', '456 Rue de Paris, Paris, France'),
(4, 5, 'Carlos', 'Gonzalez', '1992-03-10', 45678912, 2147483647, 'carlos.gonzalez@outlook.com', '+49 912345678', '789 Berliner Strasse, Berlin, Germany'),
(5, 5, 'Maria', 'Rodriguez', '1988-07-12', 23456789, 2147483647, 'maria.rodriguez@hotmail.it', '+39 934567890', '321 Via Roma, Rome, Italy'),
(6, 5, 'Anne', 'Johnson', '1995-12-25', 98765432, 2147483647, 'anne.johnson@live.com', '+1 945678123', '678 Maple St, New York, USA'),
(7, 5, 'Liam', 'Brown', '1993-02-17', 43215678, 2147483647, 'liam.brown@ymail.com', '+61 900123456', '912 Birch St, Sydney, Australia'),
(8, 5, 'Emma', 'Davis', '1991-06-08', 56789012, 2147483647, 'emma.davis@mail.ru', '+7 890123456', '234 Nevsky Prospect, St. Petersburg, Russia'),
(9, 5, 'Lucas', 'Martin', '1994-11-23', 67890123, 2147483647, 'lucas.martin@web.de', '+49 890123457', '456 Goethe Strasse, Munich, Germany'),
(10, 5, 'Sophia', 'Hernandez', '1996-04-14', 78901234, 2147483647, 'sophia.hernandez@orange.fr', '+33 123456987', '321 Rue Lafayette, Lyon, France'),
(11, 5, 'Ethan', 'Clark', '1990-08-29', 89012345, 2147483647, 'ethan.clark@aol.com', '+1 987654321', '890 Pine St, Chicago, USA'),
(12, 5, 'Isabella', 'Lopez', '1993-03-19', 90123456, 2147483647, 'isabella.lopez@uol.com.br', '+55 912345678', '123 Avenida Paulista, São Paulo, Brazil'),
(13, 5, 'Noah', 'White', '1987-12-01', 12345098, 2147483647, 'noah.white@protonmail.com', '+41 987654321', '678 Bahnhofstrasse, Zurich, Switzerland'),
(14, 5, 'Mia', 'Hall', '1992-07-07', 23450987, 2147483647, 'mia.hall@gmail.co.uk', '+44 789012345', '234 Baker Street, London, UK'),
(15, 5, 'James', 'Allen', '1989-10-30', 34509876, 2147483647, 'james.allen@seznam.cz', '+420 567890123', '123 Vaclavske Namesti, Prague, Czech Republic'),
(16, 5, 'Ella', 'Young', '1994-05-15', 45609875, 2147483647, 'ella.young@yahoo.co.in', '+91 912345678', '789 MG Road, Bangalore, India'),
(17, 5, 'Oliver', 'Wright', '1995-11-10', 56709874, 2147483647, 'oliver.wright@hotmail.ca', '+1 123456789', '321 Yonge St, Toronto, Canada'),
(18, 5, 'Ava', 'King', '1986-06-20', 67809873, 2147483647, 'ava.king@gmail.com.au', '+61 987654321', '678 George St, Sydney, Australia'),
(19, 5, 'William', 'Scott', '1991-01-25', 78909872, 2147483647, 'william.scott@freemail.hu', '+36 123456789', '123 Andrassy Utca, Budapest, Hungary'),
(20, 5, 'Emily', 'Adams', '1990-03-05', 89098712, 2147483647, 'emily.adams@gmail.co.za', '+27 987654321', '321 Nelson Mandela Blvd, Cape Town, South Africa'),
(21, 5, 'Benjamin', 'Hill', '1988-09-18', 90123489, 2147483647, 'benjamin.hill@gmail.mx', '+52 912345678', '123 Reforma Avenue, Mexico City, Mexico'),
(22, 5, 'Charlotte', 'Walker', '1993-04-17', 91234567, 2147483647, 'charlotte.walker@wanadoo.fr', '+33 567890123', '890 Champs-Elysées, Paris, France'),
(23, 5, 'Henry', 'Green', '1992-08-02', 89012347, 2147483647, 'henry.green@bigpond.com', '+61 789012345', '567 Collins St, Melbourne, Australia'),
(24, 5, 'Amelia', 'Baker', '1985-02-22', 78901248, 2147483647, 'amelia.baker@laposte.net', '+33 123456780', '456 Rue Voltaire, Marseille, France'),
(25, 5, 'Lucas', 'Turner', '1996-10-14', 56789013, 2147483647, 'lucas.turner@webmail.co.za', '+27 890123457', '321 Pretoria St, Johannesburg, South Africa'),
(26, 5, 'Grace', 'Collins', '1991-07-12', 45678901, 2147483647, 'grace.collins@163.com', '+86 912345678', '789 Nanjing Road, Shanghai, China'),
(27, 5, 'Daniel', 'Murphy', '1990-04-09', 34567892, 2147483647, 'daniel.murphy@webmail.com', '+44 123456890', '123 Princes St, Edinburgh, Scotland'),
(28, 5, 'Lily', 'Mitchell', '1992-12-28', 23456789, 2147483647, 'lily.mitchell@alice.it', '+39 987654321', '456 Via Milano, Milan, Italy'),
(29, 5, 'Michael', 'Perez', '1988-11-05', 12345678, 2147483647, 'michael.perez@terra.es', '+34 912345678', '123 Gran Via, Madrid, Spain'),
(30, 5, 'Sophia', 'Rivera', '1993-03-03', 98765432, 2147483647, 'sophia.rivera@ozemail.com.au', '+61 900123456', '912 Victoria Rd, Perth, Australia'),
(31, 5, 'Liam', 'Torres', '1995-09-12', 87654321, 2147483647, 'liam.torres@gmail.jp', '+81 567890123', '321 Shibuya, Tokyo, Japan'),
(32, 5, 'Olivia', 'Garcia', '1987-08-24', 76543210, 2147483647, 'olivia.garcia@uol.com.br', '+55 789012345', '678 Avenida Rio Branco, Rio de Janeiro, Brazil'),
(33, 5, 'James', 'Martinez', '1990-05-17', 65432109, 2147483647, 'james.martinez@gmail.ru', '+7 890123456', '890 Tverskaya St, Moscow, Russia'),
(34, 5, 'Emma', 'Sanchez', '1991-01-11', 54321098, 2147483647, 'emma.sanchez@ya.ru', '+7 123456789', '678 Nevsky Prospekt, St. Petersburg, Russia'),
(35, 5, 'Noah', 'Ramirez', '1989-12-30', 43210987, 2147483647, 'noah.ramirez@outlook.cn', '+86 912345678', '321 Tiananmen Square, Beijing, China'),
(36, 5, 'Charlotte', 'Hernandez', '1994-02-16', 32109876, 2147483647, 'charlotte.hernandez@web.de', '+49 567890123', '456 Friedrichstrasse, Berlin, Germany'),
(37, 5, 'William', 'Lopez', '1988-07-14', 21098765, 2147483647, 'william.lopez@wanadoo.fr', '+33 987654321', '123 Rue de Rivoli, Paris, France'),
(38, 5, 'Isabella', 'Clark', '1993-06-06', 10987654, 2147483647, 'isabella.clark@protonmail.com', '+41 789012345', '456 Bahnhofstrasse, Zurich, Switzerland'),
(39, 5, 'Liam', 'Wright', '1992-11-21', 90876543, 2147483647, 'liam.wright@gmail.nl', '+31 912345678', '321 Dam Square, Amsterdam, Netherlands'),
(40, 5, 'Amelia', 'Walker', '1990-09-10', 80765432, 2147483647, 'amelia.walker@hotmail.se', '+46 123456789', '678 Drottninggatan, Stockholm, Sweden'),
(41, 5, 'Henry', 'Green', '1994-10-31', 70654321, 2147483647, 'henry.green@bigpond.com.au', '+61 987654321', '890 Collins St, Melbourne, Australia'),
(42, 5, 'Sophia', 'Hall', '1989-11-15', 60543210, 2147483647, 'sophia.hall@gmail.co.uk', '+44 123456789', '678 Baker Street, London, UK'),
(43, 5, 'Oliver', 'Adams', '1991-03-12', 50432109, 2147483647, 'oliver.adams@gmail.fr', '+33 789012345', '123 Rue de Lille, Paris, France'),
(44, 5, 'Emily', 'King', '1987-05-25', 40321098, 2147483647, 'emily.king@yahoo.jp', '+81 567890123', '456 Shinjuku, Tokyo, Japan'),
(45, 5, 'Benjamin', 'Allen', '1992-06-30', 30210987, 2147483647, 'benjamin.allen@hotmail.it', '+39 912345678', '321 Piazza Venezia, Rome, Italy'),
(46, 5, 'Charlotte', 'Brown', '1986-08-08', 20109876, 2147483647, 'charlotte.brown@gmail.com.br', '+55 789012345', '123 Avenida Paulista, São Paulo, Brazil'),
(47, 5, 'James', 'Scott', '1990-04-13', 10098765, 2147483647, 'james.scott@webmail.mx', '+52 912345678', '456 Paseo de la Reforma, Mexico City, Mexico'),
(48, 5, 'Ava', 'Torres', '1994-11-07', 99087654, 2147483647, 'ava.torres@gmail.de', '+49 567890123', '678 Alexanderplatz, Berlin, Germany'),
(49, 5, 'William', 'Johnson', '1993-12-20', 88976543, 2147483647, 'william.johnson@live.se', '+46 123456789', '321 Kungsgatan, Stockholm, Sweden'),
(50, 5, 'Olivia', 'Garcia', '1989-06-03', 77865432, 2147483647, 'olivia.garcia@hotmail.nl', '+31 912345678', '123 Rembrandtplein, Amsterdam, Netherlands'),
(51, 5, 'Liam', 'White Kane', '1995-02-28', 66754321, 2147483647, 'liam.white@gmail.ca', '+1 789012345', '456 Bay St, Toronto, Canada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_financieros`
--

CREATE TABLE `reportes_financieros` (
  `reporte_id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `ingresos` decimal(10,2) DEFAULT NULL,
  `egresos` decimal(10,2) DEFAULT NULL,
  `ganancia` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` int(11) NOT NULL,
  `nombre_rol` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `nombre_rol`) VALUES
(1, 'Vendedor'),
(2, 'Administrador'),
(3, 'Sistemas'),
(4, 'Cliente'),
(5, 'Proveedor'),
(7, 'Sin Roles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` bigint(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `fecha_creacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `email`, `contrasena`, `rol_id`, `fecha_creacion`) VALUES
(29, 'kevinguerrero.14@gmail.com', 'kevinchavezguerrero', 3, '2024-12-26'),
(30, 'san32tiago.vega@gmail.com', 'Password123!', 1, '2024-12-08'),
(31, 'carla.santos@yahoo.com', 'SecurePass456$', 4, '2024-12-08'),
(32, 'felipe.castro@hotmail.com', 'Test1234@!', 4, '2024-12-08'),
(33, 'lorena.gutierrez@outlook.com', 'Passw0rd789!', 4, '2024-12-08'),
(34, 'manuel.torres@mail.com', 'Qwerty@1234', 4, '2024-12-08'),
(35, 'gabriela.mendoza@icloud.com', 'Strongpass!987', 4, '2024-12-08'),
(36, 'diego.serrano@live.com', 'Diego2024Pass@', 4, '2024-12-08'),
(37, 'nuria.paredes@aol.com', 'AolPass567#', 4, '2024-12-08'),
(38, 'oscar.ruiz@outlook.com', 'Ruis1234$#', 4, '2024-12-08'),
(39, 'lina.garcia@gmail.com', 'Garcia#2023$', 4, '2024-12-08'),
(40, 'raul.rodriguez@hotmail.com', 'Rodriguez1234@', 4, '2024-12-08'),
(41, 'elisa.marquez@icloud.com', 'Marquez!5678', 4, '2024-12-08'),
(42, 'fernando.jimenez@aol.com', 'Jimenez321$!', 4, '2024-12-08'),
(43, 'silvia.morales@mail.com', 'Morales123@#', 4, '2024-12-08'),
(44, 'antonio.castillo@outlook.com', 'Castillo*2024', 4, '2024-12-08'),
(45, 'julia.rios@live.com', 'Rios@1234$', 4, '2024-12-08'),
(46, 'ricardo.vazquez@icloud.com', 'Vazquez#4567@', 4, '2024-12-08'),
(47, 'victoria.fuentes@gmail.com', 'Fuentes789@!', 4, '2024-12-08'),
(48, 'sergio.nunez@yahoo.com', 'Nunez@Secure123', 4, '2024-12-08'),
(49, 'claudia.alvarez@hotmail.com', 'Alvarez#890', 4, '2024-12-08'),
(50, 'tomas.herrera@aol.com', 'Herrera2024@!', 4, '2024-12-08'),
(51, 'victoria.moreno@outlook.com', 'Moreno4567!#', 4, '2024-12-08'),
(52, 'jorge.gonzalez@mail.com', 'Gonzalez@2024', 4, '2024-12-08'),
(53, 'isabel.ruiz@gmail.com', 'Ruiz!2023#', 4, '2024-12-08'),
(54, 'luis.castro@live.com', 'Castro2024@!', 4, '2024-12-08'),
(55, 'juliana.reyes@outlook.com', 'Reyes@789!', 4, '2024-12-08'),
(56, 'ricardo.martin@icloud.com', 'Martin2024@#', 4, '2024-12-08'),
(57, 'cristina.molina@gmail.com', 'Molina123$!', 4, '2024-12-08'),
(58, 'fernando.sanchez@yahoo.com', 'Sanchez987#@', 4, '2024-12-08'),
(59, 'andrea.gomez@hotmail.com', 'Gomez2024*$', 4, '2024-12-08'),
(60, 'alberto.morales@icloud.com', 'Alberto@1234', 4, '2024-12-08'),
(61, 'monica.jimenez@aol.com', 'Monica#2024!', 4, '2024-12-08'),
(62, 'juan.perez@outlook.com', 'Perez*5678$', 4, '2024-12-08'),
(63, 'ana.garcia@mail.com', 'Ana!2024$#', 4, '2024-12-08'),
(64, 'pablo.martinez@gmail.com', 'Martinez@1234', 4, '2024-12-08'),
(65, 'ruth.rodriguez@live.com', 'Rodriguez456@', 4, '2024-12-08'),
(66, 'gonzalo.diaz@icloud.com', 'Gonzalo@!789', 4, '2024-12-08'),
(67, 'patricia.fernandez@aol.com', 'Patricia123!$', 4, '2024-12-08'),
(68, 'gabriel.lopez@outlook.com', 'Lopez987@!', 4, '2024-12-08'),
(69, 'paula.martinez@mail.com', 'Paula@1234$', 4, '2024-12-08'),
(70, 'roberto.moreno@icloud.com', 'Moreno#8901', 4, '2024-12-08'),
(71, 'carolina.smith@aol.com', 'Smith2024!#', 4, '2024-12-08'),
(72, 'mario.bautista@live.com', 'Bautista4567@', 4, '2024-12-08'),
(73, 'josé.santiago@outlook.com', 'Santiago@!2024', 4, '2024-12-08'),
(74, 'marta.gonzalez@mail.com', 'Gonzalez!1234', 4, '2024-12-08'),
(75, 'ricardo.jimenez@icloud.com', 'Ricardo1234!#', 4, '2024-12-08'),
(76, 'angelica.martin@aol.com', 'Angelica@2024!', 4, '2024-12-08'),
(77, 'victor.martinez@live.com', 'Victor@4567$', 4, '2024-12-08'),
(78, 'lucia.perez@outlook.com', 'Lucia@7890$', 4, '2024-12-08'),
(79, 'gabriel.reyes@mail.com', 'Reyes!5678@', 4, '2024-12-08'),
(80, 'francisco.sanchez@icloud.com', 'Francisco123$!', 4, '2024-12-08'),
(81, 'roberto.garcia@aol.com', 'Garcia@!8901', 4, '2024-12-08'),
(82, 'margarita.moreno@live.com', 'Moreno456!$', 4, '2024-12-08'),
(83, 'francisco.diaz@outlook.com', 'Diaz@2024#', 4, '2024-12-08'),
(84, 'maria.vazquez@mail.com', 'Vazquez@1234', 4, '2024-12-08'),
(85, 'cesar.ortiz@icloud.com', 'Ortiz#5678@', 4, '2024-12-08'),
(86, 'jorge.rodriguez@aol.com', 'Rodriguez2024@', 4, '2024-12-08'),
(87, 'elena.gonzalez@live.com', 'Gonzalez@8901$', 4, '2024-12-08'),
(88, 'roberto.martinez@outlook.com', 'Martinez#2024', 4, '2024-12-08'),
(89, 'cristina.perez@mail.com', 'Perez@4567$', 4, '2024-12-08'),
(90, 'sandra.martinez@icloud.com', 'Martinez123$!', 4, '2024-12-08'),
(91, 'margarita.lopez@aol.com', 'Lopez@7890$', 4, '2024-12-08'),
(92, 'pedro.garcia@live.com', 'Garcia123@#', 4, '2024-12-08'),
(93, 'hugo.perez@outlook.com', 'Perez4567#$', 4, '2024-12-08'),
(94, 'rosa.diaz@mail.com', 'Diaz1234@!', 4, '2024-12-08'),
(95, 'francisco.rodriguez@icloud.com', 'Rodriguez@2024', 4, '2024-12-08'),
(96, 'laura.reyes@aol.com', 'Reyes!8901$', 4, '2024-12-08'),
(97, 'ana.moreno@live.com', 'Moreno#1234$', 4, '2024-12-08'),
(98, 'juan.carlos@outlook.com', 'Carlos!7890', 4, '2024-12-08'),
(99, 'miguel.fernandez@mail.com', 'Miguel@4567$', 4, '2024-12-08'),
(100, 'elena.sanchez@icloud.com', 'Sanchez@1234', 4, '2024-12-08'),
(101, 'manuel.lopez@aol.com', 'Lopez!2024$', 4, '2024-12-08'),
(102, 'cristina.castro@live.com', 'Castro4567#@', 4, '2024-12-08'),
(103, 'natalia.perez@outlook.com', 'Perez@8901$', 4, '2024-12-08'),
(104, 'miguel.gonzalez@mail.com', 'Gonzalez2024@', 4, '2024-12-08'),
(105, 'victoria.herrera@icloud.com', 'Herrera#2024!', 4, '2024-12-08'),
(106, 'sara.martinez@aol.com', 'Martinez!8901', 4, '2024-12-08'),
(107, 'sergio.rodriguez@live.com', 'Rodriguez1234$', 4, '2024-12-08'),
(108, 'marta.diaz@outlook.com', 'Diaz@5678#', 4, '2024-12-08'),
(109, 'carla.garcia@mail.com', 'Garcia@8901$', 4, '2024-12-08'),
(110, 'alberto.sanchez@icloud.com', 'Sanchez#1234', 4, '2024-12-08'),
(111, 'juan.perez@aol.com', 'Perez!5678$', 4, '2024-12-08'),
(112, 'marta.reyes@live.com', 'Reyes2024#$', 4, '2024-12-08'),
(113, 'jose.gonzalez@outlook.com', 'Gonzalez123@!', 4, '2024-12-08'),
(114, 'raul.rodriguez@mail.com', 'Rodriguez!8901$', 4, '2024-12-08'),
(115, 'ana.torres@gmail.com', 'Torres2024#$', 5, '2024-12-08'),
(116, 'luis.martinez@yahoo.com', 'Luis@1234$', 5, '2024-12-08'),
(117, 'isabel.gonzalez@hotmail.com', 'Gonzalez1234!', 5, '2024-12-08'),
(118, 'david.rodriguez@outlook.com', 'David@5678#', 5, '2024-12-08'),
(119, 'marcos.reyes@icloud.com', 'Reyes@8901!', 5, '2024-12-08'),
(120, 'carmen.sanchez@aol.com', 'Sanchez2024@!', 5, '2024-12-08'),
(121, 'jorge.ferrer@mail.com', 'Ferrer@1234#', 5, '2024-12-08'),
(122, 'elena.moreno@live.com', 'Moreno#5678', 5, '2024-12-08'),
(123, 'pablo.lopez@outlook.com', 'Lopez1234$', 5, '2024-12-08'),
(124, 'marta.castillo@icloud.com', 'Castillo!7890', 5, '2024-12-08'),
(125, 'victor.hernandez@aol.com', 'Victor#2024@', 5, '2024-12-08'),
(126, 'liliana.ramos@live.com', 'Ramos2024@!', 5, '2024-12-08'),
(127, 'martin.perez@outlook.com', 'Perez1234$', 5, '2024-12-08'),
(128, 'paula.garcia@mail.com', 'Garcia#5678', 5, '2024-12-08'),
(129, 'fernando.cueto@icloud.com', 'Cueto!8901$', 5, '2024-12-08'),
(130, 'sonia.diaz@yahoo.com', 'Diaz@1234#', 5, '2024-12-08'),
(131, 'carlos.mendoza@hotmail.com', 'Mendoza2024$', 5, '2024-12-08'),
(132, 'olga.rojas@outlook.com', 'Rojas#5678$', 5, '2024-12-08'),
(133, 'josue.flores@icloud.com', 'Flores@8901!', 5, '2024-12-08'),
(134, 'mario.morales@aol.com', 'Morales1234$', 5, '2024-12-08'),
(135, 'sofia.silva@mail.com', 'Silva#2024@!', 5, '2024-12-08'),
(136, 'daniel.carrillo@live.com', 'Carrillo2024$', 5, '2024-12-08'),
(137, 'camila.rodriguez@outlook.com', 'Rodriguez@8901', 5, '2024-12-08'),
(138, 'juliana.castro@icloud.com', 'Castro#1234$', 5, '2024-12-08'),
(139, 'angel.garcia@aol.com', 'Garcia2024#$', 5, '2024-12-08'),
(140, 'joseph.martin@mail.com', 'Martin#5678@', 5, '2024-12-08'),
(141, 'maria.jimenez@outlook.com', 'Jimenez1234$', 5, '2024-12-08'),
(142, 'luis.gomez@gmail.com', 'Gomez2024#$', 1, '2024-12-08'),
(143, 'marta.lopez@yahoo.com', 'Lopez1234!', 1, '2024-12-08'),
(144, 'carlos.perez@hotmail.com', 'Perez!5678$', 1, '2024-12-08'),
(145, 'ana.martinez@outlook.com', 'Martinez@8901', 1, '2024-12-08'),
(146, 'jose.hernandez@icloud.com', 'Hernandez123$', 1, '2024-12-08'),
(147, 'sofia.castro@aol.com', 'Castro4567#', 1, '2024-12-08'),
(148, 'pedro.rodriguez@mail.com', 'Rodriguez2024@', 1, '2024-12-08'),
(149, 'laura.diaz@live.com', 'Diaz!1234$', 1, '2024-12-08'),
(150, 'mario.reyes@outlook.com', 'Reyes@5678#', 1, '2024-12-08'),
(151, 'carolina.flores@icloud.com', 'Flores8901$', 1, '2024-12-08'),
(152, 'jorge.garcia@aol.com', 'Garcia#1234$', 1, '2024-12-08'),
(153, 'sergio.morales@mail.com', 'Morales2024@!', 1, '2024-12-08'),
(154, 'isabel.sanchez@live.com', 'Sanchez@5678#', 1, '2024-12-08'),
(155, 'luis.moreno@outlook.com', 'Moreno1234$', 1, '2024-12-08'),
(156, 'christianmendoza.14@gmail.com', 'uknowzswe21', NULL, '2024-12-26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ajustes_inventario`
--
ALTER TABLE `ajustes_inventario`
  ADD PRIMARY KEY (`ajuste_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`almacenid`);

--
-- Indices de la tabla `almacen_productos`
--
ALTER TABLE `almacen_productos`
  ADD PRIMARY KEY (`almproid`),
  ADD KEY `producto_id` (`productoid`),
  ADD KEY `almacen_id` (`almacenid`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cliente_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `detalle_movimiento`
--
ALTER TABLE `detalle_movimiento`
  ADD PRIMARY KEY (`detalle_movimiento_id`),
  ADD KEY `almacen_detalle` (`almacen_id`),
  ADD KEY `detalle_movimiento` (`movimiento_id`),
  ADD KEY `producto_mane` (`producto_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`empleadoid`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `historial_costos`
--
ALTER TABLE `historial_costos`
  ADD PRIMARY KEY (`historial_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `movimiento_almacen_destinado`
--
ALTER TABLE `movimiento_almacen_destinado`
  ADD PRIMARY KEY (`movimiento_id`),
  ADD KEY `movimiento_id` (`movimiento_id`),
  ADD KEY `almacen_id` (`almacen_id`),
  ADD KEY `almacen_detalledas` (`cliente_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`productoid`),
  ADD KEY `categoria_many_products` (`idcategoria`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`proveedor_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `reportes_financieros`
--
ALTER TABLE `reportes_financieros`
  ADD PRIMARY KEY (`reporte_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `usermany` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ajustes_inventario`
--
ALTER TABLE `ajustes_inventario`
  MODIFY `ajuste_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `almacenid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `almacen_productos`
--
ALTER TABLE `almacen_productos`
  MODIFY `almproid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cliente_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `detalle_movimiento`
--
ALTER TABLE `detalle_movimiento`
  MODIFY `detalle_movimiento_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=638;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `empleadoid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `historial_costos`
--
ALTER TABLE `historial_costos`
  MODIFY `historial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `movimiento_almacen_destinado`
--
ALTER TABLE `movimiento_almacen_destinado`
  MODIFY `movimiento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `productoid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `proveedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ajustes_inventario`
--
ALTER TABLE `ajustes_inventario`
  ADD CONSTRAINT `ajustes_productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`productoid`);

--
-- Filtros para la tabla `almacen_productos`
--
ALTER TABLE `almacen_productos`
  ADD CONSTRAINT `almacen_productos` FOREIGN KEY (`productoid`) REFERENCES `productos` (`productoid`),
  ADD CONSTRAINT `almacen_productos2` FOREIGN KEY (`almacenid`) REFERENCES `almacen` (`almacenid`);

--
-- Filtros para la tabla `detalle_movimiento`
--
ALTER TABLE `detalle_movimiento`
  ADD CONSTRAINT `almacen_detalle` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`almacenid`),
  ADD CONSTRAINT `detalle_movimiento` FOREIGN KEY (`movimiento_id`) REFERENCES `movimiento_almacen_destinado` (`movimiento_id`),
  ADD CONSTRAINT `producto_mane` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`productoid`);

--
-- Filtros para la tabla `historial_costos`
--
ALTER TABLE `historial_costos`
  ADD CONSTRAINT `historial_productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`productoid`);

--
-- Filtros para la tabla `movimiento_almacen_destinado`
--
ALTER TABLE `movimiento_almacen_destinado`
  ADD CONSTRAINT `almacen_detalledas` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`cliente_id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `CATEHG` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `user_many` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`),
  ADD CONSTRAINT `usermany` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
