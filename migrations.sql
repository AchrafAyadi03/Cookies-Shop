-- Migration: auth + commandes
USE maisoncookies;

-- 1) Élargir le champ password pour supporter les hash bcrypt
ALTER TABLE utilisateur MODIFY password VARCHAR(255) NOT NULL;

-- 2) Re-hasher l'admin existant + insérer khaled et naceur
UPDATE utilisateur
SET password = '$2y$12$Jeoy1uS0LRYG26xtopp2weM35/Xb5rNbEd6UnR16c1.aea1F6us4S'
WHERE email = 'achraf@gmail.com';

INSERT INTO utilisateur (nom, prenom, telephone, email, password, role) VALUES
('khaled', 'elahmar', 20000001, 'khaled@gmail.com',
 '$2y$12$tL3p4m/jZ0XpG0Bi03RKOumo27VSdY4wYMkZ1BJogTpY9LVNze.ZW', 'client'),
('naceur', 'ben ali', 20000002, 'naceur@gmail.com',
 '$2y$12$s860QCy5IMPQficWk1MBdeYMCVftKX2LMdcIYlXFBKo4CXSYK7cM.', 'client');

-- 3) Table des commandes
CREATE TABLE IF NOT EXISTS commande (
  id INT NOT NULL AUTO_INCREMENT,
  utilisateur_id INT NOT NULL,
  date_commande DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  total DECIMAL(10,2) NOT NULL,
  statut ENUM('en_attente','validee','livree') NOT NULL DEFAULT 'en_attente',
  PRIMARY KEY (id),
  KEY utilisateur_id (utilisateur_id),
  CONSTRAINT fk_commande_user FOREIGN KEY (utilisateur_id)
    REFERENCES utilisateur(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 4) Détails (lignes) de chaque commande
CREATE TABLE IF NOT EXISTS commande_details (
  id INT NOT NULL AUTO_INCREMENT,
  commande_id INT NOT NULL,
  cookie_id INT NOT NULL,
  quantite INT NOT NULL,
  prix_unitaire DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (id),
  KEY commande_id (commande_id),
  KEY cookie_id (cookie_id),
  CONSTRAINT fk_details_commande FOREIGN KEY (commande_id)
    REFERENCES commande(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_details_cookie FOREIGN KEY (cookie_id)
    REFERENCES cookies(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
