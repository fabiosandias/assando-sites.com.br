SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `payment_methods`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `payment_methods` ;

CREATE  TABLE IF NOT EXISTS `payment_methods` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `payment_gateways`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `payment_gateways` ;

CREATE  TABLE IF NOT EXISTS `payment_gateways` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `payments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `payments` ;

CREATE  TABLE IF NOT EXISTS `payments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `student_id` INT UNSIGNED NOT NULL ,
  `code` VARCHAR(40) BINARY NOT NULL ,
  `reference` VARCHAR(40) NOT NULL ,
  `value` DECIMAL(6,2) NOT NULL ,
  `datetime` DATETIME NOT NULL ,
  `payment_gateway_id` INT UNSIGNED NOT NULL ,
  `payment_method_id` INT UNSIGNED NOT NULL ,
  `status_id` INT UNSIGNED NOT NULL ,
  `created` DATETIME NOT NULL ,
  `updated` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_PAYMENTS_STATUSES1` (`status_id` ASC) ,
  INDEX `FK_PAYMENTS_STUDENTS1` (`student_id` ASC) ,
  UNIQUE INDEX `UNIQUE_CODE` (`code` ASC) ,
  INDEX `FK_PAYMENTS_PAYMENT_METHODS1` (`payment_method_id` ASC) ,
  INDEX `FK_PAYMENTS_PAYMENT_GATEWAYS1` (`payment_gateway_id` ASC) ,
  CONSTRAINT `FK_PAYMENTS_STATUSES1`
    FOREIGN KEY (`status_id` )
    REFERENCES `status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_PAYMENTS_STUDENTS1`
    FOREIGN KEY (`student_id` )
    REFERENCES `students` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_PAYMENTS_PAYMENT_METHODS1`
    FOREIGN KEY (`payment_method_id` )
    REFERENCES `payment_methods` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_PAYMENTS_PAYMENT_GATEWAYS1`
    FOREIGN KEY (`payment_gateway_id` )
    REFERENCES `payment_gateways` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `payment_methods`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `payment_methods` (`id`, `name`) VALUES (NULL, 'Cartão de crédito');
INSERT INTO `payment_methods` (`id`, `name`) VALUES (NULL, 'Boleto');
INSERT INTO `payment_methods` (`id`, `name`) VALUES (NULL, 'Débito online (TEF)');
INSERT INTO `payment_methods` (`id`, `name`) VALUES (NULL, 'Saldo PagSeguro');
INSERT INTO `payment_methods` (`id`, `name`) VALUES (NULL, 'Oi Paggo');

COMMIT;

-- -----------------------------------------------------
-- Data for table `payment_gateways`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `payment_gateways` (`id`, `name`) VALUES (NULL, 'PagSeguro');
INSERT INTO `payment_gateways` (`id`, `name`) VALUES (NULL, 'PayPal');

COMMIT;
