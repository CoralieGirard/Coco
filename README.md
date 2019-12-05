# BD
CREATE TABLE IF NOT EXISTS Usager
(
idUser INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
Username VARCHAR(40) UNIQUE,
Email VARCHAR(100),
Image LONGTEXT,
Password VARCHAR(1000)
);

CREATE TABLE IF NOT EXISTS Album
(
idAlbum INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
Titre VARCHAR(100),
Proprietaire INT,
Description LONGTEXT,
DateCreation VARCHAR(30),

CONSTRAINT Proprietaire_fk FOREIGN KEY (Proprietaire) 
REFERENCES Usager(idUser)

);

CREATE TABLE IF NOT EXISTS Image
(
idImage INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
URL VARCHAR(1000),
idAlbum INT,
Description VARCHAR(1000),
DateCreation VARCHAR(30),

CONSTRAINT idAlbum_fk FOREIGN KEY (idAlbum) 
REFERENCES Album(idUser)

);

CREATE TABLE IF NOT EXISTS Commentaire
(
idCommentaire INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
Proprietaire INT,
idType INT,
Type VARCHAR(30),
DateCreation VARCHAR(30),
Contenu LONGTEXT,

CONSTRAINT Proprietaire_fk FOREIGN KEY (Proprietaire) 
REFERENCES Usager(idUser)
);
