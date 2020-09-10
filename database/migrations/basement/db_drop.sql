# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases V8.1.2                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          boxxle_erd.dez                                  #
# Project name:          Boxxle                                          #
# Author:                                                                #
# Script type:           Database drop script                            #
# Created on:            2020-02-13 16:41                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Drop foreign key constraints                                           #
# ---------------------------------------------------------------------- #

ALTER TABLE `users` DROP FOREIGN KEY `users_roles`;

ALTER TABLE `preferences` DROP FOREIGN KEY `preferences_users`;

# ---------------------------------------------------------------------- #
# Drop table "preferences"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `preferences` MODIFY `id` INTEGER UNSIGNED NOT NULL;

# Drop constraints #

ALTER TABLE `preferences` DROP PRIMARY KEY;

DROP TABLE `preferences`;

# ---------------------------------------------------------------------- #
# Drop table "users"                                                     #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `users` MODIFY `id` INTEGER UNSIGNED NOT NULL;

# Drop constraints #

ALTER TABLE `users` ALTER COLUMN `created_at` DROP DEFAULT;

ALTER TABLE `users` DROP PRIMARY KEY;

DROP TABLE `users`;

# ---------------------------------------------------------------------- #
# Drop table "roles"                                                     #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `roles` MODIFY `id` TINYINT UNSIGNED NOT NULL;

# Drop constraints #

ALTER TABLE `roles` DROP PRIMARY KEY;

DROP TABLE `roles`;

# ---------------------------------------------------------------------- #
# Drop table "medias"                                                    #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `medias` MODIFY `id` INTEGER UNSIGNED NOT NULL;

# Drop constraints #

ALTER TABLE `medias` DROP PRIMARY KEY;

DROP TABLE `medias`;
