ALTER TABLE `users` ADD COLUMN `name` VARCHAR(75) NULL DEFAULT NULL  AFTER `id` ;

UPDATE `roles` SET `description` = 'Login privileges, grant user to login to the system' WHERE `id` = 1;

ALTER TABLE `roles` ADD COLUMN `removable` SMALLINT NOT NULL DEFAULT 1;

UPDATE `roles` SET `removable` = 0 WHERE `id` IN (1,2);