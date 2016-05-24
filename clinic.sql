DROP DATABASE IF EXISTS Clinic;

CREATE DATABASE IF NOT EXISTS Clinic;
USE Clinic;

CREATE TABLE Doctor (
  doctorId INT          NOT NULL AUTO_INCREMENT,
  name     VARCHAR(255) NOT NULL,
  mobile   INT(11)      NOT NULL,
  address  VARCHAR(255) NOT NULL,
  userName VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (doctorId),
  UNIQUE (mobile),
  UNIQUE (userName)
);


CREATE TABLE secretary (
  secretaryId INT          NOT NULL AUTO_INCREMENT,
  name        VARCHAR(255) NOT NULL,
  userName    VARCHAR(255) NOT NULL,
  mobile      INT(11)      NOT NULL,
  password    VARCHAR(255) NOT NULL,
  PRIMARY KEY (secretaryId),
  UNIQUE (userName)
);


CREATE TABLE patient (
  patientId INT          NOT NULL AUTO_INCREMENT,
  userName  VARCHAR(255) NOT NULL,
  password  VARCHAR(255) NOT NULL,
  mobile    INT(11)      NOT NULL,
  name      VARCHAR(255) NOT NULL,
  age       INT(2)       NOT NULL,
  PRIMARY KEY (patientId),
  UNIQUE (userName),
  UNIQUE (mobile)
);

CREATE TABLE dependent (
  dependentId INT          NOT NULL AUTO_INCREMENT,
  patientId   INT          NOT NULL,
  mobile      INT(11)      NOT NULL,
  name        VARCHAR(255) NOT NULL,
  userName    VARCHAR(255) NOT NULL,
  password    VARCHAR(255) NOT NULL,
  PRIMARY KEY (dependentId),
  FOREIGN KEY (patientId) REFERENCES patient (patientId),
  UNIQUE (mobile),
  UNIQUE (userName)
);

CREATE TABLE status (
  statusId  INT(11) NOT NULL AUTO_INCREMENT,
  patientId INT(11) NOT NULL,
  status    INT(2)  NOT NULL,
  date      DATE    NOT NULL,
  time      TIME    NOT NULL,
  PRIMARY KEY (statusId),
  FOREIGN KEY (patientId) REFERENCES patient (patientId)
);

CREATE TABLE reservation (
  reservationId   INT(11)       NOT NULL AUTO_INCREMENT,
  patientId       INT           NOT NULL,
  reservationDate DATE          NOT NULL,
  reservationTime INT(11)       NOT NULL,
  prescription    VARCHAR(1000) NULL,
  dependentId     INT(11)       NULL,
  PRIMARY KEY (reservationId),
  FOREIGN KEY (patientId) REFERENCES patient (patientId)
  ,
  FOREIGN KEY (dependentId) REFERENCES dependent (dependentId)
);

INSERT INTO `clinic`.`patient` (`patientId`, `userName`, `password`, `mobile`, `name`, `age`)
VALUES (NULL, 'p', 'p', '0', 'p', '0');

INSERT INTO `clinic`.`dependent` (`dependentId`, `patientId`, `mobile`, `name`, `userName`, `password`)
VALUES (NULL, '1', '0', 'd', 'd', 'd');

INSERT INTO `clinic`.`reservation` (`reservationId`, `patientId`, `reservationDate`, `reservationTime`, `prescription`, `dependentId`)
VALUES (NULL, '1', '2016-04-24', 7, NULL, '1');
INSERT INTO `clinic`.`doctor` (`doctorId`, `name`, `mobile`, `address`, `userName`, `password`)
VALUES (NULL, 'd', '0', 'd', 'd', 'd');