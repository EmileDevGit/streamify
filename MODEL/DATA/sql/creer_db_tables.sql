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

INSERT INTO users VALUES(0,"Emile", "password", "emile@email.com", 1, "defaultProfile.png");
INSERT INTO users VALUES(0,"Julie", "password", "julie@email.com", 0, "defaultProfile.png");
INSERT INTO users VALUES(0,"Henri", "password", "henri@email.com", 0, "defaultProfile.png");
INSERT INTO users VALUES(0,"Charlotte", "password", "charlotte@email.com", 0, "defaultProfile.png");


-- Table des Artiste
CREATE TABLE artists (
  artistID        INT NOT NULL AUTO_INCREMENT,
  artistName      VARCHAR(50) UNIQUE,
  imageFileName   VARCHAR(255),
  PRIMARY KEY (artistID)
);

INSERT INTO artists VALUES(0, "Arctic Monkeys", "defaultArtist.png");
INSERT INTO artists VALUES(0, "Ariana Grande", "defaultArtist.png");
INSERT INTO artists VALUES(0, "The Beatles", "defaultArtist.png");
INSERT INTO artists VALUES(0, "Billie Eyelash", "defaultArtist.png");
INSERT INTO artists VALUES(0, "Wallows", "defaultArtist.png");


-- Table des playlists
CREATE TABLE playlists (
  playlistID        INT NOT NULL AUTO_INCREMENT,
  playlistName      VARCHAR(50) UNIQUE,
  timesPlayed       INT,
  public            TINYINT,
  imageFileName     VARCHAR(50),
  userID            INT,
  PRIMARY KEY (playlistID),
  FOREIGN KEY (userID) REFERENCES users(userID)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);

INSERT INTO playlists VALUES(0, "Chill", 0, 1, "defaultPlaylist.png", 1);
INSERT INTO playlists VALUES(0, "Study", 0, 1, "defaultPlaylist.png", 2);
INSERT INTO playlists VALUES(0, "Driving", 0, 1, "defaultPlaylist.png", 3);
INSERT INTO playlists VALUES(0, "Sadeness", 0, 1, "defaultPlaylist.png", 3);
INSERT INTO playlists VALUES(0, "Riseand Shine!", 0, 1, "defaultPlaylist.png", 1);

-- Table des albums
CREATE TABLE albums (
  albumID        INT NOT NULL AUTO_INCREMENT,
  albumName      VARCHAR(50) UNIQUE,
  imageFileName  VARCHAR(255),
  artistID       INT,
  PRIMARY KEY (albumID),
  FOREIGN KEY (artistID) REFERENCES artists(artistID)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);

INSERT INTO albums VALUES(0, "Abbey Road", "defaultAlbum.png", 1);
INSERT INTO albums VALUES(0, "Jungle", "defaultAlbum.png", 4);
INSERT INTO albums VALUES(0, "Printemps", "defaultAlbum.png", 2);
INSERT INTO albums VALUES(0, "Coffe", "defaultAlbum.png", 3);

-- Table des Chansons
CREATE TABLE songs (
  songID        INT NOT NULL AUTO_INCREMENT,
  songName      VARCHAR(50) UNIQUE,
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

INSERT INTO songs VALUES(0, "Wannabe", "4:25", 0, "defaultSong.png", "noFile", 1);
INSERT INTO songs VALUES(0, "Prophets", "3:16", 0, "defaultSong.png", "noFile", 2);
INSERT INTO songs VALUES(0, "Exctract", "4:25", 0, "defaultSong.png", "noFile", 3);
INSERT INTO songs VALUES(0, "Étoile Filantes", "3:16", 0, "defaultSong.png", "noFile", 1);
INSERT INTO songs VALUES(0, "Bad Guy", "5:24", 0, "defaultSong.png", "noFile", 4);
INSERT INTO songs VALUES(0, "Hey Jude!", "3:11", 0, "defaultSong.png", "noFile", 4);
INSERT INTO songs VALUES(0, "Hot to Go", "2:57", 0, "defaultSong.png", "noFile", 1);

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
INSERT INTO playlist_song VALUES(3,1);
INSERT INTO playlist_song VALUES(3,2);
INSERT INTO playlist_song VALUES(3,3);
INSERT INTO playlist_song VALUES(4,1);
INSERT INTO playlist_song VALUES(4,2);
INSERT INTO playlist_song VALUES(4,4);




