CREATE DATABASE ea1;

USE ea1;
select * from productos
CREATE TABLE Productos (
    Id_producto INT AUTO_INCREMENT PRIMARY KEY,
    Codigo VARCHAR(50) NOT NULL,
    Nombre VARCHAR(100) NOT NULL,
    Categoria VARCHAR(100) NOT NULL,
    Stock INT NOT NULL,
    Precio DECIMAL(10, 2) NOT NULL
);


INSERT INTO Productos (Codigo, Nombre, Categoria, Stock, Precio) VALUES
('L001', 'Whisky Johnnie Walker Black Label', 'Licores', 50, 45.99),
('L002', 'Tequila José Cuervo', 'Licores', 30, 34.50),
('L003', 'Vino Tinto Malbec', 'Vinos', 100, 15.99),
('L004', 'Cerveza Corona', 'Cervezas', 200, 1.49),
('L005', 'Ron Bacardi Superior', 'Licores', 40, 25.00),
('L006', 'Vodka Absolut', 'Licores', 25, 28.99),
('L007', 'Vino Blanco Sauvignon Blanc', 'Vinos', 80, 18.50),
('L008', 'Cerveza Heineken', 'Cervezas', 150, 1.99),
('L009', 'Whisky Chivas Regal 12 años', 'Licores', 60, 40.00),
('L010', 'Cerveza Budweiser', 'Cervezas', 180, 1.79);
