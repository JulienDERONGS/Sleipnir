#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `User`(
        user_email    Varchar (100) NOT NULL,
        user_password Varchar (128) NOT NULL,
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

LOAD DATA LOCAL INFILE '' INTO TABLE ``