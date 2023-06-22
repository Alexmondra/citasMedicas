-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema citas_regional
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema citas_regional
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `citas_regional` DEFAULT CHARACTER SET latin1 ;
USE `citas_regional` ;

-- -----------------------------------------------------
-- Table `citas_regional`.`persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`persona` (
  `id_persona` INT(11) NOT NULL AUTO_INCREMENT,
  `img` VARCHAR(200) NULL DEFAULT NULL,
  `tipo_documento` CHAR(1) NULL DEFAULT NULL COMMENT '1:DNI 2:PASAPORTE 3:CARNET_EXTRANJERIA 4:CARNET_IDENTIDAD 5:CARNET_PERMISO',
  `numero_documento` VARCHAR(25) NULL DEFAULT NULL,
  `apellido_m` VARCHAR(45) NULL DEFAULT NULL,
  `apellido_p` VARCHAR(45) NULL DEFAULT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `telefono` VARCHAR(15) NULL DEFAULT NULL,
  `fecha_nacimiento` DATE NULL DEFAULT NULL,
  `sexo` CHAR(1) NULL DEFAULT NULL,
  `direccion` VARCHAR(100) NULL DEFAULT NULL,
  `estado_civil` VARCHAR(45) NULL DEFAULT NULL,
  `tipo_persona` CHAR(1) NULL DEFAULT NULL COMMENT '1: PACIENTE 2:DOCTOR  3:ADMISIONISTA 4:ADMINISTRADOR',
  PRIMARY KEY (`id_persona`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `citas_regional`.`paciente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`paciente` (
  `id_paciente` INT(11) NOT NULL AUTO_INCREMENT,
  `id_persona` INT(11) NOT NULL,
  `ocupacion` VARCHAR(45) NULL DEFAULT NULL,
  `alergias` CHAR(1) NULL DEFAULT NULL COMMENT '1: SI 2:NO',
  `descripcion_alergias` VARCHAR(100) NULL DEFAULT NULL,
  `creado` DATETIME NULL DEFAULT NULL,
  `actualizado` DATETIME NULL DEFAULT NULL,
  `eliminado` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id_paciente`),
  INDEX `fk_paciente_persona1_idx` (`id_persona` ASC) VISIBLE,
  CONSTRAINT `fk_paciente_persona1`
    FOREIGN KEY (`id_persona`)
    REFERENCES `citas_regional`.`persona` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `citas_regional`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`usuario` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `id_persona` INT(11) NOT NULL,
  `estado` TINYINT(4) NULL DEFAULT NULL,
  `clave` VARCHAR(100) NULL DEFAULT NULL,
  `creado` DATETIME NULL DEFAULT NULL,
  `actualizado` DATETIME NULL DEFAULT NULL,
  `eliminado` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_medico_persona1_idx` (`id_persona` ASC) VISIBLE,
  CONSTRAINT `fk_medico_persona1`
    FOREIGN KEY (`id_persona`)
    REFERENCES `citas_regional`.`persona` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `citas_regional`.`cita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`cita` (
  `id_cita` INT(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` INT(11) NOT NULL,
  `id_medico` INT(11) NOT NULL,
  `detalle` VARCHAR(100) NULL DEFAULT NULL,
  `estado` VARCHAR(45) NULL DEFAULT NULL,
  `persona_responsable` VARCHAR(45) NULL DEFAULT NULL,
  `intervenciones` VARCHAR(45) NULL DEFAULT NULL,
  `vacunas_completas` VARCHAR(45) NULL DEFAULT NULL COMMENT '1: SI 2:NO',
  `fecha_cita` DATETIME NULL,
  `especialidad` VARCHAR(45) NULL,
  `precio` FLOAT NULL,
  `numero_persona_responsable` VARCHAR(45) NULL,
  PRIMARY KEY (`id_cita`, `id_paciente`, `id_medico`),
  INDEX `fk_cita_paciente1_idx` (`id_paciente` ASC) VISIBLE,
  INDEX `fk_cita_usuario1_idx` (`id_medico` ASC) VISIBLE,
  CONSTRAINT `fk_cita_paciente1`
    FOREIGN KEY (`id_paciente`)
    REFERENCES `citas_regional`.`paciente` (`id_paciente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cita_usuario1`
    FOREIGN KEY (`id_medico`)
    REFERENCES `citas_regional`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `citas_regional`.`especialidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`especialidad` (
  `id_especialidad` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `descripcion` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id_especialidad`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `citas_regional`.`historia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`historia` (
  `id_historia` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NULL DEFAULT NULL,
  `resultado` VARCHAR(45) NULL DEFAULT NULL,
  `motivo` VARCHAR(45) NULL DEFAULT NULL,
  `archivo` VARCHAR(200) NULL DEFAULT NULL,
  `id_paciente` INT(11) NOT NULL,
  `id_medico` INT(11) NOT NULL,
  PRIMARY KEY (`id_historia`, `id_paciente`, `id_medico`),
  INDEX `fk_historia_paciente1_idx` (`id_paciente` ASC) VISIBLE,
  INDEX `fk_historia_medico_idx` (`id_medico` ASC) VISIBLE,
  CONSTRAINT `fk_historia_medico`
    FOREIGN KEY (`id_medico`)
    REFERENCES `citas_regional`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_historia_paciente1`
    FOREIGN KEY (`id_paciente`)
    REFERENCES `citas_regional`.`paciente` (`id_paciente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `citas_regional`.`horario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`horario` (
  `id_horario` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) NOT NULL,
  `fecha` DATE NULL DEFAULT NULL,
  `hora_inicio` TIME NULL DEFAULT NULL,
  `hora_fin` TIME NULL DEFAULT NULL,
  `cupos` INT NULL,
  PRIMARY KEY (`id_horario`),
  INDEX `fk_horario_usuario1_idx` (`id_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_horario_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `citas_regional`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `citas_regional`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`roles` (
  `id_rol` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `descripcion` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id_rol`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `citas_regional`.`usuario_especialidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`usuario_especialidad` (
  `id_usuario_especialidad` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id_usuario` INT(11) NOT NULL,
  `especialidad_id_especialidad` INT(11) NOT NULL,
  PRIMARY KEY (`id_usuario_especialidad`),
  INDEX `fk_usuario_has_especialidad_especialidad1_idx` (`especialidad_id_especialidad` ASC) VISIBLE,
  INDEX `fk_usuario_has_especialidad_usuario1_idx` (`usuario_id_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_has_especialidad_especialidad1`
    FOREIGN KEY (`especialidad_id_especialidad`)
    REFERENCES `citas_regional`.`especialidad` (`id_especialidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_especialidad_usuario1`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `citas_regional`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `citas_regional`.`usuario_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`usuario_roles` (
  `id_usuario_rol` INT(11) NOT NULL AUTO_INCREMENT,
  `roles_id_rol` INT(11) NOT NULL,
  `usuario_id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_usuario_rol`),
  INDEX `fk_roles_has_usuario_usuario1_idx` (`usuario_id_usuario` ASC) VISIBLE,
  INDEX `fk_roles_has_usuario_roles1_idx` (`roles_id_rol` ASC) VISIBLE,
  CONSTRAINT `fk_roles_has_usuario_roles1`
    FOREIGN KEY (`roles_id_rol`)
    REFERENCES `citas_regional`.`roles` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_has_usuario_usuario1`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `citas_regional`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `citas_regional`.`atencion_cita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`atencion_cita` (
  `id_atencion` INT NOT NULL auto_increment,
  `id_cita` INT(11) NOT NULL,
  `id_admisionista` INT(11) NOT NULL,
  `fecha` DATE NULL,
  `entrada` TIME NULL,
  `salida` TIME NULL,
  PRIMARY KEY (`id_atencion`),
  INDEX `fk_atencion_cita_cita1_idx` (`id_cita` ASC) VISIBLE,
  INDEX `fk_atencion_cita_usuario1_idx` (`id_admisionista` ASC) VISIBLE,
  CONSTRAINT `fk_atencion_cita_cita1`
    FOREIGN KEY (`id_cita`)
    REFERENCES `citas_regional`.`cita` (`id_cita`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_atencion_cita_usuario1`
    FOREIGN KEY (`id_admisionista`)
    REFERENCES `citas_regional`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citas_regional`.`pagos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`pagos` (
  `id_pagos` INT NOT NULL auto_increment,
  `id_cita` INT(11) NOT NULL,
  `id_admisionista` INT(11) NOT NULL,
  `precio` FLOAT NULL,
  `estado` TINYINT NULL COMMENT '0: NO CANCELADO 1: CANCELADO',
  `tipo_pago` VARCHAR(45) NULL,
  PRIMARY KEY (`id_pagos`, `id_admisionista`),
  INDEX `fk_pagos_cita1_idx` (`id_cita` ASC) VISIBLE,
  INDEX `fk_pagos_usuario1_idx` (`id_admisionista` ASC) VISIBLE,
  CONSTRAINT `fk_pagos_cita1`
    FOREIGN KEY (`id_cita`)
    REFERENCES `citas_regional`.`cita` (`id_cita`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pagos_usuario1`
    FOREIGN KEY (`id_admisionista`)
    REFERENCES `citas_regional`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citas_regional`.`reprogramaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`reprogramaciones` (
  `id_reprogramacin` INT NOT NULL auto_increment,
  `id_cita` INT(11) NOT NULL,
  `fecha_anterior` DATETIME NULL,
  `fecha_nueva` DATETIME NULL,
  PRIMARY KEY (`id_reprogramacin`),
  INDEX `fk_reprogramaciones_cita1_idx` (`id_cita` ASC) VISIBLE,
  CONSTRAINT `fk_reprogramaciones_cita1`
    FOREIGN KEY (`id_cita`)
    REFERENCES `citas_regional`.`cita` (`id_cita`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citas_regional`.`precios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`precios` (
  `id_precio` INT NOT NULL,
  `fecha` DATETIME NULL,
  `precio` FLOAT NULL,
  `id_administrador` INT(11) NOT NULL,
  `id_especialidad` INT(11) NOT NULL,
  PRIMARY KEY (`id_precio`),
  INDEX `fk_precios_usuario1_idx` (`id_administrador` ASC) VISIBLE,
  INDEX `fk_precios_especialidad1_idx` (`id_especialidad` ASC) VISIBLE,
  CONSTRAINT `fk_precios_usuario1`
    FOREIGN KEY (`id_administrador`)
    REFERENCES `citas_regional`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_precios_especialidad1`
    FOREIGN KEY (`id_especialidad`)
    REFERENCES `citas_regional`.`especialidad` (`id_especialidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- -----------------------------------------------------
-- carga de datos para inicar
-- -----------------------------------------------------

use citas_regional;
INSERT INTO `citas_regional`.`persona` (`img`, `tipo_documento`, `numero_documento`, `apellido_m`, `apellido_p`, `nombre`, `telefono`, `fecha_nacimiento`, `sexo`, `direccion`, `estado_civil`, `tipo_persona`) VALUES
('imagen1.jpg', '1', '12345678', 'ApellidoM1', 'ApellidoP1', 'jose', '123456789', '1990-01-01', 'M', 'Dirección1', 'Soltero/a', '1'),
('imagen2.jpg', '2', '963258741', 'ApellidoM2', 'ApellidoP2', 'luiz', '987654321', '1992-03-15', 'F', 'Dirección2', 'Casado/a', '1'),
('imagen3.jpg', '3', '896325871', 'ApellidoM3', 'ApellidoP3', 'segundo', '555555555', '1985-09-20', 'M', 'Dirección3', 'Soltero/a', '1'),
('imagen4.jpg', '1', '986589745', 'ApellidoM4', 'ApellidoP4', 'heisen', '111111111', '1978-05-12', 'M', 'Dirección4', 'Casado/a', '1'),
('imagen5.jpg', '2', '78965216', 'ApellidoM5', 'ApellidoP5', 'pedro', '222222222', '1995-12-30', 'F', 'Dirección5', 'Soltero/a', '1'),
('imagen6.jpg', '1', '65432198', 'ApellidoM6', 'ApellidoP6', 'victor', '333333333', '1982-07-18', 'M', 'Dirección6', 'Casado/a', '2'),
('imagen7.jpg', '4', '96326589', 'ApellidoM7', 'ApellidoP7', 'elmer', '444444444', '1976-11-05', 'M', 'Dirección7', 'Soltero/a', '2'),
('imagen8.jpg', '1', '13579246', 'ApellidoM8', 'ApellidoP8', 'yarango', '555555555', '1998-02-25', 'F', 'Dirección8', 'Casado/a', '3'),
('imagen9.jpg', '3', '89647116', 'ApellidoM9', 'ApellidoP9', 'antoni', '666666666', '1993-08-10', 'M', 'Dirección9', 'Soltero/a', '3'),
('imagen10.jpg', '2','78965412', 'ApellidoM10', 'ApellidoP10', 'neiser', '777777777', '1980-04-08', 'F', 'Dirección10', 'Casado/a', '4');


INSERT INTO `citas_regional`.`paciente` (`id_persona`, `ocupacion`, `alergias`, `descripcion_alergias`, `creado`, `actualizado`, `eliminado`)
VALUES
(1, 'Estudiante', '1', 'Polen', '2023-06-01 10:00:00', NULL, NULL),
(2, 'Ingeniero', '2', NULL, '2023-06-02 12:25:00', NULL, NULL),
(3, 'Doctor', '1', 'Penicilina', '2023-06-03 07:30:00', NULL, NULL),
(4, 'Enfermera', '2', NULL, '2023-06-04 10:45:00', NULL, NULL),
(5, 'Estudiante', '2', NULL, '2023-06-05 05:15:00', NULL, NULL);


INSERT INTO `citas_regional`.`usuario` (`id_persona`, `estado`, `clave`, `creado`, `actualizado`, `eliminado`)
VALUES
(6, 1, 'clave1', '2023-06-01 10:00:00', NULL, NULL),
(7, 1, 'clave2', '2023-06-02 11:15:00', NULL, NULL),
(8, 1, 'clave3', '2023-06-03 09:30:00', NULL, NULL),
(9, 1, 'clave4', '2023-06-04 12:45:00', NULL, NULL),
(10, 1, 'clave5', '2023-06-05 08:00:00', NULL, NULL);



INSERT INTO `citas_regional`.`cita` 
(`id_paciente`, `id_medico`, `detalle`, `estado`, `persona_responsable`, `intervenciones`, `vacunas_completas`, `fecha_cita`, `especialidad`, `precio`, `numero_persona_responsable`) 
VALUES 
(1, 1, 'Consulta de rutina', 'Pendiente', 'Juan Perez', 'Ninguna', '1', '2023-06-20 09:00:00', 'Pediatría', 50.00, '555-123-4567'),
(2, 2, 'Extracción de muelas', 'Realizada', 'Maria Lopez', 'Anestesia local', '2', '2023-06-21 10:30:00', 'Odontología', 75.00, '555-987-6543'),
(2, 1, 'Control de embarazo', 'Pendiente', 'Ana Ramirez', 'Ninguna', '1', '2023-06-22 16:15:00', 'Ginecología', 60.00, '555-789-0123'),
(4, 2, 'Consulta de seguimiento', 'Realizada', 'Pedro Martinez', 'Ninguna', '2', '2023-06-23 11:00:00', 'Medicina General', 45.00, '555-456-7890'),
(5, 1, 'Revisión ocular', 'Pendiente', 'Laura Sanchez', 'Examen de vista', '1', '2023-06-24 14:45:00', 'Oftalmología', 55.00, '555-567-8901');


INSERT INTO `citas_regional`.`reprogramaciones` (`id_cita`, `fecha_anterior`, `fecha_nueva`)
VALUES
  (1, '2023-06-20 09:00:00', '2023-06-02 14:00:00'),
  (3, '2023-06-22 16:15:00', '2023-06-05 11:00:00'),
  (5, '2023-06-24 14:45:00', '2023-06-09 10:30:00');

INSERT INTO `citas_regional`.`pagos` 
(`id_cita`, `id_admisionista`, `precio`, `estado`, `tipo_pago`) 
VALUES 
(1, 3, 50.00, 1, 'Efectivo'),
(2, 4, 75.00, 1, 'Tarjeta de crédito'),
(3, 4, 60.00, 0, 'Efectivo'),
(4, 3, 45.00, 1, 'Transferencia bancaria'),
(5, 4, 55.00, 0, 'Tarjeta de débito');

INSERT INTO `citas_regional`.`especialidad` (`nombre`, `descripcion`)
VALUES
    ('Pediatría', 'Especialidad médica de los niños'),
    ('Odontología', 'Especialidad médica de cuidado dental'),
    ('Ginecología', 'Especialidad médica del sistema reproductivo femenino'),
    ('Medicina General', 'Especialidad médica de atención integral'),
    ('Oftalmología', 'Especialidad médica de cuidado ocular');
    
INSERT INTO `citas_regional`.`precios` (`id_precio`, `fecha`, `precio`, `id_administrador`, `id_especialidad`)
VALUES
  (1, '2023-06-01 10:00:00', 50.00, 5, 1),
  (2, '2023-06-02 09:30:00', 75.00, 5, 2),
  (3, '2023-06-03 16:00:00', 60.00, 5, 3),
  (4, '2023-06-04 12:15:00', 45.00, 5, 4),
  (5, '2023-06-05 08:45:00', 65.00, 5, 5);

    
INSERT INTO `citas_regional`.`atencion_cita` 
(`id_atencion`, `id_cita`, `id_admisionista`, `fecha`, `entrada`, `salida`) 
VALUES 
(1, 1, 3, '2023-06-20', '09:15:00', '10:00:00'),
(2, 2, 4, '2023-06-21', '08:30:00', '09:15:00'),
(3, 3, 3, '2023-06-22', '14:00:00', '15:00:00'),
(4, 4, 4, '2023-06-23', '11:30:00', '12:00:00'),
(5, 5, 3, '2023-06-24', '13:45:00', '14:30:00');

   
INSERT INTO `citas_regional`.`historia` (`fecha`, `resultado`, `motivo`, `archivo`, `id_paciente`, `id_medico`) 
VALUES 
('2023-06-01 10:30:00', 'Resultado 1', 'Motivo 1', 'archivo1.pdf', 1, 1),
('2023-06-02 14:45:00', 'Resultado 2', 'Motivo 2', 'archivo2.pdf', 2, 2),
('2023-06-03 09:15:00', 'Resultado 3', 'Motivo 3', 'archivo3.pdf', 3, 2),
('2023-06-04 11:00:00', 'Resultado 4', 'Motivo 4', 'archivo4.pdf', 1, 1),
('2023-06-05 16:30:00', 'Resultado 5', 'Motivo 5', 'archivo5.pdf', 2, 2);


INSERT INTO `citas_regional`.`horario` (`id_usuario`, `fecha`, `hora_inicio`, `hora_fin`,`cupos`) VALUES
(2, '2023-06-17', '09:00:00', '12:00:00', 5),
(2, '2023-06-18', '14:30:00', '17:30:00',4),
(1, '2023-06-19', '10:00:00', '13:00:00',8),
(1, '2023-06-20', '08:00:00', '11:00:00',9),
(1, '2023-06-21', '13:00:00', '16:00:00',7);


INSERT INTO `citas_regional`.`roles` (`nombre`, `descripcion`) VALUES
('Admisionista', 'Encargado de gestionar las citas y la atención al paciente.'),
('Doctor', 'Profesional médico encargado de realizar las consultas y tratamientos.'),
('Administrador', 'Encargado de administrar y gestionar el sistema de citas regional.');


INSERT INTO citas_regional.usuario_roles (roles_id_rol, usuario_id_usuario)
VALUES
(2, 1),
(2, 2),
(1, 3),
(1, 4),
(3, 5);

INSERT INTO citas_regional.usuario_especialidad (usuario_id_usuario, especialidad_id_especialidad) VALUES
(1, 1),
(2, 2),
(1, 3),
(2, 3),
(1, 2);

