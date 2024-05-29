<?php
// Verbindungsdaten zur Datenbank
$servername = "localhost";
$username = "root";
$password = "";
$database = "mietwagen";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $database);

// Überprüfen, ob die Verbindung fehlgeschlagen ist
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Debugging der Post-Daten (nur für Entwicklung, in Produktion entfernen)
echo "POST-Daten: <br>";
var_dump($_POST);
echo "<br>";

// Formulardaten abrufen und isset() verwenden, um sicherzustellen, dass die Werte vorhanden sind
$fahrzeug = isset($_POST['fahrzeug']) ? $_POST['fahrzeug'] : '';
$beschreibung = isset($_POST['beschreibung']) ? $_POST['beschreibung'] : '';

// SQL-Abfrage zum Einfügen der Daten in die Tabelle vorbereiten
if ($stmt = $conn->prepare("INSERT INTO schadensfaelle (fahrzeug, beschreibung) VALUES (?, ?)")) {
    $stmt->bind_param("ss", $fahrzeug, $beschreibung);

    // Ausgabe des SQL-Befehls zur Überprüfung (nur für Entwicklung, in Produktion entfernen)
    echo "SQL-Befehl: INSERT INTO schadensfaelle (fahrzeug, beschreibung) VALUES ('$fahrzeug', '$beschreibung')<br>";

    // Überprüfen, ob das Einfügen erfolgreich war
    if ($stmt->execute()) {
        echo "Schadensfall erfolgreich eingetragen!";
    } else {
        echo "Fehler beim Eintragen des Schadensfalls: " . $stmt->error;
        error_log("Fehler beim Eintragen des Schadensfalls: " . $stmt->error);
    }

    // Statement schließen
    $stmt->close();
} else {
    echo "Fehler bei der Vorbereitung der SQL-Anweisung: " . $conn->error;
    error_log("Fehler bei der Vorbereitung der SQL-Anweisung: " . $conn->error);
}

// Verbindung zur Datenbank schließen
$conn->close();
?>