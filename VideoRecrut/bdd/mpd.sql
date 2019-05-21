#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

DROP DATABASE ppe;
CREATE DATABASE ppe DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE ppe;
#------------------------------------------------------------
# Table: DOCS
#------------------------------------------------------------

CREATE TABLE DOCS(
        id      Int  Auto_increment  NOT NULL ,
        libelle Varchar (50) NOT NULL
	,CONSTRAINT DOCS_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PERSONNE
#------------------------------------------------------------

CREATE TABLE PERSONNE(
        id_personne Int  Auto_increment  NOT NULL ,
        nom         Varchar (50) NOT NULL ,
        prenom      Varchar (50) NOT NULL ,
        mdp         Varchar (50) NOT NULL
	,CONSTRAINT PERSONNE_PK PRIMARY KEY (id_personne)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CANDIDAT
#------------------------------------------------------------

CREATE TABLE CANDIDAT(
        id_personne Int NOT NULL ,
        nom         Varchar (50) NOT NULL ,
        prenom      Varchar (50) NOT NULL ,
        mdp         Varchar (50) NOT NULL
	,CONSTRAINT CANDIDAT_PK PRIMARY KEY (id_personne)

	,CONSTRAINT CANDIDAT_PERSONNE_FK FOREIGN KEY (id_personne) REFERENCES PERSONNE(id_personne)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: RH
#------------------------------------------------------------

CREATE TABLE RH(
        id_personne Int NOT NULL ,
        poste       Varchar (50) NOT NULL ,
        nom         Varchar (50) NOT NULL ,
        prenom      Varchar (50) NOT NULL ,
        mdp         Varchar (50) NOT NULL
	,CONSTRAINT RH_PK PRIMARY KEY (id_personne)

	,CONSTRAINT RH_PERSONNE_FK FOREIGN KEY (id_personne) REFERENCES PERSONNE(id_personne)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: RH
#------------------------------------------------------------

CREATE TABLE DEV(
        id_personne Int NOT NULL ,
        nom         Varchar (50) NOT NULL ,
        mdp         Varchar (50) NOT NULL
	,CONSTRAINT DEV_PK PRIMARY KEY (id_personne)

	,CONSTRAINT DEV_PERSONNE_FK FOREIGN KEY (id_personne) REFERENCES PERSONNE(id_personne)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: OFFRE_EMPLOIS
#------------------------------------------------------------

CREATE TABLE OFFRE_EMPLOIS(
        id_offre     Int  Auto_increment  NOT NULL ,
        libelle      Varchar (50) NOT NULL ,
        description  Varchar (500) NOT NULL ,
        lieu         Varchar (50) NOT NULL ,
        type_contrat Varchar (50) NOT NULL ,
        salaire      Float   (10) NOT NULL ,
        date_limite  Date NOT NULL ,
        video        Varchar (500) NOT NULL ,
        supprimer    Boolean NOT NULL,
        id_personne  Int NOT NULL
	,CONSTRAINT OFFRE_EMPLOIS_PK PRIMARY KEY (id_offre)

	,CONSTRAINT OFFRE_EMPLOIS_RH_FK FOREIGN KEY (id_personne) REFERENCES RH(id_personne)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CANDIDATURE
#------------------------------------------------------------

CREATE TABLE CANDIDATURE(
        id_candidature    Int  Auto_increment  NOT NULL ,
        date_candidature  Varchar(30) NOT NULL ,
        reception         Boolean NOT NULL ,
        id_offre          Int NOT NULL ,
        id_personne       Int NOT NULL
	,CONSTRAINT CANDIDATURE_PK PRIMARY KEY (id_candidature)
	,CONSTRAINT CANDIDATURE_OFFRE_EMPLOIS_FK FOREIGN KEY (id_offre) REFERENCES OFFRE_EMPLOIS(id_offre)
	,CONSTRAINT CANDIDATURE_CANDIDAT0_FK FOREIGN KEY (id_personne) REFERENCES CANDIDAT(id_personne)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: COMPETENCE
#------------------------------------------------------------

CREATE TABLE COMPETENCE(
        id_competence Int  Auto_increment  NOT NULL ,
        libelle       Varchar (50) NOT NULL
	,CONSTRAINT COMPETENCE_PK PRIMARY KEY (id_competence)

)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: AVOIR
#------------------------------------------------------------

CREATE TABLE AVOIR(
        id_competence Int Auto_increment NOT NULL ,
        id_personne   Int NOT NULL
        ,CONSTRAINT AVOIR_PK PRIMARY KEY (id_competence, id_personne)
        ,CONSTRAINT AVOIR_FK_O FOREIGN KEY (id_competence) REFERENCES COMPETENCE(id_competence)
        ,CONSTRAINT AVOIR_FK_P FOREIGN KEY (id_personne) REFERENCES PERSONNE(id_personne)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: POSSEDER
#------------------------------------------------------------

CREATE TABLE POSSEDER(
        id_competence Int Auto_increment NOT NULL ,
        id_offre      Int NOT NULL
        ,CONSTRAINT POSSEDER_PK PRIMARY KEY (id_competence, id_offre)
        ,CONSTRAINT POSSEDER_FK_C FOREIGN KEY (id_competence) REFERENCES COMPETENCE(id_competence)
	      ,CONSTRAINT POSSEDER_FK_O FOREIGN KEY (id_offre) REFERENCES OFFRE_EMPLOIS(id_offre)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: NECESSITE
#------------------------------------------------------------

CREATE TABLE NECESSITE(
        id       Int Auto_increment NOT NULL ,
        id_offre Int NOT NULL
	,CONSTRAINT NECESSITE_PK PRIMARY KEY (id,id_offre)

	,CONSTRAINT NECESSITE_DOCS_FK FOREIGN KEY (id) REFERENCES DOCS(id)
	,CONSTRAINT NECESSITE_OFFRE_EMPLOIS0_FK FOREIGN KEY (id_offre) REFERENCES OFFRE_EMPLOIS(id_offre)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: DEPOSER
#------------------------------------------------------------

CREATE TABLE DEPOSER(
        id             Int Auto_increment NOT NULL ,
        id_candidature Int NOT NULL ,
        url            Varchar (50) NOT NULL
	,CONSTRAINT DEPOSER_PK PRIMARY KEY (id,id_candidature)

	,CONSTRAINT DEPOSER_DOCS_FK FOREIGN KEY (id) REFERENCES DOCS(id)
	,CONSTRAINT DEPOSER_CANDIDATURE0_FK FOREIGN KEY (id_candidature) REFERENCES CANDIDATURE(id_candidature)
)ENGINE=InnoDB;

INSERT INTO personne(mdp, nom, prenom) VALUES
('mdp', 'Jean', 'Pierre'),
('mdp', 'Partick', 'Delarue'),
('mdp', 'Emil', 'Lamar'),
('mdp', 'Sylvain', 'Partick'),
('mdp', 'Amandine', 'Claude'),
('mdp', 'Loan', 'Chantal'),
('mdp', 'Jacques', 'Pierre');

INSERT INTO candidat(id_personne, mdp, nom, prenom) VALUES
(1, 'mdp', 'Jean', 'Pierre'),
(2, 'mdp', 'Partick', 'Delarue'),
(3, 'mdp', 'Emil', 'Lamar');

INSERT INTO dev(id_personne, nom, mdp) VALUES
(1,'dev','test');



INSERT INTO rh(id_personne, mdp, nom, prenom, poste) VALUES
(4, 'mdp', 'Sylvain', 'Partick', 'Responssable RH'),
(5, 'Chef RH', 'admin', 'Claude', '*7CEB3FDE5F7A9C4CE5FBE610D7D8EDA62EBE5F4E'),
(6, 'mdp', 'Loan', 'Chantal', 'RH'),
(7, 'mdp', 'Jacques', 'Pierre', 'RH');

INSERT INTO offre_emplois (id_personne, date_limite, description, libelle, lieu, salaire, type_contrat, video, supprimer) VALUES
(4, '2019-06-20', 'Développeur, ...', 'Développeur', 'Lyon', 50000, 'CDI', 'https://0380081g.index-education.net/pronote/eleve.html?login=true',false ),
(5, '2016-08-10', 'Bijouterie, ...', 'Bijouterie', 'Vienne', 25000, 'CDD', 'https://0380081g.index-education.net/pronote/eleve.html?login=true',true),
(6, '2019-02-11', 'Analyse, ...', 'Analyse', 'Luzinay', 110000, 'Interim', 'https://0380081g.index-education.net/pronote/eleve.html?login=true', false);

INSERT INTO candidature(id_offre, id_personne, date_candidature, reception) VALUES
(1, 1, '2018-10-19', false),
(2, 2, '2018-09-18', false),
(3, 3, '2018-11-10', false);

INSERT INTO COMPETENCE(libelle) VALUES
('Anglais'),
('Français'),
('Espagnol');

INSERT INTO AVOIR(id_personne, id_competence) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 3),
(3, 1);

INSERT INTO POSSEDER(id_offre, id_competence) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 2);

INSERT INTO docs(libelle) VALUES
('CV'),
('Lettre de motivation'),
('Vidéos');

INSERT INTO necessite(id, id_offre) VALUES
(1, 1),
(2, 1),
(3, 1),

(1, 2),
(2, 2),

(1, 3),
(2, 3),
(3, 3);

INSERT INTO deposer(id_candidature, url, id) VALUES
(1, "url1", 1),
(1, "url2", 2),
(1, "url3", 3),

(2, "url1", 1),
(2, "url2", 2),

(3, "url1", 1),
(3, "url2", 2),
(3, "url3", 3);
