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
CREATE TABLE user (
  userID      VARCHAR(50),
  password    VARCHAR(50),
  email	      VARCHAR(50),
  PRIMARY KEY(userID)
);

INSERT INTO user VALUES ('Emile', 'passwd', 'emile01@gmail.com');
INSERT INTO user VALUES ('Antoine', 'passwd', 'antoine08@gmail.com');
INSERT INTO user VALUES ('Melanie', 'passwd', 'melAnn@gmail.com');
INSERT INTO user VALUES ('Lord', 'passwd', 'milord@gmail.com');
INSERT INTO user VALUES ('Julie', 'passwd', 'juju@gmail.com');


-- Table des playlists
CREATE TABLE playlist (
  playlistID        VARCHAR(50),
  timesPlayed       INT,
  userID            VARCHAR(50),
  public            TINYINT,
  PRIMARY KEY(playlistID),
  FOREIGN KEY(userID) REFERENCES user(userID)
);

INSERT INTO playlist VALUES ('Beats to relax and study', 83, 'Emile', FALSE);
INSERT INTO playlist VALUES ('Roadtrip', 69, 'Antoine', TRUE);
INSERT INTO playlist VALUES ('Chill', 12, 'Julie', FALSE);
INSERT INTO playlist VALUES ('Friday night out', 152, 'Melanie', TRUE);

-- Table des Chansons
CREATE TABLE song (
  songID        VARCHAR(50),
  artistID      VARCHAR(50),
  playTime      VARCHAR(50), 
  timesPlayed   INT,
  PRIMARY KEY (songID)
);

INSERT INTO song VALUES ('Knee Socks', 'Arctic Monkey', '4:17',96);
INSERT INTO song VALUES ('505', 'Arctic Monkey','4:13',69);
INSERT INTO song VALUES ('Genie In a Bottle', 'Christina Aguilera', '3:37',26);
INSERT INTO song VALUES ('Yeah!', 'Usher', '4:12',153);
INSERT INTO song VALUES ('Wannabe', 'Spice Girls', '3:22',8);

-- Table d'Association Playlists - Chansons
CREATE TABLE playlist_song (
  playlistID    VARCHAR(50),
  songID        VARCHAR(50),
  FOREIGN KEY(playlistID) REFERENCES playlist(playlistID),
  FOREIGN KEY(songID) REFERENCES song(songID)
);

INSERT INTO playlist_song VALUES ('Beats to relax and study', 'Knee Socks');
INSERT INTO playlist_song VALUES ('Beats to relax and study', '505');
INSERT INTO playlist_song VALUES ('Beats to relax and study', 'Wannabe');
INSERT INTO playlist_song VALUES ('Beats to relax and study', 'Yeah!');
INSERT INTO playlist_song VALUES ('Roadtrip', 'Genie In a Bottle');
INSERT INTO playlist_song VALUES ('Roadtrip', 'Yeah!');
INSERT INTO playlist_song VALUES ('Roadtrip', '505');
INSERT INTO playlist_song VALUES ('Chill', 'Knee Socks');
INSERT INTO playlist_song VALUES ('Chill', '505');
INSERT INTO playlist_song VALUES ('Chill', 'Genie In a Bottle');
INSERT INTO playlist_song VALUES ('Friday night out', 'Yeah!');
INSERT INTO playlist_song VALUES ('Friday night out', 'Genie In a Bottle');
INSERT INTO playlist_song VALUES ('Friday night out', 'Wannabe');


-- Table des Artiste
CREATE TABLE artiste (
  artisteID        VARCHAR(50),
  name             VARCHAR(50),
  PRIMARY KEY (artisteID)
);


INSERT INTO artiste VALUES ('a1', 'Arctic_Monkey');
INSERT INTO artiste VALUES ('a2', 'Christina_Aguilera');
INSERT INTO artiste VALUES ('a3', 'Usher');
INSERT INTO artiste VALUES ('a4', 'Spice_Girls');

-- Table d'Administrateur
CREATE TABLE admin (
  adminID    VARCHAR(50),
  password   VARCHAR(50),
  email      VARCHAR(50),
  PRIMARY KEY(adminID)
);

INSERT INTO admin VALUES ('admin','admin','admin@gmail.com');


