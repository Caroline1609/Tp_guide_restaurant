DROP DATABASE IF EXISTS db_guide;

CREATE DATABASE IF NOT EXISTS db_guide;

USE db_guide;

CREATE TABLE restaurant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    adresse VARCHAR(100) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    commentaire TEXT NOT NULL,
    note DOUBLE NOT NULL,
    visite DATE NOT NULL
);

INSERT INTO restaurant (nom, adresse, prix, commentaire, note, visite) VALUES
('JEAN-YVES SCHILLINGER', '17 Rue de la Poissonnerie, 68000 Colmar', 50.00, 'Le JY''S est un restaurant différent des autres avec un décor cosy et résolument contemporain qui attire une très belle clientèle cosmopolite. Jean-Yves Schillinger est un chef doublement étoilé créatif qui vous entraînera dans une ronde dépaysante à souhait où la cuisine du monde est à l''honneur. Le chef décline la cuisine fusion à sa façon. Une carte régulièrement renouvelée s''égaye de créations audacieuses et de plats revisités avec modernité et pertinence.', 9.0,'2019-12-05'),
('L’ADRIATICO','6 route de Neuf Brisach, 68000 Colmar, France', 25.00, 'Une des meilleurs pizzéria de la région. Service très agréable, efficace et souriant. Salle principale un peu bruyante mais cela donne un côté italien. Je recommande.',8.0,'2020-02-04'),
('vive les vacance','youhou', 25.00, 'teste ',8.0,'2020-02-04');


INSERT INTO restaurant (nom, adresse, prix, commentaire, note, visite)
VALUES
    ('Le Petit Alsacien', '15 Rue des Clefs, Colmar', 28.50, 'Cuisine alsacienne traditionnelle, choucroute et tarte flambée excellentes.', 4.6, '2025-10-12'),
    ('La Table du Marché', '8 Place du Marché, Mulhouse', 35.00, 'Produits frais du marché, plats créatifs et ambiance conviviale.', 4.8, '2025-11-02'),
    ('Le Wineck', '23 Rue des Vignerons, Riquewihr', 42.75, 'Caveau typique avec dégustation de vins et plats régionaux.', 4.7, '2025-09-28'),
    ('L\'Épicurien', '12 Rue des Tanneurs, Ribeauvillé', 38.00, 'Menu gastronomique revisitant les classiques alsaciens.', 4.9, '2025-10-25'),
    ('Le Bistrot du Château', '5 Rue du Château, Haut-Koenigsbourg', 30.50, 'Vue imprenable sur le château, cuisine locale et généreuse.', 4.5, '2025-11-15'),
    ('La Ferme Aubergine', '3 Chemin des Vergers, Turckheim', 25.00, 'Cuisine bio et végétarienne, cadre champêtre.', 4.4, '2025-10-05'),
    ('Le Comptoir des Saveurs', '18 Rue des Marchands, Thann', 29.90, 'Spécialités alsaciennes et desserts maison.', 4.3, '2025-11-20');

