
-- Erstellen der Datenbank, falls sie noch nicht existiert
CREATE DATABASE IF NOT EXISTS mietwagen;

-- Wechseln zur Datenbank
USE mietwagen;

-- Erstellen der Tabelle fahrzeugliste
CREATE TABLE IF NOT EXISTS fahrzeugliste (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fahrzeugname VARCHAR(50) NOT NULL,
    kategorie VARCHAR(50) NOT NULL
);

-- Beispielhafte Fahrzeugdaten einfügen
INSERT INTO fahrzeugliste (fahrzeugname, kategorie) VALUES
('BMW 3er', 'Full Size Premium'),
('Audi A4', 'Intermediate Standard'),
('Mercedes C-Klasse', 'Full Size Premium'),
('VW Golf', 'Mini Economy'),
('Opel Astra', 'Intermediate Standard');

-- Erstellen der Tabelle schadensfaelle
CREATE TABLE IF NOT EXISTS schadensfaelle (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fahrzeug_id INT NOT NULL,
    beschreibung TEXT NOT NULL,
    datum DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (fahrzeug_id) REFERENCES fahrzeugliste(id)
);

-- Erstellen der Tabelle schadensliste
CREATE TABLE IF NOT EXISTS schadensliste (
   
    bereich VARCHAR(50) NOT NULL,
    element VARCHAR(50) NOT NULL,
    schadenart VARCHAR(50) NOT NULL,
    mini_econom DECIMAL(10,2) NOT NULL,
    intermediate_standa DECIMAL(10,2) NOT NULL,
    full_size_premiun DECIMAL(10,2) NOT NULL,
    datum DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (fahrzeug_id) REFERENCES fahrzeugliste(id)
);
