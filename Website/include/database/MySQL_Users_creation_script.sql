#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

CREATE database IF NOT EXISTS `sleipnir_users`;
USE `sleipnir_users`;

#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `User`(
        user_email    Varchar (100) NOT NULL,
        user_password Varchar (64) NOT NULL,
        FK_userLevel_id  Int NOT NULL,
        PRIMARY KEY (user_email)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: UserLevel
#------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `UserLevel`(
        userLevel_id   int (11) Auto_increment NOT NULL,
        userLevel_name Varchar (128) NOT NULL,
        PRIMARY KEY (userLevel_id)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Foreign Key attribute adding
#------------------------------------------------------------

ALTER TABLE User ADD CONSTRAINT FK_User_userLevel_id FOREIGN KEY (FK_userLevel_id) REFERENCES UserLevel(userLevel_id);

#------------------------------------------------------------
# Initial CSV data import
#------------------------------------------------------------

LOAD DATA LOCAL INFILE '/var/www/html/include/database/resources/csv/UserLevel.csv'
INTO TABLE UserLevel
CHARACTER SET utf8
FIELDS TERMINATED BY ','
IGNORE 1 LINES
(UserLevel.userLevel_id, UserLevel.userLevel_name);

LOAD DATA LOCAL INFILE '/var/www/html/include/database/resources/csv/User.csv'
INTO TABLE User
CHARACTER SET utf8
FIELDS TERMINATED BY ','
IGNORE 1 LINES
(User.user_email, User.user_password, User.FK_userLevel_id);