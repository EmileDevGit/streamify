#
# Description : Script SQL pour supprimer les tables produits et utilisateurs, et la 
#               base de données "commerce"
#               utilisée dans les  démos du cours 420-G16-R0
# Date        : 2020/03/11
# Auteur      : Pierre Coutu
#
USE streamify;

DELETE FROM users;
DROP TABLE users;

DELETE FROM songs;
DROP TABLE songs;

DROP DATABASE streamify;

