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

drop database `citas_regional`;

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



CREATE TABLE IF NOT EXISTS`citas_regional`.`perfiles` (
  `id_perfil` INT(11) NOT NULL AUTO_INCREMENT,
  `imagen` VARCHAR(50) NULL DEFAULT NULL,
  `perfil` VARCHAR(30) NOT NULL,
  `estado` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_perfil`))
ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `citas_regional`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`usuario` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `id_persona` INT(11) NOT NULL,
  `id_perfil` INT(11) NOT NULL,
  `estado` TINYINT(4) NULL DEFAULT NULL,
  `clave` VARCHAR(100) NULL DEFAULT NULL,
  `usuario` VARCHAR(45) NULL,
  `creado` DATETIME NULL DEFAULT NULL,
  `actualizado` DATETIME NULL DEFAULT NULL,
  `eliminado` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_medico_persona1_idx` (`id_persona` ASC) VISIBLE,
  INDEX `fk_usuario_perfiles1_idx` (`id_perfil` ASC) VISIBLE,
  CONSTRAINT `fk_medico_persona1`
    FOREIGN KEY (`id_persona`)
    REFERENCES `citas_regional`.`persona` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_perfiles1`
    FOREIGN KEY (`id_perfil`)
    REFERENCES`citas_regional`.`perfiles` (`id_perfil`)
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
  `fecha_cita` DATETIME NULL DEFAULT NULL,
  `especialidad` VARCHAR(45) NULL DEFAULT NULL,
  `precio` FLOAT NULL DEFAULT NULL,
  `numero_persona_responsable` VARCHAR(45) NULL DEFAULT NULL,
  `estado_pago` TINYINT(4) NULL DEFAULT NULL,
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
-- Table `citas_regional`.`atencion_cita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`atencion_cita` (
  `id_atencion` INT(11) NOT NULL AUTO_INCREMENT,
  `id_cita` INT(11) NOT NULL,
  `id_admisionista` INT(11) NOT NULL,
  `fecha` DATE NULL DEFAULT NULL,
  `entrada` TIME NULL DEFAULT NULL,
  `salida` TIME NULL DEFAULT NULL,
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
ENGINE = InnoDB

DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `citas_regional`.`especialidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`especialidad` (
  `id_especialidad` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `descripcion` VARCHAR(100) NULL DEFAULT NULL,
  `estado` TINYINT(4) NULL DEFAULT NULL,
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
  `cupos` INT(11) NULL DEFAULT NULL,
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
-- Table `citas_regional`.`pagos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`pagos` (
  `id_pagos` INT(11) NOT NULL AUTO_INCREMENT,
  `id_cita` INT(11) NOT NULL,
  `id_admisionista` INT(11) NOT NULL,
  `precio` FLOAT NULL DEFAULT NULL,
  `estado` TINYINT(4) NULL DEFAULT NULL COMMENT '0: NO CANCELADO 1: CANCELADO',
  `tipo_pago` VARCHAR(45) NULL DEFAULT NULL,
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
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `citas_regional`.`precios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`precios` (
  `id_precio` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NULL DEFAULT NULL,
  `precio` FLOAT NULL DEFAULT NULL,
  `id_administrador` INT(11) NOT NULL,
  `id_especialidad` INT(11) NOT NULL,
  PRIMARY KEY (`id_precio`),
  INDEX `fk_precios_usuario1_idx` (`id_administrador` ASC) VISIBLE,
  INDEX `fk_precios_especialidad1_idx` (`id_especialidad` ASC) VISIBLE,
  CONSTRAINT `fk_precios_especialidad1`
    FOREIGN KEY (`id_especialidad`)
    REFERENCES `citas_regional`.`especialidad` (`id_especialidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_precios_usuario1`
    FOREIGN KEY (`id_administrador`)
    REFERENCES `citas_regional`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `citas_regional`.`reprogramaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas_regional`.`reprogramaciones` (
  `id_reprogramacin` INT(11) NOT NULL AUTO_INCREMENT,
  `id_cita` INT(11) NOT NULL,
  `fecha_anterior` DATETIME NULL DEFAULT NULL,
  `fecha_nueva` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id_reprogramacin`),
  INDEX `fk_reprogramaciones_cita1_idx` (`id_cita` ASC) VISIBLE,
  CONSTRAINT `fk_reprogramaciones_cita1`
    FOREIGN KEY (`id_cita`)
    REFERENCES `citas_regional`.`cita` (`id_cita`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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
-- Table`citas_regional`.`modulos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS`citas_regional`.`modulos` (
  `id_modulo` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(50) NOT NULL,
  `url` VARCHAR(30) NULL DEFAULT NULL,
  `icon` VARCHAR(50) NULL DEFAULT NULL,
  `submodulo` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_modulo`),
  INDEX `submodulo` (`submodulo` ASC) VISIBLE,
  CONSTRAINT `fk_modulos_submodulo`
    FOREIGN KEY (`submodulo`)
    REFERENCES`citas_regional`.`modulos` (`id_modulo`))
ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8mb3;

            
                alter table especialidad add token varchar(100);
                
               alter table horario add token varchar(100);
               
-- -----------------------------------------------------
-- Table`citas_regional`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS`citas_regional`.`roles` (
  `id_rol` INT(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` INT(11) NOT NULL,
  `id_perfil` INT(11) NOT NULL,
  `c` INT(1) NOT NULL DEFAULT 0,
  `r` INT(1) NOT NULL DEFAULT 0,
  `u` INT(1) NOT NULL DEFAULT 0,
  `d` INT(1) NOT NULL DEFAULT 0,
  `p` INT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_rol`),
  INDEX `fk_roles_modulos` (`id_modulo` ASC) VISIBLE,
  INDEX `fk_roles_perfil` (`id_perfil` ASC) VISIBLE,
  CONSTRAINT `fk_roles_modulos`
    FOREIGN KEY (`id_modulo`)
    REFERENCES`citas_regional`.`modulos` (`id_modulo`),
  CONSTRAINT `fk_roles_perfil`
    FOREIGN KEY (`id_perfil`)
    REFERENCES`citas_regional`.`perfiles` (`id_perfil`))
ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8mb3;

alter table especialidad add imagen varchar(50);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;




--datos


