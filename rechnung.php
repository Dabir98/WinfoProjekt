<?php
// Einbinden der FPDF-Bibliothek
require('lib/fpdf.php');

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

// Beispielabfrage zur Auswahl der letzten hinzugefügten Schadensmeldung
$sql = "SELECT id, fahrzeug, beschreibung, kategorie, preis FROM schadensfaelle ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Daten aus der Abfrage abrufen
    $row = $result->fetch_assoc();
    $schadensfall_id = $row["id"];
    $fahrzeugname = $row["fahrzeug"];
    $beschreibung = $row["beschreibung"];
    $kategorie = $row["kategorie"];
    $preis = $row["preis"];
    
    // PDF-Dokument erstellen
    $pdf = new FPDF();
    $pdf->AddPage();

    // Balken
    $pdf->SetFillColor(139, 0, 0);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 20, 'Rechnung', 0, 0, 'C', true);
    
    // Logo einfügen und verkleinern
    $image_path = 'lib/bild1.png.jpeg'; // Pfad zum Bild anpassen
    if (file_exists($image_path)) {
        $pdf->Image($image_path, 150, 10, 20); // Position und Größe des Bildes anpassen
    } else {
        echo "Das Bild konnte nicht gefunden werden: " . $image_path;
    }

    // Text unterhalb des Balkens
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(20); // Eine Zeile nach unten verschieben
    $pdf->Cell(0, 10, 'Vertrauen, wenn\'s drauf ankommt', 0, 1, 'C');

    // Schriftart und Schriftgröße für den Rest des Dokuments einstellen
    $pdf->SetFont('Arial', '', 12);

    // Rechnungsinformationen hinzufügen
    $pdf->Ln(10); // Zeilenumbruch
    $pdf->Cell(50, 10, 'Schadensfall ID:', 0, 0);
    $pdf->Cell(50, 10, $schadensfall_id, 0, 1);

    $pdf->Cell(50, 10, 'Fahrzeug:', 0, 0);
    $pdf->Cell(50, 10, $fahrzeugname, 0, 1);

    $pdf->Cell(50, 10, 'Verursachter Schaden:', 0, 0);
    $pdf->MultiCell(0, 10, $beschreibung, 0, 1);

    $pdf->Cell(50, 10, 'Kategorie:', 0, 0);
    $pdf->Cell(50, 10, $kategorie, 0, 1);

    $pdf->Cell(50, 10, 'Preis:', 0, 0);
    $pdf->Cell(50, 10, $preis . ' EUR', 0, 1);

    // Ausgabe des PDF-Dokuments im Browser mit dem spezifischen Dateinamen
    $filename = $schadensfall_id . '_rechnung.pdf'; // Anpassen des Dateinamens nach Bedarf
    $pdf->Output('D', $filename);

    // Verbindung schließen
    $conn->close();
} else {
    echo "Keine Schadensfälle gefunden.";
}
?>
