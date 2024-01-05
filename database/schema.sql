-- -----------------------------------------------------
-- Schema garage-automobile
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `garage-automobile` DEFAULT CHARACTER SET utf8;
USE `garage-automobile`;

-- -----------------------------------------------------
-- Table `garage-automobile`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garage-automobile`.`user` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(60) NOT NULL,
    `lastname` VARCHAR(60) NOT NULL,
    `email` VARCHAR(60) NOT NULL,
    `password` VARCHAR(16) NOT NULL,
    `role` VARCHAR(16) NOT NULL,
    `active` TINYINT NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garage-automobile`.`service`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garage-automobile`.`service` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `active` TINYINT NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garage-automobile`.`opening_hours`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garage-automobile`.`opening_hours` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `day` VARCHAR(5) NOT NULL,
    `morning_start_hour` VARCHAR(5) NULL,
    `morning_end_hour` VARCHAR(5) NULL,
    `afternoon_start_hour` VARCHAR(5) NULL,
    `afternoon_end_hour` VARCHAR(5) NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garage-automobile`.`color`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garage-automobile`.`color` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `hexa_code` VARCHAR(16) NOT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garage-automobile`.`brand`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garage-automobile`.`brand` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garage-automobile`.`model`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garage-automobile`.`model` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `brand_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_model_brand1_idx` (`brand_id` ASC) VISIBLE,
    CONSTRAINT `fk_model_brand1`
    FOREIGN KEY (`brand_id`)
    REFERENCES `garage-automobile`.`brand` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garage-automobile`.`energy`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garage-automobile`.`energy` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garage-automobile`.`gearbox`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garage-automobile`.`gearbox` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garage-automobile`.`vehicle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garage-automobile`.`vehicle` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `price` DECIMAL(10,2) NOT NULL,
    `circulation_year` DATE NOT NULL,
    `mileage` INT NOT NULL,
    `fiscal_power` INT NOT NULL,
    `manufacturing_year` INT NOT NULL,
    `active` TINYINT NOT NULL DEFAULT 1,
    `color_id` INT NOT NULL,
    `model_id` INT NOT NULL,
    `energy_id` INT NOT NULL,
    `gearbox_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_vehicle_color_idx` (`color_id` ASC) VISIBLE,
    INDEX `fk_vehicle_model1_idx` (`model_id` ASC) VISIBLE,
    INDEX `fk_vehicle_energy1_idx` (`energy_id` ASC) VISIBLE,
    INDEX `fk_vehicle_gearbox1_idx` (`gearbox_id` ASC) VISIBLE,
    CONSTRAINT `fk_vehicle_color`
    FOREIGN KEY (`color_id`)
    REFERENCES `garage-automobile`.`color` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_vehicle_model1`
    FOREIGN KEY (`model_id`)
    REFERENCES `garage-automobile`.`model` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_vehicle_energy1`
    FOREIGN KEY (`energy_id`)
    REFERENCES `garage-automobile`.`energy` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_vehicle_gearbox1`
    FOREIGN KEY (`gearbox_id`)
    REFERENCES `garage-automobile`.`gearbox` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garage-automobile`.`picture`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garage-automobile`.`picture` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `url` VARCHAR(200) NOT NULL,
    `is_principal` TINYINT NOT NULL DEFAULT 1,
    `vehicle_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_picture_vehicle1_idx` (`vehicle_id` ASC) VISIBLE,
    CONSTRAINT `fk_picture_vehicle1`
    FOREIGN KEY (`vehicle_id`)
    REFERENCES `garage-automobile`.`vehicle` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garage-automobile`.`option_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garage-automobile`.`option_type` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garage-automobile`.`options`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garage-automobile`.`options` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(60) NOT NULL,
    `option_type_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_options_option_type1_idx` (`option_type_id` ASC) VISIBLE,
    CONSTRAINT `fk_options_option_type1`
    FOREIGN KEY (`option_type_id`)
    REFERENCES `garage-automobile`.`option_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `garage-automobile`.`vehicle_options`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `garage-automobile`.`vehicle_options` (
    `vehicle_id` INT NOT NULL,
    `options_id` INT NOT NULL,
    PRIMARY KEY (`vehicle_id`, `options_id`),
    INDEX `fk_vehicle_has_options_options1_idx` (`options_id` ASC) VISIBLE,
    INDEX `fk_vehicle_has_options_vehicle1_idx` (`vehicle_id` ASC) VISIBLE,
    CONSTRAINT `fk_vehicle_has_options_vehicle1`
    FOREIGN KEY (`vehicle_id`)
    REFERENCES `garage-automobile`.`vehicle` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_vehicle_has_options_options1`
    FOREIGN KEY (`options_id`)
    REFERENCES `garage-automobile`.`options` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
