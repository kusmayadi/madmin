ALTER TABLE `users` ADD COLUMN `name` VARCHAR(75) NULL DEFAULT NULL  AFTER `id` ;

UPDATE `roles` SET `description` = 'Login privileges, grant user to login to the system' WHERE `id` = 1;