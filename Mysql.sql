CREATE TABLE `Roles` (
  `rol_id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre_rol` varchar(50)
);

CREATE TABLE `Usuarios` (
  `usuario_id` int PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(100) UNIQUE,
  `contrasena` varchar(255),
  `rol_id` int,
  `fecha_creacion` timestamp DEFAULT 'CURRENT_TIMESTAMP'
);

CREATE TABLE `Clientes` (
  `cliente_id` int PRIMARY KEY AUTO_INCREMENT,
  `usuario_id` int,
  `nombre` varchar(200),
  `apellido` varchar(200),
  `fecha_nac` date,
  `dni` int,
  `foto` blob,
  `ruc` int,
  `correo` varchar(200),
  `telefono` varchar(20),
  `direccion` varchar(200)
);

CREATE TABLE `Proveedores` (
  `proveedor_id` int PRIMARY KEY AUTO_INCREMENT,
  `usuario_id` int,
  `nombre` varchar(200),
  `apellido` varchar(200),
  `fecha_nac` date,
  `dni` int,
  `foto` blob,
  `ruc` int,
  `correo` varchar(200),
  `telefono` varchar(20),
  `direccion` varchar(200)
);

CREATE TABLE `Empleados` (
  `empleado_id` int PRIMARY KEY AUTO_INCREMENT,
  `usuario_id` int,
  `rango` varchar(100),
  `nombre` varchar(200),
  `apellido` varchar(200),
  `fecha_nac` date,
  `dni` int,
  `foto` blob,
  `correo` varchar(200),
  `telefono` varchar(20),
  `direccion` varchar(200)
);

CREATE TABLE `Productos` (
  `producto_id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre_producto` varchar(100),
  `descripcion` text,
  `precio` decimal(10,2),
  `stock` int
);

CREATE TABLE `Almacen` (
  `almacen_id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre_almacen` varchar(100),
  `direccion_almacen` varchar(200)
);

CREATE TABLE `Movimientos_Almacen_Salida` (
  `movimiento_id` int PRIMARY KEY AUTO_INCREMENT,
  `producto_id` int,
  `cantidad` int,
  `fecha` timestamp DEFAULT 'CURRENT_TIMESTAMP',
  `tipo_movimiento` varchar(50) DEFAULT 'Salida'
);

CREATE TABLE `Movimiento_Almacen_Entrada` (
  `movimiento_id` int PRIMARY KEY AUTO_INCREMENT,
  `producto_id` int,
  `cantidad` int,
  `fecha` timestamp DEFAULT 'CURRENT_TIMESTAMP',
  `tipo_movimiento` varchar(50) DEFAULT 'Entrada'
);

CREATE TABLE `Ajustes_Inventario` (
  `ajuste_id` int PRIMARY KEY AUTO_INCREMENT,
  `producto_id` int,
  `cantidad_ajustada` int,
  `tipo_ajuste` varchar(50),
  `fecha` timestamp DEFAULT 'CURRENT_TIMESTAMP'
);

CREATE TABLE `Reportes_Financieros` (
  `reporte_id` int PRIMARY KEY AUTO_INCREMENT,
  `fecha_inicio` date,
  `fecha_fin` date,
  `ingresos` decimal(10,2),
  `egresos` decimal(10,2),
  `ganancia` decimal(10,2)
);

CREATE TABLE `Historial_costos` (
  `historial_id` int PRIMARY KEY AUTO_INCREMENT,
  `producto_id` int,
  `costo` decimal(10,2),
  `fecha` timestamp DEFAULT 'CURRENT_TIMESTAMP'
);

CREATE TABLE `Almacen_Productos` (
  `producto_id` int,
  `almacen_id` int,
  `fecha_envio` datetime,
  `estado` varchar(200)
);

CREATE TABLE `Movimiento_Almacen_Destinado` (
  `movimiento_id` int,
  `almacen_id` int,
  `cantidad_enviada` int,
  `fecha_envio` date,
  `estado` varchar(200)
);

ALTER TABLE `Usuarios` ADD FOREIGN KEY (`rol_id`) REFERENCES `Roles` (`rol_id`);

ALTER TABLE `Clientes` ADD FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`usuario_id`);

ALTER TABLE `Proveedores` ADD FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`usuario_id`);

ALTER TABLE `Empleados` ADD FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`usuario_id`);

ALTER TABLE `Movimientos_Almacen_Salida` ADD FOREIGN KEY (`producto_id`) REFERENCES `Productos` (`producto_id`);

ALTER TABLE `Movimiento_Almacen_Entrada` ADD FOREIGN KEY (`producto_id`) REFERENCES `Productos` (`producto_id`);

ALTER TABLE `Ajustes_Inventario` ADD FOREIGN KEY (`producto_id`) REFERENCES `Productos` (`producto_id`);

ALTER TABLE `Historial_costos` ADD FOREIGN KEY (`producto_id`) REFERENCES `Productos` (`producto_id`);

ALTER TABLE `Almacen_Productos` ADD FOREIGN KEY (`producto_id`) REFERENCES `Productos` (`producto_id`);

ALTER TABLE `Almacen_Productos` ADD FOREIGN KEY (`almacen_id`) REFERENCES `Almacen` (`almacen_id`);

ALTER TABLE `Movimiento_Almacen_Destinado` ADD FOREIGN KEY (`movimiento_id`) REFERENCES `Movimiento_Almacen_Entrada` (`movimiento_id`);

ALTER TABLE `Movimiento_Almacen_Destinado` ADD FOREIGN KEY (`almacen_id`) REFERENCES `Almacen` (`almacen_id`);
