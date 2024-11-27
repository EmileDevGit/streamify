# 
# Description : Script SQL pour créer et initialiser les tables de test
#               pour la base de données "streamify"
#               utilisée dans les  démos du cours 420-G16-R0
# Date        : 2024/03/11
# Auteur      : Émile Girard et Émile Larochelle-Langevin
#

CREATE DATABASE streamify DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE streamify;

-- Table des Users
CREATE TABLE utilisateurs (
  userID          AUTO_INCREMENT,
  username        VARCHAR(50),
  password        VARCHAR(50),
  email	          VARCHAR(50),
  adminStatus     TINYINT,
  imageFileName   VARCHAR(50),
);

-- Table des Artiste
CREATE TABLE artistes (
  artistID        AUTO_INCREMENT,
  artistName      VARCHAR(50),
  imageFileName   VARCHAR(50),
);

-- Table des playlists
CREATE TABLE playlists (
  playlistID        AUTO_INCREMENT,
  playlistName      VARCHAR(50),
  timesPlayed       INT,
  public            TINYINT,
  imageFileName     VARCHAR(50),
  userID            VARCHAR(50),
);

-- Table des Chansons
CREATE TABLE songs (
  songID        AUTO_INCREMENT,
  songName      VARCHAR(50),
  playTime      VARCHAR(50), 
  timesPlayed   INT,
  imageFileName VARCHAR(50),
  mediaFileName VARCHAR(50),
  artistID      VARCHAR(50),
);

-- Table des albums
CREATE TABLE albums (
  albumID        VARCHAR(50),
  albumName      VARCHAR(50),
  imageFileName  VARCHAR(50),
  artistID       VARCHAR(50),
);

-- Insertion des valeurs de test
INSERT INTO users VALUES ();

INSERT INTO artistes VALUES ();

INSERT INTO playlists VALUES ();

INSERT INTO songs VALUES ();

INSERT INTO album VALUES ();

-- Table d'Association 

-- Playlists - Chansons
CREATE TABLE playlist_song (
  playlistID    VARCHAR(50),
  songID        VARCHAR(50),
);

INSERT INTO playlist_song VALUES ();




