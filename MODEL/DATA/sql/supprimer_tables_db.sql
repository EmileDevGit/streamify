#
# Description : Script SQL pour supprimer les tables produits et utilisateurs, et la 
#               base de données "commerce"
#               utilisée dans les  démos du cours 420-G16-R0
# Date        : 2020/03/11
# Auteur      : Pierre Coutu
#
USE streamify;

DELETE FROM user;
DROP TABLE user;

DELETE FROM playlist;
DROP TABLE plsylist;

DELETE FROM song;
DROP TABLE song;

DELETE FROM artiste;
DROP TABLE artiste;

DELETE FROM admin;
DROP TABLE admin;

DROP DATABASE streamify;

