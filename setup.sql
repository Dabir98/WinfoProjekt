CREATE TABLE rechnung (
    id INT AUTO_INCREMENT PRIMARY KEY,
    preis DECIMAL(10, 2) NOT NULL,
    fahrzeug VARCHAR(100) NOT NULL,
    kategorie VARCHAR(50) NOT NULL
);
