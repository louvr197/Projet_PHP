CREATE TABLE
    `bdd_projet_web`.`t_utilisateur_uti` (
        `uti_id` INT NOT NULL AUTO_INCREMENT,
        `uti_pseudo` VARCHAR(255) NOT NULL,
        `uti_email` VARCHAR(255) NOT NULL,
        `uti_motdepasse` BINARY(255) NOT NULL,
        PRIMARY KEY (`uti_id`),
        UNIQUE `unique_pseudo` (`uti_pseudo`),
        UNIQUE `unique_mail` (`uti_email`)
    ) ENGINE = InnoDB;