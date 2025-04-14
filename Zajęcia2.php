<!-- Kalkulator 1 -->
<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator 1</title>
</head>
<body>
    <h2>To jest kalkulator1</h2>
    <br><br>
    <form action="wynik1.php" method="post">
        Podaj pierwszą liczbę: <br>
        <input type="text" name="pierwszaliczba"/> <br>
        Podaj drugą liczbę: <br>
        <input type="text" name="drugaliczba"/> <br>
        <input type="submit" value="Potwierdź"/>
    </form>
    <br>
    <a href="index.php">Powrót na start</a>
</body>
</html>

<!-- Wynik kalkulatora 1 -->
<!DOCTYPE html>
<html>
<head>
    <title>Wynik - Kalkulator 1</title>
</head>
<body>
    <h2>To jest wynik z kalkulator1</h2>
    <br>
    <?php
    $z1 = $_POST["pierwszaliczba"];
    $z2 = $_POST["drugaliczba"];
    echo "Pierwsza liczba to: " . $z1 . "<br>";
    echo "Druga liczba to: " . $z2 . "<br>";
    echo "Suma liczb to: " . ($z1 + $z2) . "<br>";
    echo "Iloczyn liczb to: " . ($z1 * $z2) . "<br>";
    ?>
    <br>
    <a href="index.php">Powrót na start</a>
</body>
</html>

<!-- Kalkulator 2 -->
<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator 2</title>
</head>
<body>
    <h2>To jest kalkulator2</h2>
    <br><br>
    <form action="wynik2.php" method="post">
        Wprowadź pierwszą liczbę: <br>
        <input type="text" name="liczbapierwsza"/> <br>
        Wprowadź drugą liczbę: <br>
        <input type="text" name="liczbadruga"/> <br>
        Wprowadź trzecią liczbę: <br>
        <input type="text" name="liczbatrzecia"/> <br>
        <input type="submit" value="Zatwierdź"/>
    </form>
    <br>
    <a href="index.php">Powrót na start</a>
</body>
</html>

<!-- Wynik kalkulatora 2 -->
<!DOCTYPE html>
<html>
<head>
    <title>Wynik - Kalkulator 2</title>
</head>
<body>
    <h2>To jest wynik z kalkulator2</h2>
    <br>
    <?php
    $z1 = $_POST["liczbapierwsza"];
    $z2 = $_POST["liczbadruga"];
    $z3 = $_POST["liczbatrzecia"];
    
    echo "Wprowadzone zostały następujące liczby: ";
    echo "a=" . $z1;
    echo " b=" . $z2;
    echo " c=" . $z3;
    echo "<br><br>";
    
    echo "Suma liczb a i b wynosi: " . ($z1 + $z2) . "<br>";
    echo "Różnica liczb a i b wynosi: " . ($z1 - $z2) . "<br>";
    echo "Iloczyn liczb b i c wynosi: " . ($z2 * $z3) . "<br>";
    echo "Działanie: (a + b)/c wynosi: " . (($z1 + $z2) / $z3) . "<br>";
    ?>
    <br>
    <a href="index.php">Powrót na start</a>
</body>
</html>

<!-- Formularz z polami wyboru -->
<!DOCTYPE html>
<html>
<head>
    <title>Formularz</title>
</head>
<body>
    <!-- Pole typu RADIO -->
    <p>Podaj swoją płeć:</p>
    <input type="radio" name="Płeć" value="Kobieta">Kobieta
    <input type="radio" name="Płeć" value="Mężczyzna">Mężczyzna

    <!-- Pole typu RADIO -->
    <p>Ile masz lat?</p>
    <input type="radio" name="Wiek" value="mniej niż 15">mniej niż 15<br>
    <input type="radio" name="Wiek" value="15-19">15-19<br>
    <input type="radio" name="Wiek" value="20-29">20-29<br>
    <input type="radio" name="Wiek" value="30-39">30-39<br>
    <input type="radio" name="Wiek" value="40-60">40-60<br>
    <input type="radio" name="Wiek" value="więcej niż 60">więcej niż 60

    <!-- Pole typu CHECKBOX -->
    <p>Jaką lubisz muzykę (możesz zaznaczyć więcej możliwości)?</p>
    <input type="checkbox" name="Muzyka" value="Rock">Rock<br>
    <input type="checkbox" name="Muzyka" value="Heavy Metal">Heavy Metal<br>
    <input type="checkbox" name="Muzyka" value="Pop">Pop<br>
    <input type="checkbox" name="Muzyka" value="Techno">Techno<br>
    <input type="checkbox" name="Muzyka" value="Muzyka poważna">Muzyka poważna<br>
    <input type="checkbox" name="Muzyka" value="Inna">Inna (podaj jaka):
    <input name="Muzyka">

    <!-- Lista rozwijalna (typ podstawowy) -->
    <p>Jakiej przeglądarki internetowej używasz?</p>
    <select name="Przeglądarka">
        <option selected>Chrome</option>
        <option>Opera</option>
        <option>Firefox</option>
        <option>Edge</option>
        <option>Inna</option>
    </select>

    <!-- Lista rozwijalna (typ rozszerzony) -->
    <p>Jakie znasz systemy operacyjne (możesz wybrać kilka opcji trzymając klawisz Ctrl)?</p>
    <select name="System operacyjny" multiple size="3">
        <option selected>Windows</option>
        <option>DOS</option>
        <option>Linux</option>
        <option>Inny</option>
    </select>
</body>
</html>