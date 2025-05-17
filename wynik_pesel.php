<?php
// Funkcje do weryfikacji i analizy PESEL

function sprawdzPesel($pesel) {
    // Sprawdzenie długości
    if (strlen($pesel) !== 11) {
        return false;
    }
    
    // Sprawdzenie czy zawiera tylko cyfry
    if (!ctype_digit($pesel)) {
        return false;
    }
    
    // Obliczenie cyfry kontrolnej
    $wagi = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
    $suma = 0;
    
    for ($i = 0; $i < 10; $i++) {
        $suma += $wagi[$i] * $pesel[$i];
    }
    
    $suma %= 10;
    $cyfraKontrolna = (10 - $suma) % 10;
    
    // Weryfikacja cyfry kontrolnej
    return $cyfraKontrolna == $pesel[10];
}

function odczytajDateUrodzenia($pesel) {
    $rok = substr($pesel, 0, 2);
    $miesiac = substr($pesel, 2, 2);
    $dzien = substr($pesel, 4, 2);
    
    // Określenie pełnego roku na podstawie kodu miesiąca
    $stulecie = 1900;
    
    if ($miesiac >= 21 && $miesiac <= 32) {
        $stulecie = 2000;
        $miesiac -= 20;
    } elseif ($miesiac >= 41 && $miesiac <= 52) {
        $stulecie = 2100;
        $miesiac -= 40;
    } elseif ($miesiac >= 61 && $miesiac <= 72) {
        $stulecie = 2200;
        $miesiac -= 60;
    } elseif ($miesiac >= 81 && $miesiac <= 92) {
        $stulecie = 1800;
        $miesiac -= 80;
    }
    
    $rok = $stulecie + intval($rok);
    
    return sprintf("%02d.%02d.%04d", intval($dzien), intval($miesiac), $rok);
}

function odczytajPlec($pesel) {
    $cyfraPlci = $pesel[9];
    return ($cyfraPlci % 2 == 0) ? "kobieta" : "mężczyzna";
}

// Przetwarzanie danych z formularza
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imie = isset($_POST["imie"]) ? htmlspecialchars($_POST["imie"]) : "";
    $nazwisko = isset($_POST["nazwisko"]) ? htmlspecialchars($_POST["nazwisko"]) : "";
    $pesel = isset($_POST["pesel"]) ? $_POST["pesel"] : "";
    
    $czyPoprawny = sprawdzPesel($pesel);
    $dataUrodzenia = $czyPoprawny ? odczytajDateUrodzenia($pesel) : "Nie można określić (niepoprawny PESEL)";
    $plec = $czyPoprawny ? odczytajPlec($pesel) : "Nie można określić (niepoprawny PESEL)";
} else {
    header("Location: Zajęcia4.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wynik weryfikacji PESEL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .result {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .valid {
            color: green;
            font-weight: bold;
        }
        .invalid {
            color: red;
            font-weight: bold;
        }
        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Wynik weryfikacji PESEL</h1>
    
    <div class="result">
        <h2>Kto to jest</h2>
        <p><strong>Imię i nazwisko:</strong> <?php echo $imie . " " . $nazwisko; ?></p>
        <p><strong>Płeć:</strong> <?php echo $plec; ?></p>
    </div>
    
    <div class="result">
        <h2>Kiedy się urodził</h2>
        <p><strong>Data urodzenia:</strong> <?php echo $dataUrodzenia; ?></p>
    </div>
    
    <div class="result">
        <h2>Czy PESEL jest poprawny</h2>
        <p>PESEL: <?php echo $pesel; ?></p>
        <p class="<?php echo $czyPoprawny ? 'valid' : 'invalid'; ?>">
            <?php echo $czyPoprawny ? "PESEL jest poprawny" : "PESEL jest niepoprawny"; ?>
        </p>
    </div>
    
    <a href="Zajęcia4.php" class="back">Powrót do formularza</a>
</body>
</html>
