# 
# Description : Script SQL pour créer et initialiser les tables de test
#               pour la base de données "streamify"
#               utilisée dans les  démos du cours 420-G16-R0
# Date        : 2020/03/11
# Auteur      : Émile Girard
#

CREATE DATABASE streamify DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE streamify;

CREATE TABLE users (
  userID      VARCHAR(50),
  username    VARCHAR(50),
  password    VARCHAR(50),
  email	      VARCHAR(50)
);

INSERT INTO users VALUES ('u1','Emile', 'passwd', 'emile01@gmail.com');
INSERT INTO users VALUES ('u2','Antoine', 'passwd', 'antoine08@gmail.com');
INSERT INTO users VALUES ('u3','Melanie', 'passwd', 'melAnn@gmail.com');
INSERT INTO users VALUES ('u4','Lord', 'passwd', 'milord@gmail.com');
INSERT INTO users VALUES ('u5','Julie', 'passwd', 'juju@gmail.com');

