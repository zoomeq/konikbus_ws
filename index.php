<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="shortcut icon" href="./img/logo.svg" type="image/svg">
    <title>KonikBus</title>
</head>
<body>
        <header id="header1">
            <img id="himg2"src="./img/logo_name.svg" alt="KonikBus">
            <h1>Międzynarodowy przewóz osób i rzeczy</h1>
            <h2><a href="tel:+48 510319999"><img src="./img/phone.svg" alt="phone">+48 510 31 99 99</a></h2>
            <!-- <img id="himg1" src="./img/7za50.png"> -->
            <h2 id="za50">7 przejazd za 50% ceny</h2>
        </header>
    <main>
        <div class="box" id="ofirmie_img">
            <img id="oimg1" src="./img/3w1.png">
            <img id="oimg2" src="./img/tlewotlo.png">
        </div>
        <div class="box" id="ofirmie">
            <div class="dummy"></div>
            <div id="onas" class="insideboxof ofir">
                <h2>O Nas</h2>
                Nasza firma świadczy usługi w zakresie przewozu osób i rzeczy w skali międzynarodowej. Oferujemy przejazdy po kraju jak również za granicę. Obszar jaki znajduje się w zakresie naszej obsługi, znajdziecie Państwo w zakładce „Obsługiwany obszar”. Wyjazdy mamy codziennie przez całą dobę. Podchodzimy również indywidualnie do każdego naszego klienta. Posiadamy flotę, która zapewni Państwu bezpieczny dojazd do celu, „Door to door”. Zatrudniamy wykwalifikowaną kadrę, która posiada szerokie doświadczenie, aby spełnić Państwa oczekiwania. Nasze usługi gwarantują zarówno bezpieczeństwo jak i komfort podróży. Rezerwacji przejazdu można dokonać telefoniczne, poprzez SMS, WhatsApp, Messenger lub przez stronę On Line. Zapraszamy!
            </div>
            <div class="dummy"></div>
        </div>
        <div class="box" id="uslugi">
            <hr><h1>Nasze Usługi</h1><hr>
            <div class="dummy"></div>
            <div class="flex_wrapper">
                <div id="usluga1" class="usluga">
                    <h2>Międzynarodowy przewóz osób <img src="./img/mapPin.svg" alt="mapPin"></h2>
                    <a href="./zarezerwuj/"><p class="button_rezerw">Zarezerwuj przejazd</p></a>
                </div>
                <div id="usluga2" class="usluga">
                    <h2>Transport przesyłek <img src="./img/deliveryMan.svg" alt="deliveryMan"></h2>
                    <a href="./nadaj/"><p class="button_rezerw">Nadaj paczkę</p></a>
                </div>
                <div id="usluga3" class="usluga">
                    <h2>Wynajem auta z kierowcą lub bez <img src="./img/travelCar.svg" alt="travelCar"></h2>
                    <a href="./wynajem/"><p class="button_rezerw">Wynajmij auto</p></a>
                </div>   
                <div id="usluga4" class="usluga">
                    <h2>Usługa auto-lawety <img src="./img/checkEngine.svg" alt="checkEngine"></h2>
                    <a href=" "><p class="button_rezerw">Wezwij pomoc</p></a>
                </div>  
                <div id="usluga5" class="usluga">
                    <h2>Przeprowadzki <img src="./img/house.svg" alt="house"></h2>
                    <a href="./przeprowadzki/"><p class="button_rezerw">Zapytaj o wolny termin</p></a>
                </div>  
            </div>   
        </div>
        <div class="box" id="obszar">
            <hr><h1>Obsługiwany Obszar</h1><hr>
            <div class="dummy"></div>
            <div id="col1">
                <div class="country" id="pl">
                    <h2>Polska</h2>
                    <img src="./img/pl.png" alt="Mapa Polski" id="map_pl">
                </div>
                <div class="country" id="de">
                    <h2>Niemcy</h2>
                    <img src="./img/de.png" alt="Mapa Niemcy" id="map_de">
                </div>
            
             
            </div>  
            <div id="col2">
            <div class="country" id="nl">
                    <h2>Holandia</h2>
                    <img src="./img/nl.png" alt="Mapa Holadni" id="map_nl">
                </div>
                <div class="country" id="be">
                    <h2>Belgia</h2>  
                    <img src="./img/be.png" alt="Mapa Belgi" id="map_be">
                </div>
          

            </div>
            <div class="country" id="lu">
                    <h2>Luksemburg</h2>
                    <img src="./img/lu.png" alt="Mapa Luksemburga" id="map_lu">
                </div>
            <div class="dummy"></div>
        </div>
        <div class="box" id="praca">
            <hr><h1>Pracuj z nami</h1><hr>
            <div class="dummy"></div>
            <div class="insidepraca">
                <p>Jeżeli jesteś zainteresowany pracą w naszej firmie, wypełnij formularz, a na pewno się skontaktujemy.</p>
                <a href="./praca/" ><p class="button_rezerw">Wypełnij formularz</p></a>
            </div>
        </div>
    <div id="fb-root"></div>
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
    <script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "108901722292683");
    chatbox.setAttribute("attribution", "biz_inbox");
    </script>
    <script>
    window.fbAsyncInit = function() {
        FB.init({
        xfbml            : true,
        version          : 'v17.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/pl_PL/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
    </main>
    <footer>
        <iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d591.5489552339001!2d17.23118784120886!3d53.62564690454602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4702317d8095dbf7%3A0x13f7424c0f25c105!2sChrz%C4%85stowo%2029A%2C%2077-300%20Chrz%C4%85stowo!5e0!3m2!1spl!2spl!4v1691049892222!5m2!1spl!2spl" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <span class="socialmedia">
            <pre>
<h3 class="social">Znajdziesz nas również na:</h3>
<span class="socialimage"><a target="blank" href="https://www.facebook.com/profile.php?id=100095320358728"><img height="64px" src="./img/facebook.svg" alt="Facebook"></a></span> <span class="socialimage"><a target="blank" href="https://www.instagram.com/konikbus/"><img height="64px" src="./img/instagram.svg" alt="Instagram"></a></span> <span class="socialimage"><a target="blank" href="https://wa.me/48510319999"><img height="64px" src="./img/whatsapp.svg" alt="Whatsapp"></a></span> <span class="socialimage"><a target="blank" href="https://www.tiktok.com/@konikbuskonik"><img height="64px" src="./img/tiktok.svg" alt="TikTok"></a></span> <span class="socialimage"><a target="blank" href="https://youtube.com"><img height="64px" src="./img/youtube.svg" alt="Youtube"></a></span>
<h3>Skontaktuj się z nami!</h3>
• Tel.: <a href="tel:+48 510319999">+48 510 319 999</a>
• E-mail: <a href="mailto:konikbus@gmail.com">konikbus@gmail.com</a>
• Adres: <a href="https://goo.gl/maps/7xuJdQHSPyjCcQDn8">Chrząstowo 29A, 77-300 Człuchów</a>
            </pre>
        </span>
        <span class="others">
            <pre>
• <a href="./regulamin/">Regulamin</a>
• <a href="./zarezerwuj/">Rezerwacja przejazdu</a>
• <a href="./nadaj/">Nadanie przesyłki</a>
• <a href="./wynajem/">Wynajem</a>
• <a href="./przeprowadzki/">Przeprowadzki</a>
• <a href="./praca/">Praca</a>
            </pre>
        </span>
        <iframe id="mapa2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d591.5489552339001!2d17.23118784120886!3d53.62564690454602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4702317d8095dbf7%3A0x13f7424c0f25c105!2sChrz%C4%85stowo%2029A%2C%2077-300%20Chrz%C4%85stowo!5e0!3m2!1spl!2spl!4v1691049892222!5m2!1spl!2spl" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="dummy"></div>        
    </footer>
</body>
</html>