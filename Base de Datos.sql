-- Crear tabla Usuario
CREATE TABLE Usuario (
    ID_usuario INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255),
    Apellido_paterno VARCHAR(255),
    Apellido_materno VARCHAR(255),
    Contrasena VARCHAR(150),
    Direccion VARCHAR(255),
    Telefono VARCHAR(15),
    Correo VARCHAR(255)
);

-- Crear tabla Cliente
CREATE TABLE Cliente (
    ID_Cliente INT PRIMARY KEY AUTO_INCREMENT,
    No_Tarjeta VARCHAR(16),
    ID_usuario INT,
    FOREIGN KEY (ID_usuario) REFERENCES Usuario(ID_usuario)
);

-- Crear tabla Empleado
CREATE TABLE Empleado (
    ID_Empleado INT PRIMARY KEY AUTO_INCREMENT,
    Fecha_Contratacion DATE,
    Horas_Trabajo INT,
    Especialidad VARCHAR(255),
    ID_usuario INT,
    FOREIGN KEY (ID_usuario) REFERENCES Usuario(ID_usuario)
);

-- Crear tabla Sueldo
CREATE TABLE Sueldo (
    ID_Sueldo INT PRIMARY KEY AUTO_INCREMENT,
    Monto DECIMAL(10, 2),
    Fecha_Pago DATE,
    ID_Empleado INT,
    FOREIGN KEY (ID_Empleado) REFERENCES Empleado(ID_Empleado)
);

 -- Crear tabla Envio
 CREATE TABLE Envio (
    ID_Envio INT PRIMARY KEY AUTO_INCREMENT,
    Direccion_Envio VARCHAR(255),
    Fecha_Envio DATE,
    Fecha_Entrega DATE,
    Estado VARCHAR(20),
    ID_Cliente INT,
    FOREIGN KEY (ID_Cliente) REFERENCES Cliente(ID_Cliente)
);

-- Crear tabla Transaccion
CREATE TABLE Transaccion (
    ID_Transaccion INT PRIMARY KEY AUTO_INCREMENT,
    Monto DECIMAL(10, 2),
    Fecha_Transaccion DATE,
    Estado VARCHAR(20),
    ID_Cliente INT,
    FOREIGN KEY (ID_Cliente) REFERENCES Cliente(ID_Cliente)
);

-- Crear tabla Pedido
CREATE TABLE Pedido (
    ID_Pedido INT PRIMARY KEY AUTO_INCREMENT,
    Fecha_pedido DATE,
    Fecha_Entrega DATE,
    Estado VARCHAR(20),
    ID_Cliente INT,
    FOREIGN KEY (ID_Cliente) REFERENCES Cliente(ID_Cliente)
);

-- Crear tabla Producto
CREATE TABLE Producto (
    ID_Producto INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_Producto VARCHAR(255),
    Descripcion_Producto VARCHAR(255),
    Precio DECIMAL(10, 2) 
);

-- Crear tabla Detalle_Pedido
CREATE TABLE Detalle_Pedido (
    ID_Pedido INT,
    ID_Producto INT,
    Cantidad INT,
    -- PRIMARY KEY (ID_Pedido, ID_Producto),
    FOREIGN KEY (ID_Pedido) REFERENCES Pedido(ID_Pedido),
    FOREIGN KEY (ID_Producto) REFERENCES Producto(ID_Producto)
);

-- Crear tabla Proveedor
CREATE TABLE Proveedor (
    ID_Proveedor INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_Proveedor VARCHAR(255),
    Apellido_Paterno VARCHAR(255),
    Apellido_Materno VARCHAR(255),
    Direccion VARCHAR(255),
    Telefono VARCHAR(15),
    Correo VARCHAR(255)
);

-- Crear tabla Suministrar
CREATE TABLE Suministrar (
    ID_Producto INT,
    ID_Proveedor INT,
    Fecha_Entrega DATE,
    -- PRIMARY KEY (ID_Producto, ID_Proveedor),
    FOREIGN KEY (ID_Producto) REFERENCES Producto(ID_Producto),
    FOREIGN KEY (ID_Proveedor) REFERENCES Proveedor(ID_Proveedor)
);

-- Crear tabla Inventario
CREATE TABLE Inventario (
    ID_Producto INT,
    Stock INT,
    Fecha_Actualizacion DATE,
    FOREIGN KEY (ID_Producto) REFERENCES Producto(ID_Producto)
);

-- Crear tabla Categoria
CREATE TABLE Categoria (
    ID_Categoria INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_Categoria VARCHAR(255),
    Descripcion_Categoria VARCHAR(255)
);

-- Crear tabla Pertenecer
CREATE TABLE Pertenecer (
    ID_Producto INT,
    ID_Categoria INT,
    -- PRIMARY KEY (ID_Producto, ID_Categoria),
    FOREIGN KEY (ID_Producto) REFERENCES Producto(ID_Producto),
    FOREIGN KEY (ID_Categoria) REFERENCES Categoria(ID_Categoria)
);