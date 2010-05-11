SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;

-- -----------------------------------------------------
-- Table `mydb`.`user_types`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`user_types` (
  `user_type` INT UNSIGNED NOT NULL ,
  `user_type_description` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`user_type`) ,
  UNIQUE INDEX `user_type_UNIQUE` (`user_type` ASC) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`users` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_nickname` VARCHAR(45) NOT NULL ,
  `user_email` VARCHAR(45) NOT NULL ,
  `user_name` VARCHAR(45) NULL DEFAULT NULL ,
  `user_create_date` DATETIME NOT NULL ,
  `user_last_update` DATETIME NOT NULL ,
  `user_reputation` INT NOT NULL DEFAULT 0 ,
  `user_zip_code` VARCHAR(10) NULL DEFAULT NULL ,
  `user_type` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `user_password` CHAR(40) NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) ,
  UNIQUE INDEX `user_email_UNIQUE` (`user_email` ASC) ,
  INDEX `user_type` (`user_type` ASC) ,
  UNIQUE INDEX `user_nickname_UNIQUE` (`user_nickname` ASC) ,
  CONSTRAINT `user_type`
    FOREIGN KEY (`user_type` )
    REFERENCES `mydb`.`user_types` (`user_type` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `mydb`.`health_records`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`health_records` (
  `user_id` INT UNSIGNED NOT NULL ,
  `user_gender` CHAR(1) NULL ,
  `user_birthdate` DATETIME NULL ,
  `user_ethnicity` VARCHAR(45) NULL ,
  `user_height` INT UNSIGNED NULL ,
  `user_weight` INT UNSIGNED NULL ,
  `user_weekly_exercise_hours` INT UNSIGNED NULL ,
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) ,
  INDEX `user_id` (`user_id` ASC) ,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`users` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `mydb`.`grubs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`grubs` (
  `grub_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` INT UNSIGNED NOT NULL ,
  `grub_title` VARCHAR(45) NULL DEFAULT NULL ,
  `grub_description` TEXT NULL DEFAULT NULL ,
  `grub_score` TINYINT UNSIGNED NULL DEFAULT NULL ,
  `grub_post_date` DATETIME NOT NULL ,
  PRIMARY KEY (`grub_id`) ,
  UNIQUE INDEX `grub_id_UNIQUE` (`grub_id` ASC) ,
  INDEX `user_id` (`user_id` ASC) ,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`users` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `mydb`.`comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`comments` (
  `comment_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` INT UNSIGNED NOT NULL ,
  `grub_id` INT UNSIGNED NOT NULL ,
  `comment_body` TEXT NOT NULL ,
  `comment_score` TINYINT UNSIGNED NULL ,
  `comment_post_date` DATETIME NOT NULL ,
  PRIMARY KEY (`comment_id`) ,
  UNIQUE INDEX `comment_id_UNIQUE` (`comment_id` ASC) ,
  INDEX `user_id` (`user_id` ASC) ,
  INDEX `grub_id` (`grub_id` ASC) ,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`users` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `grub_id`
    FOREIGN KEY (`grub_id` )
    REFERENCES `mydb`.`grubs` (`grub_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `mydb`.`grub_photos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`grub_photos` (
  `grub_photo_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `grub_photo_url` VARCHAR(100) NOT NULL ,
  `grub_id` INT UNSIGNED NOT NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  `post_date` DATETIME NOT NULL ,
  `grub_photo_caption` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`grub_photo_id`) ,
  UNIQUE INDEX `grub_photo_id_UNIQUE` (`grub_photo_id` ASC) ,
  INDEX `grub_id` (`grub_id` ASC) ,
  INDEX `user_id` (`user_id` ASC) ,
  CONSTRAINT `grub_id`
    FOREIGN KEY (`grub_id` )
    REFERENCES `mydb`.`grubs` (`grub_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`users` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`user_types`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
insert into `mydb`.`user_types` (`user_type`, `user_type_description`) values (0, 'User');
insert into `mydb`.`user_types` (`user_type`, `user_type_description`) values (1, 'Admin');

COMMIT;
