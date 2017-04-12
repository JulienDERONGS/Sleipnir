#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

CREATE database IF NOT EXISTS `sleipnir_equipments`;
USE `sleipnir_equipments`;

#------------------------------------------------------------
# Table: Equipment
#------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `Equipment`(
        equip_id     int (11) Auto_increment NOT NULL,
        equip_name   Varchar (255) NOT NULL,
        FK_equipType_id Int NOT NULL,
        PRIMARY KEY (equip_id)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: EquipmentType
#------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `EquipmentType`(
        equipType_id   int (11) Auto_increment NOT NULL,
        equipType_name Varchar (255) NOT NULL,
        PRIMARY KEY (equipType_id)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Foreign Key attribute adding
#------------------------------------------------------------

ALTER TABLE Equipment ADD CONSTRAINT FK_Equipment_equipType_id FOREIGN KEY (FK_equipType_id) REFERENCES EquipmentType(equipType_id);

#------------------------------------------------------------
# Initial CSV data import
#------------------------------------------------------------

LOAD DATA LOCAL INFILE '/var/www/html/include/database/resources/csv/EquipmentType.csv'
INTO TABLE EquipmentType
CHARACTER SET utf8
FIELDS TERMINATED BY ';'
IGNORE 1 LINES
(EquipType.equipType_name);

LOAD DATA LOCAL INFILE '/var/www/html/include/database/resources/csv/Equipment.csv'
INTO TABLE Equipment
CHARACTER SET utf8
FIELDS TERMINATED BY ';'
IGNORE 1 LINES
(Equip.equip_name);