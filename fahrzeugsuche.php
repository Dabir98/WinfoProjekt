<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Formulardaten abrufen und validieren
    $fahrzeugid = isset($_POST['fahrzeugid']) ? intval($_POST['fahrzeugid']) : 0;

    if ($fahrzeugid <= 0) {
        echo "<script>alert('Ungültige Fahrzeug-ID.');</script>";
    } else {
        // SQL-Abfrage zur Suche des Fahrzeugs anhand der ID
        $sql = "SELECT * FROM fahrzeugliste WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $fahrzeugid);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $fahrzeugname = htmlspecialchars($row["fahrzeugname"], ENT_QUOTES, 'UTF-8');
                $fahrzeugkategorie = htmlspecialchars($row["kategorie"], ENT_QUOTES, 'UTF-8');

                // Formular zur Schadensfallerfassung anzeigen
                ?>
                <!DOCTYPE html>
                <html lang="de">
                <head>
                    <meta charset="UTF-8">
                    <title>Schadensfall erfassen</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 0;
                            font-family: Arial, sans-serif;
                            background-color: darkred;
                            background-image: url('https://autovermietung.adac.de/_ipx/w_3072&f_png&q_50&fit_cover/cms/var/site/storage/images/_aliases/background-image-wide-x4-webp/3/8/9/0/330983-3-ger-DE/sixt-drei-autos-erweitert.webp');
                            background-size: cover;
                            background-position: center;
                            background-repeat: no-repeat;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            flex-direction: column;
                            min-height: 100vh;
                        }
                        .balken {
                            background-color: darkred;
                            color: white;
                            padding: 5px 10px;
                            font-weight: bold;
                            font-size: 18px;
                            text-align: center;
                            text-transform: uppercase;
                            letter-spacing: 2px;
                            border-bottom: 2px solid #9e0000;
                            margin-bottom: 10px;
                            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
                            width: 100%;
                            position: absolute;
                            top: 0;
                            left: 0;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            height: 60px; /* Höhe des Balkens */
                        }
                        .balken .logo {
                            display: flex;
                            align-items: center;
                            margin-right: 10px;
                        }
                        .balken .logo img {
                            width: auto;
                            height: 50px; /* Höhe des Logos */
                            margin-right: 5px;
                        }
                        form {
                            background-color: white;
                            padding: 30px;
                            border-radius: 30px;
                            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
                            text-align: center;
                            border: 4px solid black;
                            margin-top: 80px; /* Platz für den Balken und den Titel */
                            width: 500px; /* Breite des Formulars */
                        }
                        h1 {
                            color: white;
                            margin-bottom: 10px;
                            position: absolute;
                            top: 10px;
                            width: 100%;
                            text-align: center;
                            font-size: 28px;
                            z-index: 1000;
                        }
                        label {
                            display: block;
                            margin-bottom: 5px;
                            color: #666;
                            font-size: 18px; /* Größere Schriftgröße */
                        }
                        input[type='text'] {
                            width: calc(100% - 20px);
                            padding: 10px;
                            margin-bottom: 10px;
                            border: 1px solid #ccc;
                            border-radius: 4px;
                            box-sizing: border-box;
                            text-align: center;
                            font-size: 16px; /* Größere Schriftgröße */
                        }
                        .container {
                            position: relative;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            flex-wrap: wrap;
                            margin-bottom: 20px;
                        }
                        .checkbox {
                            position: absolute;
                            appearance: none;
                            border: 3px solid darkred;
                            border-radius: 50%;
                            cursor: pointer;
                            z-index: 1;
                            width: 25px;
                            height: 25px;
                            transition: background-color 0.5s ease;
                        }
                        .checkbox:checked {
                            background-color: darkred;
                        }
                        img {
                            width: 100%;
                            max-width: 400px;
                            height: auto;
                            margin-bottom: 10px;
                            display: block;
                            margin-left: auto;
                            margin-right: auto;
                            position: relative;
                            z-index: 0;
                        }
                        .instructions {
                            font-size: 14px;
                            font-weight: bold;
                            color: #333;
                            margin-bottom: 10px;
                        }
                        input[type='submit'] {
                            padding: 15px 60px;
                            background-color: darkred;
                            color: #fff;
                            border: none;
                            border-radius: 10px;
                            cursor: pointer;
                            transition: background-color 0.5s ease;
                            font-size: 16px; /* Größere Schriftgröße */
                        }
                        input[type='submit']:hover {
                            background-color: red;
                        }
                    </style>
                </head>
                <body>
                    <div class="balken">
                        <div class="logo">
                            <img src="lib/bild1.png.jpeg" alt="Bild">
                        </div>
                        Schadensfall erfassen
                    </div>
                    <form action="schadensfall_erfassen.php" method="post" id="schadensfallForm">
                        <label for="fahrzeug">Fahrzeug:</label>
                        <input type="text" id="fahrzeug" name="fahrzeug" value="<?php echo $fahrzeugname; ?>" required><br><br>
                        <input type="text" id="kategorie" name="kategorie" value="<?php echo $fahrzeugkategorie; ?>" required><br><br>
                        <label for="schadensart">Schadensart:</label><br>
                        <div class="container">
                            <img src="https://img.freepik.com/psd-premium/isolierter-realistischer-matte-weisser-moderner-eleganter-grand-super-sportwagen-von-oben-aus_16145-22201.jpg" alt="Bild" width="300" height="200">
                            <input type="checkbox" class="checkbox" id="front-right" name="schadensart[]" value="Fahrzeugfront rechts" style="top: 20%; left: 19%;">
                            <label for="front-right"></label><br>
                            <input type="checkbox" class="checkbox" id="front-left" name="schadensart[]" value="Fahrzeugfront links" style="top: 65%; left: 19%;">
                            <label for="front-left"></label><br>
                            <input type="checkbox" class="checkbox" id="back-left" name="schadensart[]" value="Fahrzeugheck links" style="top: 65%; right: 19%;">
                            <label for="back-left"></label><br>
                            <input type="checkbox" class="checkbox" id="back-right" name="schadensart[]" value="Fahrzeugheck rechts" style="top:20%; right: 19%;">
                            <label for="back-right"></label><br><br>
                            <input type="checkbox" class="checkbox" id="middle-top" name="schadensart[]" value="Fahrzeugheck mittig" style="top: 42%; right: 14%;">
                            <label for="middle-top"></label><br>
                            <input type="checkbox" class="checkbox" id="middle-bottom" name="schadensart[]" value="Fahrzeugfront mittig" style="top: 42%; left: 15%;">
                            <label for="middle-bottom"></label><br>
                            <input type="checkbox" class="checkbox" id="middle-center" name="schadensart[]" value="Fahrzeugdach" style="top: 42%; left:52%;">
                            <label for="middle-center"></label><br>
                        </div><br>
                        <input type="submit" value="Schadensfall erfassen">
                    </form>
                </body>
                </html>
                <?php
            } else {
                echo "<script>alert('Kein Fahrzeug mit dieser ID gefunden.');</script>";
            }
            // Statement schließen
            $stmt->close();
        } else {
            echo "<script>alert('Fehler bei der Vorbereitung der SQL-Anweisung: " . $conn->error . "');</script>";
            error_log("Fehler bei der Vorbereitung der SQL-Anweisung: " . $conn->error);
        }
    }

    // Verbindung zur Datenbank schließen
    $conn->close();
}
?>
