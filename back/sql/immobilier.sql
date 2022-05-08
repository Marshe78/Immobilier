CREATE TABLE Utilisateur(
   Id_utilisateur INT AUTO_INCREMENT,
   Nom VARCHAR(50) NOT NULL,
   Prenom VARCHAR(50) NOT NULL,
   Email VARCHAR(50) NOT NULL,
   Password VARCHAR(50) NOT NULL,
   Role VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_utilisateur)
);

CREATE TABLE Bien(
   Id_bien INT AUTO_INCREMENT,
   Image_bien VARCHAR(250),
   Adresse VARCHAR(100) NOT NULL,
   Ville VARCHAR(50) NOT NULL,
   Type_bien VARCHAR(50),
   Proprietaire VARCHAR(50) NOT NULL,
   Superficie INT NOT NULL,
   NbPiece INT NOT NULL,
   Prix VARCHAR(50) NOT NULL,
   Paiement VARCHAR(50) NOT NULL,
   Status_bien INT NOT NULL,
   PRIMARY KEY(Id_bien)
);

CREATE TABLE Option_bien(
   Id_option INT AUTO_INCREMENT,
   Nom VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_option)
);

CREATE TABLE Rendez_vous(
   Id_rdv INT AUTO_INCREMENT,
   Date_rdv DATETIME NOT NULL,
   Annulation BOOLEAN NOT NULL,
   Description_rdv VARCHAR(50) NOT NULL,
   Id_utilisateur INT,
   PRIMARY KEY(Id_rdv),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur)
);

CREATE TABLE Possede(
   Id_bien INT ,
   Id_option INT ,
   Possede BOOLEAN NOT NULL,
   PRIMARY KEY(Id_bien, Id_option),
   FOREIGN KEY(Id_bien) REFERENCES Bien(Id_bien),
   FOREIGN KEY(Id_option) REFERENCES Option_bien(Id_option)
);

CREATE TABLE Attribuer(
   Id_bien INT ,
   Id_rdv INT ,
   PRIMARY KEY(Id_bien, Id_rdv),
   FOREIGN KEY(Id_bien) REFERENCES Bien(Id_bien),
   FOREIGN KEY(Id_rdv) REFERENCES Rendez_vous(Id_rdv)
);

CREATE TABLE Gerer(
   Id_utilisateur INT,
   Id_bien INT,
   PRIMARY KEY(Id_utilisateur, Id_bien),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur),
   FOREIGN KEY(Id_bien) REFERENCES Bien(Id_bien)
);
