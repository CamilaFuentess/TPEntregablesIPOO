-- Active: 1717691537877@@127.0.0.1@3306@bdviajes
CREATE DATABASE bdviajes; 

CREATE TABLE empresa(
    idempresa bigint AUTO_INCREMENT,
    enombre varchar(150),
    edireccion varchar(150),
    PRIMARY KEY (idempresa)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE persona (
    idpersona bigint AUTO_INCREMENT, 
    documento VARCHAR(15),    
    nombre VARCHAR(150),
    apellido VARCHAR(150),
    telefono VARCHAR(50),
    PRIMARY KEY(idpersona)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;

CREATE TABLE responsable (
    rnumeroempleado bigint AUTO_INCREMENT,
    rnumerolicencia bigint,
    idpersona bigint,
    PRIMARY KEY (rnumeroempleado),
    FOREIGN KEY (idpersona) REFERENCES persona (idpersona)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;;
	
CREATE TABLE viaje (
    idviaje bigint AUTO_INCREMENT, /*codigo de viaje*/
	vdestino varchar(150),
    vcantmaxpasajeros int,
	idempresa bigint ,
    rnumeroempleado bigint,
    vimporte float,
    PRIMARY KEY (idviaje),
    FOREIGN KEY (idempresa) REFERENCES empresa (idempresa)
    ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (rnumeroempleado) REFERENCES responsable (rnumeroempleado)
    ON UPDATE CASCADE
    ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;
	
CREATE TABLE pasajero (
    idpasajero bigint AUTO_INCREMENT,
    idpersona bigint,
	idviaje bigint, 
    PRIMARY KEY (idpasajero),
    FOREIGN KEY (idpersona) REFERENCES persona (idpersona),
	FOREIGN KEY (idviaje) REFERENCES viaje (idviaje)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;; 
 

