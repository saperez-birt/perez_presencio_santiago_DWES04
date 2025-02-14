DROP DATABASE IF EXISTS portal_videojuegos;
CREATE DATABASE portal_videojuegos;
USE portal_videojuegos;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE videojuegos (
    id_videojuego INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL CHECK (precio >= 0),
    stock INT NOT NULL CHECK (stock >= 0),
    estudio VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE biblioteca_videojuegos (
    id_usuario INT NOT NULL,
    id_videojuego INT NOT NULL,
    fecha_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario, id_videojuego),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_videojuego) REFERENCES videojuegos(id_videojuego) ON DELETE CASCADE
);

INSERT INTO usuarios (nombre, apellidos, email) VALUES 
('Carlos', 'Pérez', 'carlos.perez@example.com'),
('Laura', 'González', 'laura.gonzalez@example.com'),
('David', 'Martínez', 'david.martinez@example.com'),
('Sofía', 'López', 'sofia.lopez@example.com');

INSERT INTO videojuegos (nombre, descripcion, precio, stock, estudio) VALUES
('Elden Ring', 'Un RPG de acción en un vasto mundo abierto.', 59.99, 50, 'estudio'),
('God of War: Ragnarok', 'Kratos y Atreus enfrentan su destino.', 69.99, 40, 'estudio'),
('Horizon Forbidden West', 'Aloy explora el Oeste Prohibido.', 69.99, 30, 'estudio'),
('Stray', 'Un gato en una ciudad cyberpunk.', 29.99, 60, 'estudio'),
('Xenoblade Chronicles 3', 'Una historia épica de rol.', 59.99, 20, 'estudio'),
('Tunic', 'Un zorro aventurero en un mundo misterioso.', 39.99, 35, 'estudio'),
('A Plague Tale: Requiem', 'Hugo y Amicia en una nueva lucha.', 59.99, 25, 'estudio'),
('Bayonetta 3', 'La bruja de Umbra regresa con más acción.', 49.99, 30, 'estudio'),
('Mario + Rabbids Sparks of Hope', 'Mario y Rabbids salvan la galaxia.', 59.99, 40, 'estudio'),
('Pokémon Legends: Arceus', 'Explora el mundo Pokémon en el pasado.', 59.99, 50, 'estudio');

INSERT INTO biblioteca_videojuegos (id_usuario, id_videojuego) VALUES
(1, 1),
(1, 5),
(2, 2),
(2, 4),
(3, 3),
(3, 6),
(3, 8),
(4, 7),
(4, 9),
(4, 10),
(2, 1),
(1, 8),
(3, 10);
