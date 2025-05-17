<!--Formularz-->
<!DOCTYPE html>
<html>
<head>
    <title>Formularz do wprowadzania danych</title>
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
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
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
    </style>
</head>
<body>
    <h2>Formularz do wprowadzania danych</h2>
    <form action="wynik5.php" method="post">
        Imię: <br> <input type="text" name="imie" required/> <br>
        Nazwisko: <br> <input type="text" name="nazwisko" required/> <br>
        <br>
        PESEL: <br>
        <input type="text" name="pesel" pattern="[0-9]{11}" maxlength="11" title="PESEL musi składać się dokładnie z 11 cyfr" required/> <br><br>
        <input type="submit" value="Wyślij"/>
    </form>
    <br>
    <a href="index.php">Powrót na start</a>
</body>
</html>



<!--Wynik-->


<?php


function formatujTekst($tekst) {

    
    return mb_convert_case(mb_strtolower($tekst, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
}

function sprawdzPesel($pesel) {
    // Sprawdzanie długości i czy zawiera tylko cyfry
    if (strlen($pesel) !== 11) {
        return false;
    }
    
    if (!ctype_digit($pesel)) {
        return false;
    }
    
    // Sprawdzenie czy PESEL nie składa się z samych zer
    if ($pesel === "00000000000") {
        return false;
    }
    
    // Wyciągnięcie daty z PESEL
    $rok = substr($pesel, 0, 2);
    $miesiac = substr($pesel, 2, 2);
    $dzien = substr($pesel, 4, 2);
    
    // Określenie stulecia na podstawie miesiąca
    $stulecie = 1900;
    $realnyMiesiac = $miesiac;
    
    if ($miesiac >= 21 && $miesiac <= 32) {
        $stulecie = 2000;
        $realnyMiesiac -= 20;
    } elseif ($miesiac >= 41 && $miesiac <= 52) {
        $stulecie = 2100;
        $realnyMiesiac -= 40;
    } elseif ($miesiac >= 61 && $miesiac <= 72) {
        $stulecie = 2200;
        $realnyMiesiac -= 60;
    } elseif ($miesiac >= 81 && $miesiac <= 92) {
        $stulecie = 1800;
        $realnyMiesiac -= 80;
    }
    
    // Sprawdzenie czy miesiąc jest prawidłowy (1-12)
    if ($realnyMiesiac < 1 || $realnyMiesiac > 12) {
        return false;
    }
    
    // Sprawdzenie czy dzień jest prawidłowy dla danego miesiąca
    $pelnyRok = $stulecie + intval($rok);
    $maxDzien = 31;
    
    // Miesiące z 30 dniami
    if (in_array($realnyMiesiac, [4, 6, 9, 11])) {
        $maxDzien = 30;
    } 
    // Luty
    elseif ($realnyMiesiac == 2) {
        // Rok przestępny
        if (($pelnyRok % 4 == 0 && $pelnyRok % 100 != 0) || $pelnyRok % 400 == 0) {
            $maxDzien = 29;
        } else {
            $maxDzien = 28;
        }
    }
    
    if (intval($dzien) < 1 || intval($dzien) > $maxDzien) {
        return false;
    }
    
    // Sprawdzenie cyfry kontrolnej
    $wagi = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
    $suma = 0;
    
    for ($i = 0; $i < 10; $i++) {
        $suma += $wagi[$i] * $pesel[$i];
    }
    
    $suma %= 10;
    $cyfraKontrolna = (10 - $suma) % 10;
    
    return $cyfraKontrolna == $pesel[10];
}

function getNazwaMiesiaca($numerMiesiaca) {
    $miesiace = [
        1 => 'Stycznia', 2 => 'Lutego', 3 => 'Marca', 4 => 'Kwietnia', 
        5 => 'Maja', 6 => 'Czerwca', 7 => 'Lipca', 8 => 'Sierpnia',
        9 => 'Września', 10 => 'Października', 11 => 'Listopada', 12 => 'Grudnia'
    ];
    return $miesiace[$numerMiesiaca] ?? 'Nieznany';
}

function odczytajDateUrodzenia($pesel) {
    $rok = substr($pesel, 0, 2);
    $miesiac = substr($pesel, 2, 2);
    $dzien = substr($pesel, 4, 2);
    
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
    $miesiacInt = intval($miesiac);
    $dzienInt = intval($dzien);
    
    $dataPisemna = sprintf("%d %s %d", $dzienInt, getNazwaMiesiaca($miesiacInt), $rok);
    $dataFormatowana = sprintf("%02d.%02d.%04d", $dzienInt, $miesiacInt, $rok);
    
    return ['formatowana' => $dataFormatowana, 'pisemna' => $dataPisemna];
}

function odczytajPlec($pesel) {
    $cyfraPlci = $pesel[9];
    return ($cyfraPlci % 2 == 0) ? "kobieta" : "mężczyzna";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imie = isset($_POST["imie"]) ? formatujTekst(htmlspecialchars($_POST["imie"])) : "";
    $nazwisko = isset($_POST["nazwisko"]) ? formatujTekst(htmlspecialchars($_POST["nazwisko"])) : "";
    $pesel = isset($_POST["pesel"]) ? $_POST["pesel"] : "";
    
    $czyPoprawny = sprawdzPesel($pesel);
    $dataUrodzenia = $czyPoprawny ? odczytajDateUrodzenia($pesel) : "Nie można określić (niepoprawny PESEL)";
    $plec = $czyPoprawny ? odczytajPlec($pesel) : "Nie można określić (niepoprawny PESEL)";
} else {
    header("Location: formularz5.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oto twoje dane</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .result {
            background-color: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .valid {
            color: green;
            font-weight: bold;
        }
        .invalid {
            color: red;
            font-weight: bold;
        }
        strong {
            color: #2c3e50;
        }
        .back {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }
        .back:hover {
            background-color: #2980b9;
        }
        .gender-info {
            text-align: center;
            font-weight: bold;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
        }
        .gender-female {
            background-color: #ffcce6;
            color: #cc0066;
        }
        .gender-male {
            background-color: #cce6ff;
            color: #0066cc;
        }
        .data-pisemna {
            font-style: italic;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Oto twoje dane</h1>
    
    <div class="result">
        <p><strong>Imię i nazwisko:</strong> <?php echo $imie . " " . $nazwisko; ?></p>
        <p><strong>Płeć:</strong> <?php echo $plec; ?></p>
        <?php if ($czyPoprawny): ?>
            <div class="gender-info <?php echo $plec === 'kobieta' ? 'gender-female' : 'gender-male'; ?>">
                <?php echo $imie . ' ' . $nazwisko . ' jest ' . ($plec === 'kobieta' ? 'kobietą' : 'mężczyzną'); ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="result">
        <p><strong>Data urodzenia:</strong> <?php echo $czyPoprawny ? $dataUrodzenia['formatowana'] : $dataUrodzenia; ?></p>
        <?php if ($czyPoprawny): ?>
            <p class="data-pisemna"><strong>Słownie:</strong> <?php echo $dataUrodzenia['pisemna']; ?></p>
        <?php endif; ?>
    </div>
    
    <div class="result">
        <p><strong>Numer PESEL:</strong> <?php echo $pesel; ?></p>
        <p class="<?php echo $czyPoprawny ? 'valid' : 'invalid'; ?>">
            <?php echo $czyPoprawny ? "PESEL jest poprawny" : "PESEL jest niepoprawny"; ?>
        </p>
    </div>
    
    <a href="formularz5.php" class="back">Powrót do formularza</a>
</body>
</html>


<!-----Index.php----->
<html lang="pl">
<head>
 <meta charset="utf-8">
</head>
<body>
PB Start
<br>
<br>
<a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">1. Link do UW</a>
<br>
<a href="https://www.uw.edu.pl">Prawdziwy Link do UW</a>
<br>
<a href="plik678.php">2. Link do dodatkowego mojego pliku </a>
<br>
<a href="w1.php">3. Link do 1 zajęć</a>
<br>
<a href="policz1.php">4. Link do 1 kalkulatora</a>
<br>
<a href="policz2.php">5. Link do 2 kalkulatora</a>
<br>
<a href="kalkulator3.php">6. Link do 3 kalkulatora</a>
<br>
<a href="formularz1.php">7. Link do formularza danych osobowych nr 4</a>
<br>
<a href="formularz5arch.php">8. Link do formularza danych osobowych z numerem PESEL</a>
<br>
<a href="formularz5.php">8. Link do fancy formularza danych osobowych z numerem PESEL</a>
</body>
</html>