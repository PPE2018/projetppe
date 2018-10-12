#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------
DROP DATABASE ppe;
CREATE DATABASE ppe;
USE ppe;

#------------------------------------------------------------
# Table: TYPE_DOCS
#------------------------------------------------------------

CREATE TABLE TYPE_DOCS(
    id_docs_offre Int  Auto_increment  NOT NULL ,
    cv_type       Int NOT NULL ,
    lm_type       Int NOT NULL ,
    video_type    Int NOT NULL,
    CONSTRAINT TYPE_DOCS_PK PRIMARY KEY (id_docs_offre)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: DOCS_CANDIDAT
#------------------------------------------------------------

CREATE TABLE DOCS_CANDIDAT(
        id_docs_candidat Int  Auto_increment  NOT NULL ,
        cv               Varchar (50) NOT NULL ,
        lm               Varchar (50) NOT NULL ,
        video            Varchar (50) NOT NULL,
        CONSTRAINT DOCS_CANDIDAT_PK PRIMARY KEY (id_docs_candidat)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PERSONNE
#------------------------------------------------------------

CREATE TABLE PERSONNE(
        id_personne Int  Auto_increment  NOT NULL ,
        nom         Varchar (50) NOT NULL ,
        prenom      Varchar (50) NOT NULL ,
        mdp         Varchar (50) NOT NULL,
        CONSTRAINT PERSONNE_PK PRIMARY KEY (id_personne)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CANDIDATS
#------------------------------------------------------------

CREATE TABLE CANDIDATS(
        id_personne Int NOT NULL ,
        nom         Varchar (50) NOT NULL ,
        prenom      Varchar (50) NOT NULL ,
        mdp         Varchar (50) NOT NULL,
        CONSTRAINT CANDIDATS_PK PRIMARY KEY (id_personne),
        CONSTRAINT CANDIDATS_PERSONNE_FK FOREIGN KEY (id_personne) REFERENCES PERSONNE(id_personne)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: RH
#------------------------------------------------------------

CREATE TABLE RH(
        id_personne Int NOT NULL ,
        poste       Varchar (50) NOT NULL ,
        nom         Varchar (50) NOT NULL ,
        prenom      Varchar (50) NOT NULL ,
        mdp         Varchar (50) NOT NULL,
        CONSTRAINT RH_PK PRIMARY KEY (id_personne),
        CONSTRAINT RH_PERSONNE_FK FOREIGN KEY (id_personne) REFERENCES PERSONNE(id_personne)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CANDIDATURES
#------------------------------------------------------------

CREATE TABLE CANDIDATURES(
        id_candidature   Int  Auto_increment  NOT NULL ,
        date_candidature Date NOT NULL ,
        reception        Int NOT NULL ,
        id_personne      Int NOT NULL,
        CONSTRAINT CANDIDATURES_PK PRIMARY KEY (id_candidature),
        CONSTRAINT CANDIDATURES_CANDIDATS_FK FOREIGN KEY (id_personne) REFERENCES CANDIDATS(id_personne)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: OFFRE_EMPLOIS
#------------------------------------------------------------

CREATE TABLE OFFRE_EMPLOIS(
        id_offre       Int  Auto_increment  NOT NULL ,
        libelle        Varchar (50) NOT NULL ,
        description    Varchar (50) NOT NULL ,
        date_limite    Date NOT NULL ,
        video          Varchar (50) NOT NULL ,
        id_personne    Int NOT NULL ,
        id_docs_offre  Int NOT NULL ,
        id_candidature Int NOT NULL,
        CONSTRAINT OFFRE_EMPLOIS_PK PRIMARY KEY (id_offre),
        CONSTRAINT OFFRE_EMPLOIS_RH_FK FOREIGN KEY (id_personne) REFERENCES RH(id_personne),
        CONSTRAINT OFFRE_EMPLOIS_TYPE_DOCS0_FK FOREIGN KEY (id_docs_offre) REFERENCES TYPE_DOCS(id_docs_offre),
        CONSTRAINT OFFRE_EMPLOIS_CANDIDATURES1_FK FOREIGN KEY (id_candidature) REFERENCES CANDIDATURES(id_candidature)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: COMPETENCES
#------------------------------------------------------------

CREATE TABLE COMPETENCES(
        id_competences Int  Auto_increment  NOT NULL ,
        libelle        Varchar (50) NOT NULL ,
        id_personne    Int NOT NULL ,
        id_offre       Int NOT NULL,
        CONSTRAINT COMPETENCES_PK PRIMARY KEY (id_competences),
    CONSTRAINT COMPETENCES_CANDIDATS_FK FOREIGN KEY (id_personne) REFERENCES CANDIDATS(id_personne),
    CONSTRAINT COMPETENCES_OFFRE_EMPLOIS0_FK FOREIGN KEY (id_offre) REFERENCES OFFRE_EMPLOIS(id_offre)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: AVOIR2
#------------------------------------------------------------

CREATE TABLE POSSEDER(
        id_candidature   Int NOT NULL ,
        id_docs_candidat Int NOT NULL,
        CONSTRAINT POSSEDER_PK PRIMARY KEY (id_candidature,id_docs_candidat),
        CONSTRAINT POSSEDER_CANDIDATURES_FK FOREIGN KEY (id_candidature) REFERENCES CANDIDATURES(id_candidature),
        CONSTRAINT POSSEDER_DOCS_CANDIDAT0_FK FOREIGN KEY (id_docs_candidat) REFERENCES DOCS_CANDIDAT(id_docs_candidat)
)ENGINE=InnoDB;
