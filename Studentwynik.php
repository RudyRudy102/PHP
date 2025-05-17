<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Wynik dodania studenta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h2 {
            color: #2c3e50;
            text-align: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .result {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #3498db;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Wynik dodania nowego studenta</h2>
    <div class="result">
        <?php
        $Sn = $_POST["Snazwisko"];
        $Si = $_POST["Simie"];
        $Sindeks = $_POST["Sindeks"];
        $SdataUR = $_POST["SdataUR"];

        // Sprawdzenie czy wszystkie pola są wypełnione
        if (empty($Sn) || empty($Si) || empty($Sindeks) || empty($SdataUR)) {
            echo "<p class='error'>Błąd: Wszystkie pola muszą być wypełnione!</p>";
        } else {
            // Połączenie z bazą danych
            $mysqli = mysqli_connect("193.0.78.160", "s24", "s24.ABCD", "s24Patryk");
            
            // Sprawdzenie połączenia
            if (mysqli_connect_errno()) {
                echo "<p class='error'>Błąd połączenia z bazą danych: " . mysqli_connect_error() . "</p>";
            } else {
                // Zabezpieczenie danych przed SQL Injection
                $Sn = mysqli_real_escape_string($mysqli, $Sn);
                $Si = mysqli_real_escape_string($mysqli, $Si);
                $Sindeks = mysqli_real_escape_string($mysqli, $Sindeks);
                $SdataUR = mysqli_real_escape_string($mysqli, $SdataUR);
                
                $sql = "INSERT INTO studenci (Snazwisko, Simie, Sindeks, SdataUR) VALUES ('$Sn', '$Si', '$Sindeks', '$SdataUR')";
                
                if (mysqli_query($mysqli, $sql)) {
                    echo "<p class='success'>Student został pomyślnie dodany do bazy danych!</p>";
                    
                    echo "<table>
                            <tr>
                                <th>Dane</th>
                                <th>Wartość</th>
                            </tr>
                            <tr>
                                <td>Nazwisko:</td>
                                <td>$Sn</td>
                            </tr>
                            <tr>
                                <td>Imię:</td>
                                <td>$Si</td>
                            </tr>
                            <tr>
                                <td>Indeks:</td>
                                <td>$Sindeks</td>
                            </tr>
                            <tr>
                                <td>Data urodzenia:</td>
                                <td>$SdataUR</td>
                            </tr>
                          </table>";
                } else {
                    echo "<p class='error'>Błąd: " . mysqli_error($mysqli) . "</p>";
                }
                
                mysqli_close($mysqli);
            }
        }
        ?>
    </div>
    <a href="Zajęcia5.php">Powrót do formularza</a>
    <br>
    <a href="index.php">Przejście do głównego menu</a>
</body>
</html>
