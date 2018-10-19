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

INSERT INTO rh(id_personne, mdp, nom, prenom, poste) VALUES
(4, 'mdp', 'Sylvain', 'Partick', 'Responssable RH'),
(5, 'mdp', 'Amandine', 'Claude', 'Chef RH'),
(6, 'mdp', 'Loan', 'Chantal', 'RH'),
(7, 'mdp', 'Jacques', 'Pierre', 'RH');

INSERT INTO offre_emplois (id_personne, date_limite, description, libelle, lieu, salaire, type_contrat, video) VALUES
(4, '2019-06-20', 'Développeur, ...', 'Développeur', 'Lyon', 50000, 'CDI', 'https://0380081g.index-education.net/pronote/eleve.html?login=true'),
(5, '2019-08-10', 'Bijouterie, ...', 'Bijouterie', 'Vienne', 25000, 'CDD', 'https://0380081g.index-education.net/pronote/eleve.html?login=true'),
(6, '2019-02-11', 'Analyse, ...', 'Analyse', 'Luzinay', 110000, 'Interim', 'https://0380081g.index-education.net/pronote/eleve.html?login=true');

INSERT INTO candidature(id_offre, id_personne, date_candidature, reception) VALUES
(1, 1, '2018-10-19', false),
(2, 2, '2018-09-18', false),
(3, 3, '2018-11-10', false);

INSERT INTO competence(id_offre) VALUES
(1),
(3);

INSERT INTO comptence(id_personne, libelle) VALUES
(1, 'Anglais'),
(2, 'Français'),
(3, 'Espagnol');

INSERT INTO docs(libelle) VALUES
('CV'),
('Lettre de motivation'),
('Vidéos');

INSERT INTO necessite(id_offre) VALUES
(1),
(1),
(1),

(2),
(2),

(3),
(3),
(3);

INSERT INTO deposer(id_candidature, url) VALUES
(1, "url1"),
(1, "url2"),
(1, "url3"),

(2, "url1"),
(2, "url2"),

(3, "url1"),
(3, "url2"),
(3, "url3");
