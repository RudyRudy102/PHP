<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Strona startowa</title>
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
        .content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        a {
            display: block;
            margin: 10px 0;
            padding: 8px 12px;
            color: #3498db;
            text-decoration: none;
            border-left: 3px solid #3498db;
            transition: all 0.3s ease;
        }
        a:hover {
            background-color: #eaf2f8;
            color: #2980b9;
            border-left: 6px solid #2980b9;
            transform: translateX(5px);
        }
        .warning {
            color: #e74c3c;
            font-style: italic;
        }
        .header {
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 18px;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <h1>Menu aplikacji</h1>
    
    <div class="content">
        <div class="header">PB Start</div>
        
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="warning">1. Link do UW</a>
        <a href="https://www.uw.edu.pl">Prawdziwy Link do UW</a>
        <a href="plik678.php">2. Link do dodatkowego mojego pliku</a>
        <a href="w1.php">3. Link do 1 zajęć</a>
        <a href="policz1.php">4. Link do 1 kalkulatora</a>
        <a href="policz2.php">5. Link do 2 kalkulatora</a>
        <a href="kalkulator3.php">6. Link do 3 kalkulatora</a>
        <a href="formularz1.php">7. Link do formularza danych osobowych nr 4</a>
        <a href="formularz5arch.php">8. Link do formularza danych osobowych z numerem PESEL</a>
        <a href="formularz5.php">9. Link do fancy formularza danych osobowych z numerem PESEL</a>
    </div>
</body>
</html>
