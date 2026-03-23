<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Baza danych o pracownikach firm</title>
    <link rel="stylesheet" href="firma.css">
</head>
<style>
/* Główne ustawienia strony */
body {
    font-family: Tahoma, sans-serif;
    margin: 0;
    padding: 0;
}

/* Baner i Stopka - zgodnie z rysunkiem */
#baner, #stopka {
    background-color: #006633;
    color: white;
    text-align: center;
    padding: 15px;
}

#baner h1 {
    margin: 0;
    letter-spacing: 2px;
}

/* Układ paneli */
#kontener-glowny {
    display: flex;
    min-height: 400px;
}

#lewy, #prawy {
    width: 50%;
    padding: 20px;
    box-sizing: border-box;
}

/* Stylizacja paragrafów wg wytycznych */
p {
    text-align: center;
    font-family: Tahoma;
    color: #003300;
    font-size: 20px;
    font-weight: bold;
}

/* Nagłówki sekcji (h2) */
h2 {
    text-align: center;
    color: #003300;
}

/* Tabela w lewym panelu */
table {
    width: 90%;
    margin: 0 auto;
    border-collapse: collapse;
}

th {
    background-color: #006633;
    color: white;
    padding: 10px;
    border: 1px solid #003300;
}

td {
    border: 1px solid #003300;
    padding: 8px;
    text-align: center;
}

/* Elementy w stopce */
#stopka img {
    height: 40px;
    vertical-align: middle;
    margin: 0 20px;
}

#stopka span {
    font-size: 18px;
    font-weight: bold;
}

/* Linia pozioma */
hr {
    border: 1px solid #006633;
    margin: 20px 0;
}
</style>
<body>

    <header id="baner">
        <h1>BAZA DANYCH O PRACOWNIKACH</h1>
    </header>

    <div id="kontener-glowny">
        <section id="lewy">
            <h2>Informatycy poniżej roku 1975</h2>
            <table>
                <tr>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Pensja</th>
                </tr>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "firma"); // Zmień dane jeśli trzeba
                if ($conn) {
                    // Skrypt nr 1: Pobieranie informatyków urodzonych przed 1975
                    $query1 = "SELECT imie, nazwisko, pensja FROM pracownicy WHERE stanowisko = 'informatyk' AND rok_urodzenia < 1975";
                    $result1 = mysqli_query($conn, $query1);
                    while($row = mysqli_fetch_assoc($result1)) {
                        echo "<tr><td>".$row['imie']."</td><td>".$row['nazwisko']."</td><td>".$row['pensja']."</td></tr>";
                    }
                }
                ?>
            </table>
        </section>

        <section id="prawy">
            <h2>Sekretarki firmy "Omega"</h2>
            <ol>
                <?php
                if ($conn) {
                    // Skrypt nr 2: Lista sekretarek firmy Omega
                    $query2 = "SELECT imie, nazwisko FROM pracownicy WHERE stanowisko = 'sekretarka' AND firma = 'Omega'";
                    $result2 = mysqli_query($conn, $query2);
                    while($row = mysqli_fetch_assoc($result2)) {
                        echo "<li>" . $row['imie'] . " " . $row['nazwisko'] . "</li>";
                    }
                }
                ?>
            </ol>
            <hr>
            <div id="statystyki">
                <?php
                if ($conn) {
                    // Skrypt nr 3: Statystyki pensji
                    $q_max = mysqli_query($conn, "SELECT MAX(pensja) as m FROM pracownicy");
                    $q_min = mysqli_query($conn, "SELECT MIN(pensja) as m FROM pracownicy");
                    $q_avg = mysqli_query($conn, "SELECT AVG(pensja) as m FROM pracownicy");
                    
                    $max = mysqli_fetch_assoc($q_max)['m'];
                    $min = mysqli_fetch_assoc($q_min)['m'];
                    $avg = round(mysqli_fetch_assoc($q_avg)['m'], 2);

                    echo "<p>Najwyższa pensja wynosi: $max zł</p>";
                    echo "<p>Najniższa pensja wynosi: $min zł</p>";
                    echo "<p>Średnia pensja wynosi: $avg zł</p>";
                }
                mysqli_close($conn);
                ?>
            </div>
        </section>
    </div>

    <footer id="stopka">
        <img src="logoc.png" alt="logo lewe">
        <span>Autor: [Twoje Imię i Nazwisko]</span>
        <img src="logoc.png" alt="logo prawe">
    </footer>

</body>
</html>