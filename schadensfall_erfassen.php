<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Schaden melden</title>
<!-- Link zu Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5f5;
  }
  .balken {
    background-color: darkred;
    color: white;
    padding: 10px 0;
    font-weight: bold;
    font-size: 24px;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-bottom: 3px solid #9e0000;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .balken .logo {
    margin-right: 10px;
  }
  .premium-balken {
    background-color: darkred;
    color: white;
    padding: 10px 0;
    font-weight: bold;
    font-size: 20px;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-bottom: 50px solid darkred;
    margin-bottom: 0px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
  }
  .formular-container {
    background-image: url('https://autovermietung.adac.de/_ipx/w_3072&f_png&q_50&fit_cover/cms/var/site/storage/images/_aliases/background-image-wide-x4-webp/3/8/9/0/330983-3-ger-DE/sixt-drei-autos-erweitert.webp');
    background-size: cover;
    background-position: center;
    color: white;
    padding: 20px 0;
    text-align: center;
    min-height: 60vh; /* Ändert die Höhe der Containerklasse auf die Höhe des Bildschirms */
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .overlay {
    background-color: rgba(0, 0, 0, 0.5);
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  }
  .formular {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 15px;
    border-radius: 10px;
    max-width: 300px; /* Weißen Balken schmaler machen */
    margin: 0 auto;
    text-align: left;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  }
  .formular h2 {
    margin-bottom: 15px;
    color: darkred;
    text-align: center;
    font-size: 20px;
  }
  .formular input[type="text"],
  .formular textarea,
  .formular select {
    width: calc(100% - 20px);
    margin-bottom: 10px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s ease;
  }
  .formular textarea {
    resize: none;
    min-height: 80px;
    max-height: 150px;
    overflow-y: auto;
  }
  .formular input[type="text"]:focus,
  .formular textarea:focus,
  .formular select:focus {
    border-color: darkred;
  }
  .formular select {
    width: 100%;
  }
  .formular input[type="submit"] {
    background-color: darkred;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: block;
    margin: 0 auto;
  }
  .formular input[type="submit"]:hover {
    background-color: #9e0000;
  }
  .menu-button {
    position: fixed;
    top: 5px;
    right: 5px;
    cursor: pointer;
    z-index: 10000;
    background-color: white;
    padding: 8px;
    border-radius: 5px;
  }
  .menu-button button {
    background-color: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
  }
  .menu-icon {
    width: 25px;
    height: 3px;
    background-color: darkred;
    margin-bottom: 5px;
    transition: background-color 0.3s ease;
  }
  .menu-icon:last-child {
    margin-bottom: 0;
  }
  .menu-button.open .menu-icon:nth-child(1) {
    transform: translateY(7px) rotate(45deg);
  }
  .menu-button.open .menu-icon:nth-child(2) {
    opacity: 0;
  }
  .menu-button.open .menu-icon:nth-child(3) {
    transform: translateY(-7px) rotate(-45deg);
  }
  .slide-menu {
    position: fixed;
    top: 0;
    right: 0;
    width: 200px;
    height: 100%;
    background-color: darkred;
    color: white;
    padding: 15px;
    transition: transform 0.3s ease;
    transform: translateX(100%);
    z-index: 9999;
  }
  .slide-menu.open {
    transform: translateX(0);
  }
  .slide-menu ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  .slide-menu ul li {
    margin-bottom: 8px;
  }
  .slide-menu ul li a {
    color: white;
    text-decoration: none;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    display: block;
    padding: 8px 0;
    margin-left: 20px;
    position: relative;
  }
  .slide-menu ul li a.active {
    font-weight: bold;
  }
  .slide-menu ul li a.active::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    background-color: white;
    bottom: 0;
    left: 0;
  }
  .additional-text-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 20px;
    padding: 0 10px;
  }
  .additional-text {
    font-size: 14px; /* Schriftgröße reduzieren, um Platz zu sparen */
    font-weight: bold;
    text-align: center;
  }
  .rechnung-container {
    margin: 20px auto;
    padding: 20px;
    max-width: 800px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  .rechnung-container h2 {
    text-align: center;
    color: darkred;
    margin-bottom: 20px;
  }
  .success-message {
    text-align: center;
    color: black; /* Textfarbe schwarz setzen */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Schriftart festlegen */
    font-size: 20px; /* Schriftgröße anpassen */
    margin-bottom: 20px;
  }
  .rechnung-container table {
    width: 100%;
    border-collapse: collapse;
  }
  .rechnung-container table th,
  .rechnung-container table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
  }
  .rechnung-container table th {
    background-color: darkred;
    color: white;
  }
  .rechnung-container table td {
    color: black; /* Textfarbe der Zellen schwarz setzen */
  }
</style>
</head>
<body>

<div class="balken">
  <div class="logo">
    <img src="lib/bild1.png.jpeg" width="80" height="80">
  </div>
  <div>Vertrauen, wenn's drauf ankommt</div>
</div>
<div class="additional-text-container">
  <div class="additional-text">Weltweit zuverlässig <i class="fas fa-globe"></i><br>2000+ SwiftDrive-Stationen in 105 Ländern</div>
  <div class="additional-text">Vertrauen und Qualität <i class="fas fa-check-circle"></i><br>Höchste Sicherheits- und Qualitätsstandards</div>
  <div class="additional-text">Immer für Sie da <i class="fas fa-headset"></i><br>24/7 Kundenservice und Unterstützung</div>
</div>
<div class="formular-container">
  <div class="overlay">
    <div class="formular">
    <form action="rechnung.php" method="post" class="formular">
    <!-- Formularfelder hier -->
    <input type="submit" value="PDF ausdrucken">
</form>
      <!-- Ihr PHP-Formular-Code kommt hier hin -->
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

      // Abrufen der Fahrzeug-ID und des Typs
      $fahrzeug_id = isset($_POST['fahrzeug_id']) ? $_POST['fahrzeug_id'] : '';
      $fahrzeug_typ = isset($_POST['fahrzeug_typ']) ? $_POST['fahrzeug_typ'] : ''; // economy, standard, oder premium

      // SQL-Abfrage zur Suche des Fahrzeugs anhand der ID
      $sql = "SELECT * FROM fahrzeugliste WHERE id = ?";
      if ($stmt = $conn->prepare($sql)) {
          $stmt->bind_param("i", $fahrzeug_id);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "ID: " . $row["id"] . " - Fahrzeug: " . $row["fahrzeugname"] . "<br>";
              }
          } else {
              echo "";
          }

          // Statement schließen
          $stmt->close();
      } else {
          echo "Fehler bei der Vorbereitung der SQL-Anweisung: " . $conn->error;
          error_log("Fehler bei der Vorbereitung der SQL-Anweisung: " . $conn->error);
      }

      // Formulardaten abrufen und isset() verwenden, um sicherzustellen, dass die Werte vorhanden sind
      $fahrzeug = isset($_POST['fahrzeug']) ? $_POST['fahrzeug'] : '';
      $schadensarten = isset($_POST['schadensart']) ? $_POST['schadensart'] : [];
      $fahrzeugkategorie = isset($_POST['kategorie']) ? $_POST['kategorie'] : '';

      // Array der Schadenarten in einen String umwandeln
      $schadensarten_str = implode(", ", $schadensarten);

      // SQL-Abfrage zum Einfügen der Daten in die Tabelle vorbereiten
      $sql = "INSERT INTO schadensfaelle (fahrzeug, beschreibung, kategorie) VALUES (?, ?, ?)";
      if ($stmt = $conn->prepare($sql)) {
          $stmt->bind_param("sss", $fahrzeug, $schadensarten_str, $fahrzeugkategorie);

          // Überprüfen, ob das Einfügen erfolgreich war
          if ($stmt->execute()) {
              echo "<div class='success-message'>Schadensfall erfolgreich eingetragen!</div>";
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

      // Preisliste abrufen und Rechnung generieren
      $gesamtpreis = 0;
      echo "<div class='rechnung-container'>";
      echo "<h2>Rechnung</h2>";
      echo "<table>
      <tr>
          <th>Schadenart</th>
          <th>Preis</th>
      </tr>";

      foreach ($schadensarten as $schadenart) {
          // Abfrage zur Preisermittlung basierend auf Kategorie und Beschreibung
          $sql = "SELECT preis FROM schadenspreise WHERE beschreibung = ? AND kategorie = ?";
          if ($stmt = $conn->prepare($sql)) {
              // Debug: Display the values being bound
              echo "<!-- Debug: Schadenart = '$schadenart', Fahrzeugkategorie = '$fahrzeugkategorie' -->";

              $stmt->bind_param("ss", $schadenart, $fahrzeugkategorie);
              $stmt->execute();
              $result = $stmt->get_result();

              // Debug: Display the number of rows returned
              echo "<!-- Debug: Number of rows returned = " . $result->num_rows . " -->";

              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr><td>" . $schadenart . "</td><td>" . $row['preis'] . " EUR</td></tr>";
                      $gesamtpreis += $row['preis'];
                  }
              } else {
                  echo "<tr><td>" . $schadenart . "</td><td>Preis nicht gefunden</td></tr>";
              }

              $stmt->close();
          } else {
              echo "Fehler bei der Vorbereitung der SQL-Anweisung: " . $conn->error;
              error_log("Fehler bei der Vorbereitung der SQL-Anweisung: " . $conn->error);
          }
      }

      echo "<tr><td><strong>Gesamt</strong></td><td><strong>" . $gesamtpreis . " EUR</strong></td></tr>";
      echo "</table>";

      // Gesamtpreis in die Datenbank speichern
      $sql_update = "UPDATE schadensfaelle SET preis = ? WHERE fahrzeug = ? AND beschreibung = ?";
      if ($stmt = $conn->prepare($sql_update)) {
          $stmt->bind_param("dss", $gesamtpreis, $fahrzeug, $schadensarten_str);
          if ($stmt->execute()) {
              echo "Gesamtpreis erfolgreich in die Datenbank gespeichert.";
          } else {
              echo "Fehler beim Speichern des Gesamtpreises in die Datenbank: " . $stmt->error;
              error_log("Fehler beim Speichern des Gesamtpreises in die Datenbank: " . $stmt->error);
          }
          $stmt->close();
      } else {
          echo "Fehler bei der Vorbereitung der SQL-Anweisung: " . $conn->error;
          error_log("Fehler bei der Vorbereitung der SQL-Anweisung: " . $conn->error);
      }

      // Verbindung zur Datenbank schließen
      $conn->close();
      echo "</div>";
      ?>
    </div>
  </div>
</div>
</body>
</html>
