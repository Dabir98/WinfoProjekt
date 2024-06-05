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

                // Formular zur Schadensfallerfassung anzeigen
                echo "
                <html lang='de'>
                <head>
                    <meta charset='UTF-8'>
                    <title>Schadensfall erfassen</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 0;
                            background-color: darkred;
                        }
                        .container {
                            position: relative;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                            overflow: hidden;
                        }
                        .checkbox {
                            position: absolute;
                            transform: translate(-50%, -50%);
                            width: 20px;
                            height: 20px;
                            appearance: none;
                            border: 2px solid white;
                            border-radius: 50%;
                            cursor: pointer;
                        }
                        .checkbox:checked {
                            background-color: darkred;
                        }
                        #front-right { top: 18vh; left: 11vw; }
                        #front-left { top: 42vh; left: 11vw; }
                        #back-left { bottom: 55vh; left: 35vw; }
                        #back-right { top: 18.5vh; left: 35vw; }
                        #middle-top { top: 18vh; left: 25%; }
                        #middle-bottom { bottom: 54.5vh; left: 25%; }
                        #middle-center { top: 30vh; left: 25%; }
                        img {
                            transform: scale(2.5);
                            position: absolute;
                            top: 20vh;
                            left: 15vw;
                        }
                    </style>
                </head>
                <body>
                    <h1>Schadensfall erfassen</h1>
                    <form action='schadensfall_erfassen.php' method='post' id='schadensfallForm'>
                        <label for='fahrzeug'>Fahrzeug:</label>
                        <input type='text' id='fahrzeug' name='fahrzeug' value='$fahrzeugname' required><br><br>
                        
                        <label for='schadensart'>Schadensart:</label><br>
                        <div class='container'>
                            <img src='https://img.freepik.com/psd-premium/isolierter-realistischer-matte-weisser-moderner-eleganter-grand-super-sportwagen-von-oben-aus_16145-22201.jpg' alt='Bild' width='300' height='200'>
                            <input type='checkbox' class='checkbox' id='front-right' name='schadensart[]' value='Fahrzeugfront rechts'>
                            <label for='front-right'></label><br>
                            
                            <input type='checkbox' class='checkbox' id='front-left' name='schadensart[]' value='Fahrzeugfront links'>
                            <label for='front-left'></label><br>
                            
                            <input type='checkbox' class='checkbox' id='back-left' name='schadensart[]' value='Fahrzeugheck links'>
                            <label for='back-left'></label><br>
                            
                            <input type='checkbox' class='checkbox' id='back-right' name='schadensart[]' value='Fahrzeugheck rechts'>
                            <label for='back-right'></label><br>
                            
                            <input type='checkbox' class='checkbox' id='middle-top' name='schadensart[]' value='Fahrzeug rechts mittig'>
                            <label for='middle-top'></label><br>
                            
                            <input type='checkbox' class='checkbox' id='middle-bottom' name='schadensart[]' value='Fahrzeug links mittig'>
                            <label for='middle-bottom'></label><br>
                            
                            <input type='checkbox' class='checkbox' id='middle-center' name='schadensart[]' value='Fahrzeugdach'>
                            <label for='middle-center'></label><br>
                        </div><br>

                        <input type='submit' value='Schadensfall erfassen'>
                    </form>
                </body>
                </html>";
                
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
