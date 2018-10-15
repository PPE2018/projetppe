#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

DROP DATABASE ppe;
CREATE DATABASE ppe;
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
# Table: OFFRE_EMPLOIS
#------------------------------------------------------------

CREATE TABLE OFFRE_EMPLOIS(
        id_offre    Int  Auto_increment  NOT NULL ,
        libelle     Varchar (50) NOT NULL ,
        description Varchar (50) NOT NULL ,
        date_limite Date NOT NULL ,
        video       Varchar (50) NOT NULL ,
        id_personne Int NOT NULL
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
        libelle       Varchar (50) NOT NULL ,
        id_personne   Int NOT NULL ,
        id_offre      Int NOT NULL
	,CONSTRAINT COMPETENCE_PK PRIMARY KEY (id_competence)

	,CONSTRAINT COMPETENCE_CANDIDAT_FK FOREIGN KEY (id_personne) REFERENCES CANDIDAT(id_personne)
	,CONSTRAINT COMPETENCE_OFFRE_EMPLOIS0_FK FOREIGN KEY (id_offre) REFERENCES OFFRE_EMPLOIS(id_offre)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: NECESSITE
#------------------------------------------------------------

CREATE TABLE NECESSITE(
        id       Int NOT NULL ,
        id_offre Int NOT NULL
	,CONSTRAINT NECESSITE_PK PRIMARY KEY (id,id_offre)

	,CONSTRAINT NECESSITE_DOCS_FK FOREIGN KEY (id) REFERENCES DOCS(id)
	,CONSTRAINT NECESSITE_OFFRE_EMPLOIS0_FK FOREIGN KEY (id_offre) REFERENCES OFFRE_EMPLOIS(id_offre)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: DEPOSER
#------------------------------------------------------------

CREATE TABLE DEPOSER(
        id             Int NOT NULL ,
        id_candidature Int NOT NULL ,
        url            Varchar (50) NOT NULL
	,CONSTRAINT DEPOSER_PK PRIMARY KEY (id,id_candidature)

	,CONSTRAINT DEPOSER_DOCS_FK FOREIGN KEY (id) REFERENCES DOCS(id)
	,CONSTRAINT DEPOSER_CANDIDATURE0_FK FOREIGN KEY (id_candidature) REFERENCES CANDIDATURE(id_candidature)
)ENGINE=InnoDB;
