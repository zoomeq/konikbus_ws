<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/zarezerwuj.css">
    <script src="../js/rezerwacje.js"></script>
    <link rel="shortcut icon" href="../img/logo.svg" type="image/svg">
    <title>KonikBus</title>
</head>
<body id="body" onload="bodyLoad()">
    <a href="https://konikbus.pl">
        <header>
            <img src="../img/logo_name.svg" alt="KonikBus">
        </header>
    </a>
    <main>
        <form method="post" action="./sendForm.php" id="form_rezerwacje">
        <h1>Rezerwacja przejazdu</h1>
        <div class="clear"></div>
        <div id="rezerw1">    
            <span id="wyjazd" class="float">
                <h2>Wyjazd z</h2>
                    <span class="float"><p>Miejscowość:</p>
                    <input type="text" class="pole" name="miejscowosc1" id="miejscowosc1" required></span>
                    <span id="ulica1" class="float"><p>Ulica</p>
                    <input type="text" class="pole" name="ulica1" required></span>
                    <div class="clear"></div>
                    <span id="kod1" class="float"><p>Kod pocztowy:</p>
                    <input type="text" class="pole" name="kod1" required></span>
                    <span class="float"><p>Region:</p>
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
                <h2>Przejazd do</h2>
                    <span  class="float"><p>Miejscowość:</p>
                    <input type="text" class="pole" name="miejscowosc2" id="miejscowosc2" required></span>
                    <span id="ulica2" class="float"><p>Ulica:</p>
                    <input type="text" class="pole" name="ulica2" required></span>
                    <div class="clear"></div>
                    <span id="kod2" class="float"><p>Kod pocztowy:</p>
                    <input type="text" class="pole" name="kod2" required></span>
                    <span class="float"><p>Region:</p>
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
        </div>
        <div id="rezerw2">
            <span id="szczegoly" class="float">
                <h2>Szczegóły rezerwacji</h2>
                    <span id="data1" class="float"><p>Data wyjazdu:</p>
                    <input type="date" class="pole" name="data1" required></span>
                    <span class="float"><p>Liczba osób:</p>
                    <select name="ilosc_osob" id="ilosc_osob" class="pole2" required>
                        <Option value="1">1</Option>
                        <Option value="2">2</Option>
                        <Option value="3">3</Option>
                        <Option value="4">4</Option>
                        <Option value="5">5</Option>
                        <Option value="6">6</Option>
                        <Option value="7">7</Option>
                        <Option value="8">8</Option>
                    </select></span>
                    <span id="ilosc_dzieci1" class="float"><p>W tym dzieci:</p>
                    <select name="ilosc_dzieci" class="pole2" id="ilosc_dzieci">
                        <Option value="0">0</Option>
                        <Option value="1">1</Option>
                    </select></span>
                    <div class="clear"></div>
                <div id="kidages" style="display: none;">
                    <p>Wiek dzieci:<p>
                    <input type="number" class="kidage float" name="wiek_dziecko1" placeholder="Wiek pierwszego dziecka" id="wiek_dziecko1" min=0 max=17 required disabled hidden>
                    <input type="number" class="kidage float" name="wiek_dziecko2" placeholder="Wiek drugiego dziecka" id="wiek_dziecko2" min=0 max=17 required disabled hidden>
                    <div class="dummy"></div>
                    <input type="number" class="kidage float" name="wiek_dziecko3" placeholder="Wiek trzeciego dziecka" id="wiek_dziecko3" min=0 max=17 required disabled hidden>
                    <input type="number" class="kidage float" name="wiek_dziecko4" placeholder="Wiek czwartego dziecka" id="wiek_dziecko4" min=0 max=17 required disabled hidden>
                    <div class="dummy"></div>
                    <input type="number" class="kidage float" name="wiek_dziecko5" placeholder="Wiek piątego dziecka" id="wiek_dziecko5" min=0 max=17 required disabled hidden>
                    <input type="number" class="kidage float" name="wiek_dziecko6" placeholder="Wiek szóstego dziecka" id="wiek_dziecko6" min=0 max=17 required disabled hidden>
                    <div class="dummy"></div>
                    <input type="number" class="kidage float" name="wiek_dziecko7" placeholder="Wiek siódmego dziecka" id="wiek_dziecko7" min=0 max=17 required disabled hidden>
                    <input type="number" class="kidage float" name="wiek_dziecko8" placeholder="Wiek ósmego dziecka" id="wiek_dziecko8" min=0 max=17 required disabled hidden>
                    <div class="dummy"></div>
                    <input type="hidden" class="kidage float" name="kidsJSON" id="kidsJSON" value="">
                </div>
                <span class="float"><p>Ilość bagażu:</p>
                <select name="ilosc_bagazu" class="pole" id="ilosc_bagazu">
                    <option value=1>1</option>
                    <option value=2>2</option>
                </select></span>
                <span id="data2" class="float"><p>Data powrotu:</p>
                <input type="date" class="pole" name="data2"></span>
                <div class="clear"></div>
                <span id="platnosc" class="float"><p>Płatność:</p>
                <select name="platnosc" class="pole" id="platnosc" required>
                    <option value="kierowca">Przedpłata u kierowcy</option>
                    <option value="na_miejscu">Płatność na miejscu</option>
                    <option value="przelew">Przelew</option>
                </select></span>
                <input type="hidden" name="payment" id="payment" value=-1>
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
                    <input type="number" name="nip" id="nip" min=1000000000 max=9999999999 required disabled></div>
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
                <div class="clear"></div>
                <span id="regbut1" class="float"><p><input type="checkbox" name="regbut1" id="regbut1_1" class="float">Akceptuje <a id="regbut1a" href="../regulamin/" target="_blank">regulamin</a> usługi</p></span>
                <div class="clear"></div>
                <input type="submit" value="Zgłoś rezerwacje" id="zarezerwuj1" class="flaot">
                </span>
                <div class="clear"></div>
            </span>
            <span id="dane_klienta" class="float">
                <h2>Dane pasażera</h2>
                <span id="imie" class="float"><p>Imię i nazwisko:</p>
                <input type="text" class="pole3" name="imie" required></span>
                <div class="clear"></div>
                <span id="tel1" class="float"><p>Telefon (Polska):</p>
                <input type="tel" class="pole" name="tel1" required></span>
                <span id= id="tel2" class="float"><p>Telefon (Zagranica):</p>
                <input type="tel" class="pole" name="tel2"></span>
                <div class="clear"></div>
                <span id="email" class="float"><p>Adres e-mail:</p>
                <input type="email" class="pole3" name="email"></span>
            </span>
            <div class="clear"></div>
        </div>
        <input type="hidden" name="catId" value=65538>
         <span id="regbut2" class="float"><p><input type="checkbox" name="regbut2" id="regbut2_1">Akceptuje <a id="regbut2a" href="../regulamin/" target="_blank">regulamin</a> usługi</p></span>
         <div class="clear"></div>
        <input type="submit" value="Zgłoś rezerwacje" id="zarezerwuj2" class="float">
        </form>
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