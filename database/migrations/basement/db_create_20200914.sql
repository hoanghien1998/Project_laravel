# MySQL Workbench Forward Engineering

SET UNIQUE_CHECKS=0;

SET FOREIGN_KEY_CHECKS=0;

# -----------------------------------------------------
# Table `car_makes`
# -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `car_makes` (
  `id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


# -----------------------------------------------------
# Table `car_models`
# -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `car_models` (
  `id` INT(10) UNSIGNED NOT NULL,
  `makeId` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(255) NULL,
  `yearStart` INT(10) UNSIGNED NOT NULL,
  `yearEnd` INT(10) UNSIGNED NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_CarModels_1`
    FOREIGN KEY (`makeId`)
    REFERENCES `car_makes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_CarModels_1_idx` ON `car_models` (`makeId` ASC);


# -----------------------------------------------------
# Table `car_trims`
# -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `car_trims` (
  `id` INT(10) UNSIGNED NOT NULL,
  `modelId` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_CarTrims_1`
    FOREIGN KEY (`modelId`)
    REFERENCES `car_models` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_CarTrims_1_idx` ON `car_trims` (`modelId` ASC);


# -----------------------------------------------------
# Table `listings`
# -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `listings` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `carModelId` INT(10) UNSIGNED NOT NULL,
  `carTrimId` INT(10) UNSIGNED NOT NULL,
  `year` INT(4) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deletedAt` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Listings_1`
    FOREIGN KEY (`carModelId`)
    REFERENCES `car_models` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Listings_2`
    FOREIGN KEY (`carTrimId`)
    REFERENCES `car_trims` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Listings_1_idx` ON `listings` (`carModelId` ASC);

CREATE INDEX `fk_Listings_2_idx` ON `listings` (`carTrimId` ASC);


# -----------------------------------------------------
# Table `documents`
# -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `documents` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `listingId` INT(10) UNSIGNED NULL,
  `group` ENUM("image", "document") NOT NULL DEFAULT 'image',
  `sequence` INT(4) UNSIGNED NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Documents_1`
    FOREIGN KEY (`listingId`)
    REFERENCES `listings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Documents_1_idx` ON `documents` (`listingId` ASC);


# -----------------------------------------------------
# Table `comments`
# -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `comments` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `objectName` ENUM('listing', 'comment') NULL,
  `objectId` INT(10) UNSIGNED NULL,
  `message` VARCHAR(500) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET UNIQUE_CHECKS=1;

SET FOREIGN_KEY_CHECKS=1;
