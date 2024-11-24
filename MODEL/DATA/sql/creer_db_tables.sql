# 
# Description : Script SQL pour créer et initialiser les tables de test
#               pour la base de données "streamify"
#               utilisée dans les  démos du cours 420-G16-R0
# Date        : 2024/03/11
# Auteur      : Émile Girard et Émile Larochelle-Langevin
#

CREATE DATABASE streamify DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE streamify;

CREATE TABLE users (
  userID    VARCHAR(50),
  password    VARCHAR(50),
  email	      VARCHAR(50)
);
ALTER TABLE users ADD PRIMARY KEY(userID); 

INSERT INTO users VALUES ('Emile', 'passwd', 'emile01@gmail.com');
INSERT INTO users VALUES ('Antoine', 'passwd', 'antoine08@gmail.com');
INSERT INTO users VALUES ('Melanie', 'passwd', 'melAnn@gmail.com');
INSERT INTO users VALUES ('Lord', 'passwd', 'milord@gmail.com');
INSERT INTO users VALUES ('Julie', 'passwd', 'juju@gmail.com');

CREATE TABLE songs (
  songID        VARCHAR(50),
  artistID      VARCHAR(50),
  feature       VARCHAR(50),
  playTime      VARCHAR(50), 
  timesPlayed   INT
);
ALTER TABLE songs ADD PRIMARY KEY(songID); 


INSERT INTO songs VALUES ('Knee_Socks', 'Arctic_Monkey', '', '4:17',96);
INSERT INTO songs VALUES ('505', 'Arctic_Monkey', '','4:13',69);
INSERT INTO songs VALUES ('Genie_In_a_Bottle', 'Christina_Aguilera', '', '3:37',26);
INSERT INTO songs VALUES ('Yeah!', 'Usher', 'Lil_Jon:Ludacris', '4:12',153);
INSERT INTO songs VALUES ('Wannabe', 'Spice_Girls', '', '3:22',8);



CREATE TABLE artiste (
  artisteID        VARCHAR(50),
  name      VARCHAR(50)
);
ALTER TABLE artiste ADD PRIMARY KEY(artisteID); 
INSERT INTO artiste VALUES ('a1', 'Arctic_Monkey');
INSERT INTO artiste VALUES ('a2', 'Christina_Aguilera');
INSERT INTO artiste VALUES ('a3', 'Usher');
INSERT INTO artiste VALUES ('a4', 'Spice_Girls');


CREATE TABLE admin (
adminID    VARCHAR(50),
password   VARCHAR(50),
email      VARCHAR(50)
);
ALTER TABLE admin ADD PRIMARY KEY(adminID);
INSERT INTO admin VALUES ('admin','admin','admin@gmail.com');


