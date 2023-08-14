<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/praca.css">
    <link rel="shortcut icon" href="../img/logo.svg" type="image/svg">
    <title>KonikBus</title>
</head>
<body>
    <a href="../">
        <header>
            <img src="../img/logo_name.svg" alt="KonikBus">
        </header>
    </a>
    <main>
        <div id="form_praca">
        <h2>Przeprowadzki</h2>
        <div id="send_form_status"></div>
        <form method="post" action="" id="contact_form">
             <p>Imię i nazwisko:</p>
             <input type="text" name="name" id="name" class="formField"/>
             <p>Numer telefonu:</p>
             <input type="text" name="phone" id="phone" class="formField"/>
             <p>Adres email:</p>
             <input type="text" name="email" id="email" class="formField"/>
             <p>Treść wiadomości:</p>
             <textarea name="message" id="message"></textarea>
             <p>Załączniki:</p>
             <input type="file" name="file" id="file">
             <button id="sendBtn">Wyślij</button>
        </form>
        </div>
            <div id="tlewo">
            <img src="../img/tlewo.png" id="tlewo_img">
        </div>
        <div class="clear"></div>
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
<span class="socialimage"><a target="blank" href="https://www.facebook.com/profile.php?id=100095320358728"><img height="64px" src="../img/facebook.svg" alt="Facebook"></a></span> <span class="socialimage"><a target="blank" href="https://www.instagram.com/konikbus/"><img height="64px" src="../img/instagram.svg" alt="Instagram"></a></span> <span class="socialimage"><a target="blank" href="https://wa.me/48510319999"><img height="64px" src="../img/whatsapp.svg" alt="Whatsapp"></a></span> <span class="socialimage"><a target="blank" href="https://www.tiktok.com/@konikbuskonik"><img height="64px" src="../img/tiktok.svg" alt="TikTok"></a></span> <span class="socialimage"><a target="blank" href="https://youtube.com"><img height="64px" src="../img/youtube.svg" alt="Youtube"></a></span>
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
        <div id="planeta">
            <img src="../img/planeta.png" id="planeta_img">
        </div>
        <iframe id="mapa2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d591.5489552339001!2d17.23118784120886!3d53.62564690454602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4702317d8095dbf7%3A0x13f7424c0f25c105!2sChrz%C4%85stowo%2029A%2C%2077-300%20Chrz%C4%85stowo!5e0!3m2!1spl!2spl!4v1691049892222!5m2!1spl!2spl" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="dummy"></div>        
    </footer>
</body>
</html>