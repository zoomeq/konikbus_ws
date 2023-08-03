<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sendForm.css">
    <link rel="shortcut icon" href="../img/logo.svg" type="image/svg">
    
    <title>Dziękujemy!</title>
</head>
<body>
    <main>
        <?php
        if(isset($_POST['imie'])){
        include_once '../api/db_api.php';
        
        ini_set('default_charset', 'UTF-8');
        
        $dbconn = db_open();
        if(!$dbconn) {
            echo '[{s:"ERROR",m:"Connection error"}]';
            exit;
        }
        $tel2 = NULL;
        if(isset($_POST['tel2'])){
            $tel2 = $_POST['tel2'];
        };
        $returnDate = @$_POST['data2'];
        $data = array(
            //dane kontaktowe
            'id_wlasciciela' => -1,            
            'id_pasazera' => -1,            
            'imie_nazwisko' => $_POST['imie'], 
            'email' => $_POST['email'],       
            'tel_1' => $_POST['tel1'],   
            'tel_2' => @$tel2,                   
            //adres z
            'id_adres_z' => -1,               
            'id_regionu_z' => $_POST['regionFrom'],      
            'kraj_z' => $_POST['region1'],     
            'miejscowosc_z' => $_POST['miejscowosc1'],
            'adres_z' => $_POST['ulica1'],   
            'kod_z' => $_POST['kod1'],       
            'lat_z' => NULL,                  
            'lng_z' => NULL,       
            //adres do           
            'id_adres_do' => -1,               
            'id_regionu_do' => $_POST['regionTo'],            
            'kraj_do' => $_POST['region2'],   
            'miejscowosc_do' => $_POST['miejscowosc2'],
            'adres_do' => $_POST['ulica2'], 
            'kod_do' => $_POST['kod2'],     
            'lat_do' => NULL,                  
            'lng_do' => NULL,    
            //dane przewozu            
            'data' => (new DateTime($_POST['data1']))->format("Y-m-d"), 
            'osob' => $_POST['ilosc_osob'],      
            'forma_platnosci' => $_POST['payment'],         
            'waluta_platnosci' => $_POST['waluta'],        
            'faktura' => $_POST['invoice'],               
            'dane_faktury' => @$_POST['dane_faktura'],           
            'ilosc_bagazu' => $_POST['ilosc_bagazu'],
            'informacje' => @$_POST['info'],   
            'id_powrotu' => -1, 
            'zrodlo' => 1,   
            'kategoria' => $_POST['catId'],        
            'dzieci' => @$_POST['kidsJSON'],           					
        );
        if(db_newOrder($dbconn, $data, $returnDate, 'pl') === FALSE) {
            echo '<img src="../img/logo_name.svg" alt="KonikBus" id="logo_sendForm"><h2>Nie udało się dodać rezerwacji do bazy!</h2><p>Za chwilę nastąpi przekierowanie na stronę formularza...</p><script>setTimeout(function(){window.location.href = "./";}, 5000);</script>';
        } else {
            echo '<img src="../img/logo_name.svg" alt="KonikBus" id="logo_sendForm"><h2>Dziękujemy za złożenie rezerwacji!</h2><p>Za chwilę nastąpi przekierowanie na stronę główną...</p><script>setTimeout(function(){window.location.href = "../";}, 5000);</script>';
        }
        
        db_close($dbconn);
        };
        ?>
    </main>
</body>
</html>