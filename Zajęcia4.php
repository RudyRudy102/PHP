Czym jest numer PESEL
Numer PESEL to jedenastocyfrowy symbol numeryczny, który pozwala na łatwą identyfikację osoby, która go posiada. Numer PESEL zawiera datę urodzenia, numer porządkowy, oznaczenie płci oraz liczbę kontrolną.



Oznaczenia

Każda z 11 cyfr w numerze PESEL ma swoje znaczenie. Można je podzielić następująco:

RRMMDDPPPPK

RR – to 2 ostanie cyfry roku urodzenia,

MM – to miesiąc urodzenia (zapoznaj się z sekcją  "Dlaczego osoby urodzone po 1999 roku mają inne oznaczenie miesiąca urodzenia", która znajduje się poniżej),

DD – to dzień urodzenia,

PPPP – to liczba porządkowa oznaczająca płeć. U kobiety ostatnia cyfra tej liczby jest parzysta (0, 2, 4, 6, 8), a u mężczyzny - nieparzysta (1, 3, 5, 7, 9),

K – to cyfra kontrolna.

Przykład: PESEL 810203PPP6K należy do kobiety, która urodziła się 3 lutego 1981 roku, a PESEL 761115PPP3K - do mężczyzny, który urodził się 15 listopada 1976 roku.



Cyfra kontrolna

W 3 prostych krokach opiszemy poniżej, w jaki sposób można obliczyć cyfrę kontrolną w numerze PESEL. Jako przykład posłuży nam numer 0207080362.

Pomnóż każdą cyfrę z numeru PESEL przez odpowiednią wagę: 1-3-7-9-1-3-7-9-1-3.
0 * 1 = 0
2 * 3 = 6 
0 * 7 = 0
7 * 9 = 63
0 * 1 = 0
8 * 3 = 24 
0 * 7 = 0
3 * 9 = 27
6 * 1 = 6
2 * 3 = 6

Dodaj do siebie otrzymane wyniki. Uwaga, jeśli w trakcie mnożenia otrzymasz liczbę dwucyfrową, należy dodać tylko ostatnią cyfrę (na przykład zamiast 63 dodaj 3).
0 + 6 + 0 + 3 + 0 + 4 + 0 + 7 +6 + 6 = 32
Odejmij uzyskany wynik od 10. Uwaga: jeśli w trakcie dodawania otrzymasz liczbę dwucyfrową, należy odjąć tylko ostatnią cyfrę (na przykład zamiast 32 odejmij 2). Cyfra, która uzyskasz, to cyfra kontrolna. 10 - 2 = 8
pełny numer PESEL: 02070803628



Kto to jest
kiedy się urodził
czy pesel jest poprawny

// Formularz i logika przetwarzania PESEL
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weryfikacja PESEL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Weryfikacja numeru PESEL</h1>
    
    <form action="wynik_pesel.php" method="post">
        <div class="form-group">
            <label for="imie">Imię:</label>
            <input type="text" id="imie" name="imie" required>
        </div>
        
        <div class="form-group">
            <label for="nazwisko">Nazwisko:</label>
            <input type="text" id="nazwisko" name="nazwisko" required>
        </div>
        
        <div class="form-group">
            <label for="pesel">PESEL:</label>
            <input type="text" id="pesel" name="pesel" required pattern="[0-9]{11}" title="PESEL musi zawierać 11 cyfr">
        </div>
        
        <button type="submit">Sprawdź</button>
    </form>
</body>
</html>





<!DOCTYPE html>
<html>
<head>
    <title>Formularz do wprowadzania danych</title>
</head>
<body>
    <h2>Formularz do wprowadzania danych</h2>
    <br><br>
    <form action="wynik5.php" method="post">
        Imię: <br> <input type="text" name="imie"/> <br>
        Nazwisko: <br> <input type="text" name="nazwisko"/> <br>
        Wiek: <br>
        <input type="text" name="pesel"/> <br>
    </form>
    <br>
    <a href="index.php">Powrót na start</a>
</body>
</html>
