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
    if(isset($_POST['name'])){
        // Email settings 
        //name (imie i nazwisko); phone(numer telefonu); email (email); adres_p1 (adres z); adres_p2 (adres do); message (tresc wiadomosci);
        $toEmail = "konikbus@gmail.com"; // Recipient email 
        $toName = 'Iwona Buza';
        $from = $_POST["email"]; // Sender email 
        $fromName = $_POST['name']; // Sender name 
        
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $adres_z = $_POST['adres_p1'];
        $adres_do = $_POST['adres_p2'];
        $data = $_POST['data'];
        $message = $_POST['message'];


        $emailSubject = 'Zgłoszenie przeprowadzki od '.$name; 
        $emailSubject2 = 'Zgłoszenie przeprowadzki'; 
        
        // Email message  
        $htmlContent = '<h2>Zgłoszenie przeprowadzki:</h2> 
                        <p><b>Imię i nazwisko:</b> '.$name.'</p> 
                        <p><b>Email:</b> '.$email.'</p> 
                        <p><b>Numer telefonu:</b> '.$phone.'</p>
                        <p><b>Adres z:</b> '.$adres_z.'</p>
                        <p><b>Adres do:</b> '.$adres_do.'</p>
                        <p><b>Data:</b> '.$data.'</p>
                        <p><b>Treść wiadomości:</b><br/>'.$message.'</p>'; 

        $htmlContent2 = '<h2>Oto informacje które przesłałeś/aś w formularzu:</h2> 
                         <p><b>Imię i nazwisko:</b> '.$name.'</p> 
                         <p><b>Email:</b> '.$email.'</p> 
                         <p><b>Numer telefonu:</b> '.$phone.'</p>
                         <p><b>Adres z:</b> '.$adres_z.'</p>
                         <p><b>Adres do:</b> '.$adres_do.'</p>
                         <p><b>Data:</b> '.$data.'</p>
                         <p><b>Treść wiadomości:</b><br/>'.$message.'</p>'; 

        $headers = "From: $fromName"." <".$from.">"; 
        $headers2 = "From: $toName"." <".$toEmail.">"; 

        $semi_rand = md5(time());  
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
        
        // Headers for attachment  
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";  
        $headers2 .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";  
        
        // Multipart boundary  
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
        $message2 = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent2 . "\n\n";  

        $message .= "--{$mime_boundary}--"; 
        $message2 .= "--{$mime_boundary}--"; 

        $mail = mail($toEmail, $emailSubject, $message, $headers); 
        $mail2 = mail($from, $emailSubject, $message2, $headers2); 

        if($mail){
            print("Otrzymaliśmy maila. Wkrótce ktoś się z tobą skontaktuje.");
        }else{
            print("Coś poszło nie tak podczas wysyłania maila. Spróbuj ponownie.");
        }
     };
        ?>
    </main>
</body>
</html>