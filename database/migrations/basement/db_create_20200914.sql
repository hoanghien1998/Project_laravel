# MySQL Workbench Forward Engineering

SET UNIQUE_CHECKS=0;

SET FOREIGN_KEY_CHECKS=0;

# -----------------------------------------------------
# Table `car_makes`
# -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `car_makes` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


# -----------------------------------------------------
# Table `car_models`
# -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `car_models` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `make_id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(255) NULL,
  `year_start` INT(10) UNSIGNED NOT NULL,
  `year_end` INT(10) UNSIGNED NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_CarModels_1`
    FOREIGN KEY (`make_id`)
    REFERENCES `car_makes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_CarModels_1_idx` ON `car_models` (`make_id` ASC)


# -----------------------------------------------------
# Table `car_trims`
# -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `car_trims` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_CarTrims_1`
    FOREIGN KEY (`model_id`)
    REFERENCES `car_models` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_CarTrims_1_idx` ON `car_trims` (`model_id` ASC)


# -----------------------------------------------------
# Table `listings`
# -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `listings` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `car_model_id` INT(10) UNSIGNED NOT NULL,
  `car_trim_id` INT(10) UNSIGNED NOT NULL,
  `year` INT(4) NOT NULL,
  `price` INT(10) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Listings_1`
    FOREIGN KEY (`car_model_id`)
    REFERENCES `car_models` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Listings_2`
    FOREIGN KEY (`car_trim_id`)
    REFERENCES `car_trims` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Listings_1_idx` ON `listings` (`car_model_id` ASC);

CREATE INDEX `fk_Listings_2_idx` ON `listings` (`car_trim_id` ASC);


# -----------------------------------------------------
# Table `documents`
# -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `documents` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `listing_id` INT(10) UNSIGNED NULL,
  `group` ENUM("image", "document") NOT NULL DEFAULT 'image',
  `sequence` INT(4) UNSIGNED NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Documents_1`
    FOREIGN KEY (`listing_id`)
    REFERENCES `listings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Documents_1_idx` ON `documents` (`listing_id` ASC);


# -----------------------------------------------------
# Table `comments`
# -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `comments` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `object_name` ENUM('listing', 'comment') NULL,
  `object_id` INT(10) UNSIGNED NULL,
  `message` VARCHAR(500) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

SET UNIQUE_CHECKS=1;

SET FOREIGN_KEY_CHECKS=1;
