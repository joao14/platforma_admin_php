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
    documento BLOB,
    descripcion VARCHAR(250),
    mime VARCHAR(50),
    observacion VARCHAR(250) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,   
    id_usuario BIGINT UNSIGNED,
    id_estado BIGINT UNSIGNED,
    id_area BIGINT UNSIGNED,
    FOREIGN KEY (id_usuario) references usuarios(id_usuario)
);

DROP TABLE IF EXISTS areas;
CREATE TABLE areas (
    id_area BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion VARCHAR(100)
);

DROP TABLE IF EXISTS estados;
CREATE TABLE estados (
    id_estado BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(100),
    nombres VARCHAR(50),
    descripcion VARCHAR(100)
);
