# 
# Description : Script SQL pour créer et initialiser les tables de test
#               pour la base de données "streamify"
#               utilisée dans les  démos du cours 420-G16-R0
# Date        : 2024/03/11
# Auteur      : Émile Girard et Émile Larochelle-Langevin
#
USE streamify;

DROP DATABASE streamify;

CREATE DATABASE streamify DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE streamify;

-- Table des Users
CREATE TABLE users (
  userID          INT NOT NULL AUTO_INCREMENT,
  userName        VARCHAR(50) UNIQUE,
  password        VARCHAR(50),
  email	          VARCHAR(50) UNIQUE,
  adminStatus     TINYINT,
  imageFileName   VARCHAR(255),
  PRIMARY KEY (userID)
);

INSERT INTO users VALUES(1,"Emile", "password", "emile@email.com", 1, "defaultProfile.png,");
INSERT INTO users VALUES(2,"Julie", "password", "julie@email.com", 0, "defaultProfile.png");


-- Table des Artiste
CREATE TABLE artists (
  artistID        INT NOT NULL AUTO_INCREMENT,
  artistName      VARCHAR(50),
  imageFileName   VARCHAR(255),
  PRIMARY KEY (artistID)
);

INSERT INTO artists VALUES(1, "Arctic Monkeys", "noImage");
INSERT INTO artists VALUES(2, "Wallows", "noImage");


-- Table des playlists
CREATE TABLE playlists (
  playlistID        INT NOT NULL AUTO_INCREMENT,
  playlistName      VARCHAR(50),
  timesPlayed       INT,
  public            TINYINT,
  imageFileName     VARCHAR(50),
  userID            INT,
  PRIMARY KEY (playlistID),
  FOREIGN KEY (userID) REFERENCES users(userID)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);

INSERT INTO playlists VALUES(1, "Chill", 0, 0, "noImage", 1);
INSERT INTO playlists VALUES(2, "Study", 0, 0, "noImage", 2);

-- Table des albums
CREATE TABLE albums (
  albumID        INT NOT NULL AUTO_INCREMENT,
  albumName      VARCHAR(50),
  imageFileName  VARCHAR(255),
  artistID       INT,
  PRIMARY KEY (albumID),
  FOREIGN KEY (artistID) REFERENCES artists(artistID)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);

INSERT INTO albums VALUES(1, "Album1", "noImage", 1);
INSERT INTO albums VALUES(2, "Album2", "noImage", 1);
INSERT INTO albums VALUES(3, "Album3", "noImage", 2);
INSERT INTO albums VALUES(4, "Album4", "noImage", 2);

-- Table des Chansons
CREATE TABLE songs (
  songID        INT NOT NULL AUTO_INCREMENT,
  songName      VARCHAR(50),
  playTime      VARCHAR(50), 
  timesPlayed   INT,
  imageFileName VARCHAR(255),
  mediaFileName VARCHAR(255),
  albumID       INT,
  PRIMARY KEY (songID),
  FOREIGN KEY (albumID) REFERENCES albums(albumID)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);

INSERT INTO songs VALUES(1, "Wannabe", "4:25", 0, "noImage", "noFile", 1);
INSERT INTO songs VALUES(2, "Prophets", "3:16", 0, "noImage", "noFile", 2);
INSERT INTO songs VALUES(3, "Exctract", "4:25", 0, "noImage", "noFile", 2);
INSERT INTO songs VALUES(4, "Love My Cat", "3:16", 0, "noImage", "noFile", 1);

-- Table d'Association 

-- Playlists - Chansons
CREATE TABLE playlist_song (
  playlistID    INT,
  songID        INT,
  FOREIGN KEY (playlistID) REFERENCES playlists(playlistID) 
      ON DELETE CASCADE
      ON UPDATE CASCADE,
  FOREIGN KEY (songID) REFERENCES songs(songID)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);

INSERT INTO playlist_song VALUES(1,1);
INSERT INTO playlist_song VALUES(1,2);
INSERT INTO playlist_song VALUES(1,3);
INSERT INTO playlist_song VALUES(2,1);
INSERT INTO playlist_song VALUES(2,2);
INSERT INTO playlist_song VALUES(2,4);




