<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/nadaj.css">
    <link rel="shortcut icon" href="../img/logo.svg" type="image/svg">
    <script src="../js/nadaj.js"></script>
    <title>KonikBus</title>
</head>
<body onload="bodyLoad()">
    <a href="https://konikbus.pl">
        <header>
            <img src="../img/logo_name.svg" alt="KonikBus">
        </header>
    </a>
    <main>
        <form method="post" action='./sendForm.php' id="form_rezerwacje">
        <h1>Nadaj paczke</h1>
        <div class="clear"></div>   
            <span id="dane_klienta" class="float">
                <h2>Dane nadawcy</h2>
                <span id="imie" class="float"><p>Imię i nazwisko:</p>
                <input type="text" class="pole3" name="imie" required></span>
                <div class="clear"></div>
                <span id="tel1" class="float"><p>Telefon (Polska):</p>
                <input type="tel" class="pole" name="tel1" required></span>
                <span id="email" class="float"><p>Adres e-mail:</p>
                <input type="email" class="pole" name="email"></span>
            </span>
            <span id="dane_klienta" class="float">
                <h2>Dane odbiorcy</h2>
                <span id="imie2" class="float"><p>Imię i nazwisko:</p>
                <input type="text" class="pole3" name="imie2" required></span>
                <div class="clear"></div>
                <span id="tel2" class="float"><p>Telefon (Polska):</p>
                <input type="tel" class="pole" name="tel2" required></span>
                <span id="email2" class="float"><p>Adres e-mail:</p>
                <input type="email" class="pole" name="email2"></span>
            </span>
            <div class="clear"></div>
            <span id="wyjazd" class="float">
                <h2>Adres nadania</h2>
                    <span  class="float"><p>Miejscowość:</p>
                    <input type="text" class="pole" name="miejscowosc1" id="miejscowosc1" required></span>
                    <span id="ulica1" class="float"><p>Ulica</p>
                    <input type="text" class="pole" name="ulica1" required></span>
                    <div class="clear"></div>
                    <span id="kod1" class="float"><p>Kod pocztowy:</p>
                    <input type="text" class="pole" name="kod1" required></span>
                    <span  class="float"><p>Region:</p>
                    <select class="pole" name="region1" id="region1" required>
                       <option value="PL">Polska</option>
                       <option value="DE">Niemcy</option>
                       <option value="BE">Belgia</option>
                       <option value="NL">Holadnia</option>
                       <option value="LU">Luksemburg</option>
                   </select></span>
                   <input type="hidden" name="regionFrom" id="regionFrom" value=1>
                   <div class="clear"></div>
            </span>
            <span id="przejazd" class="float">
                <h2>Adres odbioru</h2>
                    <span  class="float"><p>Miejscowość:</p>
                    <input type="text" class="pole" name="miejscowosc2" id="miejscowosc2" required></span>
                    <span id="ulica2" class="float"><p>Ulica:</p>
                    <input type="text" class="pole" name="ulica2" required></span>
                    <div class="clear"></div>
                    <span id="kod2" class="float"><p>Kod pocztowy:</p>
                    <input type="text" class="pole" name="kod2" required></span>
                    <span  class="float"><p>Region:</p>
                    <select class="pole" name="region2" id="region2" required>
                        <option value="PL">Polska</option>
                        <option value="DE">Niemcy</option>
                        <option value="BE">Belgia</option>
                        <option value="NL">Holadnia</option>
                        <option value="LU">Luksemburg</option>
                    </select></span>
                    <input type="hidden" name="regionTo" id="regionTo" value=1>
            </span>
            <div class="clear"></div>
            <span id="szczegoly" class="float">
                <h2>Szczegóły rezerwacji</h2>
                    <span id="data1" class="float"><p>Data nadania:</p>
                    <input type="date" class="pole" name="data1" required></span>
                <span class="float"><p>Ilość:</p>
                <select name="ilosc_bagazu" class="pole" id="ilosc_bagazu">
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                    <option value=6>6</option>
                    <option value=7>7</option>
                    <option value=8>8</option>
                </select></span>
                <div class="clear"></div>
                <span  class="float"><p>Płatność:</p>
                <select name="platnosc" id="platnosc" class="pole" required>
                    <option value="kierowca">Przedpłata u kierowcy</option>
                    <option value="na_miejscu">Płatność na miejscu</option>
                    <option value="przelew">Przelew</option>
                <input type="hidden" name="payment" id="payment" value=-1>
                </select></span>
                <span id="waluta" class="float"><p>Płacę w:</p>
                <select name="waluta" class="pole2">
                    <option value="PLN">PLN</option>
                    <option value="EUR">EUR</option>
                </select></span>
                <span id="faktura1" class="float"><p><input type="checkbox" name="faktura" id="faktura">Faktura</p></span>
                <input type="hidden" name="invoice" id="invoice" value=0>
                <div id="fakt" style="display: none;">
                <div class="clear"></div>
                    <div id="nip1" class="float"><p>NIP:</p>
                    <input type="number" ame="nip" id="nip" min=1000000000 max=9999999999 required disabled></div>
                    <div id="firma1" class="float"><p>Imię i nazwisko/nazwa firmy:</p>
                    <input type="text" name="firma" id="firma" required disabled></div>
                    <div class="clear"></div>
                    <div id="firma_adres1" class="float"><p>Pełny adres:</p>
                    <input type="text" name="firma_adres" id="firma_adres" required disabled></div>
                    <input type="hidden" name="dane_faktura" id="dane_faktura">
                </div>
                <div class="clear"></div>
                <span id="info1" class="float"><p>Informacje dodatkowe:</p>
                <textarea rows="5" cols="30"id="info" name="info"></textarea>
                </span>
                <div class="clear"></div>
                <input type="hidden" name="catId" value=131075>
                <span id="regbut1" class="float"><p><input type="checkbox" name="regbut1" id="regbut1_1" class="float" required>Akceptuje <a id="regbut1a" href="../regulamin/" target="_blank">regulamin</a> usługi</p></span>
                <div class="clear"></div>
                <input type="submit" value="Nadaj paczkę" id="zarezerwuj" class="flaot">
            </span>
        </form>
        <div class="dummy"></div>
    </main>
    <footer>
        <iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d591.5489552339001!2d17.23118784120886!3d53.62564690454602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4702317d8095dbf7%3A0x13f7424c0f25c105!2sChrz%C4%85stowo%2029A%2C%2077-300%20Chrz%C4%85stowo!5e0!3m2!1spl!2spl!4v1691049892222!5m2!1spl!2spl" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <span class="socialmedia">
            <pre>
<h3>Znajdziesz nas również na:</h3>
• <a href="https://www.facebook.com/profile.php?id=100095320358728" target="blank">Facebook</a>
• <a href="https://www.instagram.com/konikbus/" target="blank">Instagram</a>
• <a href="https://www.tiktok.com/@konikbuskonik" target="blank">TikTok</a>
• <a href="https://youtube.com">YouTube</a>

<h3>Skontaktuj się z nami!</h3>
• Tel.: <a href="tel:+48 510319999">+48 510 319 999</a>
• E-mail: <a href="mailto:konikbus@gmail.com">konikbus@gmail.com</a>
• Adres: <a href="https://goo.gl/maps/7xuJdQHSPyjCcQDn8">Chrząstowo 29A, 77-300 Człuchów</a>
            </pre>
        </span>
        <span class="others">
            <pre>
• <a href="../regulamin/">Regulamin</a>
• <a href="../zarezerwuj/">Rezerwacja przejazdu</a>
• <a href="../nadaj/">Nadanie przesyłki</a>
• <a href="../wynajem/">Wynajem</a>
• <a href="../przeprowadzki/">Przeprowadzki</a>
• <a href="../praca/">Praca</a>
            </pre>
        </span>
        <iframe id="mapa2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d591.5489552339001!2d17.23118784120886!3d53.62564690454602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4702317d8095dbf7%3A0x13f7424c0f25c105!2sChrz%C4%85stowo%2029A%2C%2077-300%20Chrz%C4%85stowo!5e0!3m2!1spl!2spl!4v1691049892222!5m2!1spl!2spl" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="dummy"></div>        
    </footer>
</body>
</html>