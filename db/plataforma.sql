DROP TABLE IF EXISTS perfiles;
CREATE TABLE perfiles (
    id_perfil BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    perfil VARCHAR(100),
    descripcion VARCHAR(100)
);

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
    id_usuario BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,    
    identificacion VARCHAR(13) UNIQUE,
    nombres VARCHAR(50),
    apellidos VARCHAR(50),
    email VARCHAR(100),
    telefono VARCHAR(20),
    user VARCHAR(15),
    password varchar(50),
    direccion VARCHAR(500),
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    id_perfil BIGINT UNSIGNED,
    FOREIGN KEY (id_perfil) REFERENCES perfiles(id_perfil)
);

DROP TABLE IF EXISTS documentos;
CREATE TABLE documentos (
    id_documento BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    estado VARCHAR(2),
    documento BLOB,
    descripcion VARCHAR(250),
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,   
    id_usuario BIGINT UNSIGNED,
    FOREIGN KEY (id_usuario) references usuarios(id_usuario)
);
