-- Tabla de usuarios
CREATE TABLE usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contrasenia VARCHAR(512) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de contactos
CREATE TABLE contactos (
    contacto_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50),
    email VARCHAR(100),
    telefono VARCHAR(20),
    direccion VARCHAR(255),
    fecha_nacimiento DATE,
    foto_perfil VARCHAR(255),
  	etiqueta VARCHAR(255),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id) ON DELETE CASCADE
);


-- Tabla de grupos de contactos
CREATE TABLE creacion_grupo (
    creacion_grupo_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    nombre_grupo VARCHAR(50) NOT NULL,
  	foto_grupo VARCHAR(255),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id) ON DELETE CASCADE
);

-- Tabla de relación entre contactos y grupos de contactos
CREATE TABLE contacto_grupo (
    contacto_grupo_id INT AUTO_INCREMENT PRIMARY KEY,
    contacto_id INT,
    creacion_grupo_id INT,
    FOREIGN KEY (contacto_id) REFERENCES contactos(contacto_id) ON DELETE CASCADE,
    FOREIGN KEY (creacion_grupo_id) REFERENCES creacion_grupo(creacion_grupo_id) ON DELETE CASCADE
);

-- final
