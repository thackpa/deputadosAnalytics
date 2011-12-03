SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `congresso` DEFAULT CHARACTER SET latin1 COLLATE latin1_bin ;

-- -----------------------------------------------------
-- Table `congresso`.`deputado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `congresso`.`deputado` (
  `idDeputado` VARCHAR(200) NOT NULL ,
  `matricula` VARCHAR(255) NULL ,
  `name` VARCHAR(255) NULL ,
  `partido` VARCHAR(45) NULL ,
  `estado` VARCHAR(45) NULL ,
  `pk` VARCHAR(200) NULL ,
  PRIMARY KEY (`idDeputado`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `congresso`.`frequenciaDia`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `congresso`.`frequenciaDia` (
  `idFrequenciaDia` INT NOT NULL AUTO_INCREMENT ,
  `idDeputado` VARCHAR(200) NOT NULL ,
  `data` DATE NOT NULL ,
  `presenca` VARCHAR(45) NULL ,
  `tipo` VARCHAR(45) NULL ,
  `justificativa` VARCHAR(255) NULL ,
  PRIMARY KEY (`idFrequenciaDia`) ,
  INDEX `fk_frequenciaDia_deputado1` (`idDeputado` ASC) ,
  CONSTRAINT `fk_frequenciaDia_deputado1`
    FOREIGN KEY (`idDeputado` )
    REFERENCES `congresso`.`deputado` (`idDeputado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `congresso`.`frequenciaVotacao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `congresso`.`frequenciaVotacao` (
  `idFrequenciaVotacao` INT NOT NULL AUTO_INCREMENT ,
  `idDeputado` VARCHAR(200) NOT NULL ,
  `data` DATE NOT NULL ,
  `presenca` VARCHAR(255) NOT NULL ,
  `tipo` VARCHAR(45) NULL ,
  PRIMARY KEY (`idFrequenciaVotacao`) ,
  INDEX `fk_frequenciaVotacao_deputado1` (`idDeputado` ASC) ,
  CONSTRAINT `fk_frequenciaVotacao_deputado1`
    FOREIGN KEY (`idDeputado` )
    REFERENCES `congresso`.`deputado` (`idDeputado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `congresso`.`comissao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `congresso`.`comissao` (
  `idComissao` INT NOT NULL AUTO_INCREMENT ,
  `descricao` VARCHAR(255) NULL ,
  PRIMARY KEY (`idComissao`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `congresso`.`tipoReuniao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `congresso`.`tipoReuniao` (
  `idTipoReuniao` INT NOT NULL AUTO_INCREMENT ,
  `descricao` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`idTipoReuniao`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `congresso`.`reuniao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `congresso`.`reuniao` (
  `idReuniao` INT NOT NULL AUTO_INCREMENT ,
  `idDeputado` VARCHAR(200) NOT NULL ,
  `idComissao` INT NOT NULL ,
  `idTipoReuniao` INT NOT NULL ,
  `data` DATE NOT NULL ,
  `presenca` VARCHAR(45) NOT NULL ,
  `posto` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`idReuniao`) ,
  INDEX `fk_reuniao_comissao1` (`idComissao` ASC) ,
  INDEX `fk_reuniao_tipoReuniao1` (`idTipoReuniao` ASC) ,
  INDEX `fk_reuniao_deputado1` (`idDeputado` ASC) ,
  CONSTRAINT `fk_reuniao_comissao1`
    FOREIGN KEY (`idComissao` )
    REFERENCES `congresso`.`comissao` (`idComissao` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reuniao_tipoReuniao1`
    FOREIGN KEY (`idTipoReuniao` )
    REFERENCES `congresso`.`tipoReuniao` (`idTipoReuniao` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reuniao_deputado1`
    FOREIGN KEY (`idDeputado` )
    REFERENCES `congresso`.`deputado` (`idDeputado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `congresso`.`votacao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `congresso`.`votacao` (
  `idVotacao` INT NOT NULL AUTO_INCREMENT ,
  `idDeputado` VARCHAR(200) NOT NULL ,
  `data` DATE NULL ,
  `sessao` VARCHAR(45) NULL ,
  `projeto` VARCHAR(255) NULL ,
  `voto` VARCHAR(45) NULL ,
  PRIMARY KEY (`idVotacao`) ,
  INDEX `fk_votacao_deputado1` (`idDeputado` ASC) ,
  CONSTRAINT `fk_votacao_deputado1`
    FOREIGN KEY (`idDeputado` )
    REFERENCES `congresso`.`deputado` (`idDeputado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `congresso`.`discurso`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `congresso`.`discurso` (
  `idDiscurso` INT NOT NULL AUTO_INCREMENT ,
  `idDeputado` VARCHAR(200) NOT NULL ,
  `data` DATE NULL ,
  `sessao` VARCHAR(45) NULL ,
  `fase` VARCHAR(255) NULL ,
  `hora` TIME NULL ,
  `sumario` TEXT NULL ,
  PRIMARY KEY (`idDiscurso`) ,
  INDEX `fk_discurso_deputado1` (`idDeputado` ASC) ,
  CONSTRAINT `fk_discurso_deputado1`
    FOREIGN KEY (`idDeputado` )
    REFERENCES `congresso`.`deputado` (`idDeputado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `congresso`.`proposicao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `congresso`.`proposicao` (
  `idProposicao` INT NOT NULL AUTO_INCREMENT ,
  `idDeputado` VARCHAR(200) NOT NULL ,
  `numero` VARCHAR(45) NULL ,
  `orgao` VARCHAR(45) NULL ,
  `situacao` VARCHAR(255) NULL ,
  `data` DATE NULL ,
  `ementa` TEXT NULL ,
  `despacho` TEXT NULL ,
  PRIMARY KEY (`idProposicao`) ,
  INDEX `fk_proposicao_deputado1` (`idDeputado` ASC) ,
  CONSTRAINT `fk_proposicao_deputado1`
    FOREIGN KEY (`idDeputado` )
    REFERENCES `congresso`.`deputado` (`idDeputado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `congresso`.`relatoria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `congresso`.`relatoria` (
  `idRelatoria` INT NOT NULL AUTO_INCREMENT ,
  `idDeputado` VARCHAR(200) NOT NULL ,
  `numero` VARCHAR(255) NULL ,
  `orgao` VARCHAR(255) NULL ,
  `situacao` VARCHAR(255) NULL ,
  `autor` VARCHAR(255) NULL ,
  `ementa` TEXT NULL ,
  `despacho` TEXT NULL ,
  PRIMARY KEY (`idRelatoria`) ,
  INDEX `fk_relatoria_deputado1` (`idDeputado` ASC) ,
  CONSTRAINT `fk_relatoria_deputado1`
    FOREIGN KEY (`idDeputado` )
    REFERENCES `congresso`.`deputado` (`idDeputado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
