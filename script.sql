-- ============================================================
-- Script SQL SQLite - Caisse Supermarché
-- ============================================================

PRAGMA foreign_keys = ON;

-- ----------------------------
-- Table produit
-- ----------------------------
DROP TABLE IF EXISTS produit;
CREATE TABLE produit (
    id              INTEGER PRIMARY KEY AUTOINCREMENT,
    designation     VARCHAR(150) NOT NULL,
    prix            DECIMAL(10,2) NOT NULL DEFAULT 0,
    quantite_stock  INTEGER NOT NULL DEFAULT 0,
    created_at      DATETIME,
    updated_at      DATETIME
);

-- ----------------------------
-- Table caisse
-- ----------------------------
DROP TABLE IF EXISTS caisse;
CREATE TABLE caisse (
    id      INTEGER PRIMARY KEY AUTOINCREMENT,
    numero  INTEGER NOT NULL,
    libelle VARCHAR(100)
);

-- ----------------------------
-- Table achat (= un panier / une transaction client)
-- ----------------------------
DROP TABLE IF EXISTS achat;
CREATE TABLE achat (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    id_caisse   INTEGER NOT NULL,
    date_achat  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    statut      VARCHAR(20) NOT NULL DEFAULT 'en_cours', -- en_cours | cloture
    total       DECIMAL(10,2) NOT NULL DEFAULT 0,
    FOREIGN KEY (id_caisse) REFERENCES caisse(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- ----------------------------
-- Table ligne_achat (détail des produits dans un achat)
-- ----------------------------
DROP TABLE IF EXISTS ligne_achat;
CREATE TABLE ligne_achat (
    id              INTEGER PRIMARY KEY AUTOINCREMENT,
    id_achat        INTEGER NOT NULL,
    id_produit      INTEGER NOT NULL,
    quantite        INTEGER NOT NULL,
    prix_unitaire   DECIMAL(10,2) NOT NULL,
    montant         DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_achat) REFERENCES achat(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_produit) REFERENCES produit(id)
        ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- ============================================================
-- Données initiales
-- ============================================================

-- 5 produits
INSERT INTO produit (designation, prix, quantite_stock) VALUES
    ('Biscuit',  1000, 50),
    ('Pain',     400,  100),
    ('Lait 1L',  1500, 30),
    ('Riz 1kg',  2500, 80),
    ('Huile 1L', 5000, 25);

-- 2 caisses
INSERT INTO caisse (numero, libelle) VALUES
    (1, 'Caisse 1'),
    (2, 'Caisse 2');