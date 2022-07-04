SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema exads_test
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `exads_test` ;

-- -----------------------------------------------------
-- Schema exads_test
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `exads_test` DEFAULT CHARACTER SET utf8 ;
USE `exads_test` ;

-- -----------------------------------------------------
-- Table `exads_test`.`tv_series`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `exads_test`.`tv_series` ;

CREATE TABLE IF NOT EXISTS `exads_test`.`tv_series` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `channel` VARCHAR(255) NOT NULL,
  `gender` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT INDEX `TITLE_INDEX` (`title`) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `exads_test`.`tv_series_intervals`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `exads_test`.`tv_series_intervals` ;

CREATE TABLE IF NOT EXISTS `exads_test`.`tv_series_intervals` (
  `id_tv_series` INT UNSIGNED NOT NULL,
  `week_day` INT NOT NULL,
  `show_time` TIME NOT NULL,
  INDEX `fk_tv_series_intervals_tv_series_idx` (`id_tv_series` ASC) VISIBLE,
  CONSTRAINT `fk_tv_series_intervals_tv_series`
    FOREIGN KEY (`id_tv_series`)
    REFERENCES `exads_test`.`tv_series` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `exads_test`.`tv_series`
-- -----------------------------------------------------
START TRANSACTION;
USE `exads_test`;
INSERT INTO `exads_test`.`tv_series` (`id`, `title`, `channel`, `gender`) VALUES (1, 'Black Mirror', 'Netflix', 'Sci-fi');
INSERT INTO `exads_test`.`tv_series` (`id`, `title`, `channel`, `gender`) VALUES (2, 'Mr. Robot', 'USA Network', 'Drama');
INSERT INTO `exads_test`.`tv_series` (`id`, `title`, `channel`, `gender`) VALUES (3, 'The Bing Bang Theory', 'CBS', 'Sitcom');
INSERT INTO `exads_test`.`tv_series` (`id`, `title`, `channel`, `gender`) VALUES (4, 'Rick and Morty', 'Cartoon Network', 'Dark Comedy');
INSERT INTO `exads_test`.`tv_series` (`id`, `title`, `channel`, `gender`) VALUES (5, 'Breaking Bad', 'AMC', 'Drama');

COMMIT;


-- -----------------------------------------------------
-- Data for table `exads_test`.`tv_series_intervals`
-- -----------------------------------------------------
START TRANSACTION;
USE `exads_test`;
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (1, 1, '19:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (1, 3, '22:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (1, 5, '18:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (2, 6, '21:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (2, 0, '21:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (2, 1, '15:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (2, 2, '09:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (3, 3, '19:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (3, 5, '20:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (3, 6, '16:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (3, 0, '16:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (4, 1, '11:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (4, 4, '03:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (4, 6, '05:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (5, 2, '06:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (5, 4, '11:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (5, 3, '12:00');
INSERT INTO `exads_test`.`tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES (5, 0, '12:00');

COMMIT;

