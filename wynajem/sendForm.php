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
        //name (imie i nazwisko); phone(numer telefonu); email (email); adres (adres); data_od (od); data_do (do); attachment (skan prawka);
        // Email settings 
        $toEmail = "konikbus@gmail.com"; // Recipient email 
        $toName = "Iwona Buza";
        $from = $_POST["email"]; // Sender email 
        $fromName = $_POST['name']; // Sender name 
        
        $attachmentUploadDir = "../uploads/"; 
        $allowFileTypes = array('pdf', 'jpg', 'png', 'jpeg', 'gif'); 
        
        
        /* Form submission handler code */ 
        $postData = $uploadedFile = $statusMsg = $valErr = ''; 
        $msgClass = 'errordiv'; 
        if(isset($_POST['name'])){ 
            // Get the submitted form data 
            $postData = $_POST; 
            $name = trim($_POST['name']); 
            $email = trim($_POST['email']); 
            $phone = $_POST['phone'];
            $adres = $_POST['adres'];
            $data_od = $_POST['data_od'];
            $data_do = $_POST['data_do'];
            $subject = trim("Zgłoszenie do pracy."); 
            $message = trim($_POST['message']); 
                    
            // Check whether submitted data is valid 
            if(empty($valErr)){ 
                $uploadStatus = 1; 
                // Upload attachment file 
                if(!empty($_FILES["attachment"]["name"])){ 
                   
                    
                    // File path config 
                    $targetDir = $attachmentUploadDir; 
                    $fileName = basename($_FILES["attachment"]["name"]); 
                    $targetFilePath = $targetDir . $fileName; 
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                    
                    // Allow certain file formats 
                    if(in_array($fileType, $allowFileTypes)){ 
                        // Upload file to the server 
                        if(move_uploaded_file($_FILES["attachment"]["tmp_name"], $targetFilePath)){ 
                            $uploadedFile = $targetFilePath; 
                            $statusMsg = "Otrzymaliśmy maila. Wkrótce ktoś się z tobą skontaktuje.";
                        }else{ 
                            $uploadStatus = 0; 
                            $statusMsg = "Przepraszamy, wystąpił błąd podczas przesyłania twojego skanu prawa jazdy. Spróbuj ponownie przesłać formularz."; 
                        } 
                    }else{ 
                        $uploadStatus = 0; 
                        $statusMsg = 'Przepraszamy, ale dopuszczany rodzaj skanu prawa jazdy to: '.implode('/', $allowFileTypes).'. Zmień format pliku i spróbuj ponownie.'; 
                    } 
                } 
                
                if($uploadStatus == 1){ 
                    // Email subject 
                    $emailSubject = 'Wynajem auta przez '.$name; 
                    $emailSubject2 = 'Wynajem auta'; 
                    //name (imie i nazwisko); phone(numer telefonu); email (email); adres (adres); data_od (od); data_do (do); attachment (skan prawka);
                    // Email message  
                    $htmlContent = '<h2>Wynajem auta:</h2> 
                        <p><b>Imię i nazwisko:</b> '.$name.'</p> 
                        <p><b>Email:</b> '.$email.'</p> 
                        <p><b>Numer telefonu:</b> '.$phone.'</p>
                        <p><b>Adres:</b> '.$adres.'</p>
                        <p><b>Data od:</b> '.$data_od.'</p>
                        <p><b>Data do:</b> '.$data_do.'</p>'; 
                    $htmlContent2 = '<h2>Oto informacje które przesłałeś/aś w formularzu wynajmu auta:</h2> 
                        <p><b>Imię i nazwisko:</b> '.$name.'</p> 
                        <p><b>Email:</b> '.$email.'</p> 
                        <p><b>Numer telefonu:</b> '.$phone.'</p>
                        <p><b>Adres:</b> '.$adres.'</p>
                        <p><b>Data od:</b> '.$data_od.'</p>
                        <p><b>Data do:</b> '.$data_do.'</p>'; 
                    
                    // Header for sender info 
                    $headers = "From: $fromName"." <".$from.">"; 
                    $headers2 = "From: $toName"." <".$toEmail.">"; 
        
                    // Add attachment to email 
                    if(!empty($uploadedFile) && file_exists($uploadedFile)){ 
                        
                        // Boundary  
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
                        
                        // Preparing attachment 
                        if(is_file($uploadedFile)){ 
                            $message .= "--{$mime_boundary}\n"; 
                            $message2 .= "--{$mime_boundary}\n"; 
                            $fp =    fopen($uploadedFile,"rb"); 
                            $data =  fread($fp,filesize($uploadedFile)); 
                            fclose($fp); 
                            $data = chunk_split(base64_encode($data)); 
                            $message .= "Content-Type: application/octet-stream; name=\"".basename($uploadedFile)."\"\n" .  
                            "Content-Description: ".basename($uploadedFile)."\n" . 
                            "Content-Disposition: attachment;\n" . " filename=\"".basename($uploadedFile)."\"; size=".filesize($uploadedFile).";\n" .  
                            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
                            $message2 .= "Content-Type: application/octet-stream; name=\"".basename($uploadedFile)."\"\n" .  
                            "Content-Description: ".basename($uploadedFile)."\n" . 
                            "Content-Disposition: attachment;\n" . " filename=\"".basename($uploadedFile)."\"; size=".filesize($uploadedFile).";\n" .  
                            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
                        } 
                        
                        $message .= "--{$mime_boundary}--"; 
                        $message2 .= "--{$mime_boundary}--"; 
                        
                        // Send email 
                        $mail = mail($toEmail, $emailSubject, $message, $headers); 
                        $mail2 = mail($from, $emailSubject2, $message2, $headers2); 
                        
                        // Delete attachment file from the server 
                        @unlink($uploadedFile); 
                    }else{ 
                        // Set content-type header for sending HTML email 
                        $headers .= "\r\n". "MIME-Version: 1.0"; 
                        $headers .= "\r\n". "Content-type:text/html;charset=UTF-8"; 
                        $headers2 .= "\r\n". "MIME-Version: 1.0"; 
                        $headers2 .= "\r\n". "Content-type:text/html;charset=UTF-8"; 
                        // Send email 
                        $mail = mail($toEmail, $emailSubject, $htmlContent, $headers);  
                        $mail2 = mail($from, $emailSubject2, $message2, $headers2); 
                    };
                    
                    if($mail){
                        print($statusMsg);
                    }else{
                        print("Coś poszło nie tak podczas wysyłania maila. Spróbuj ponownie.");
                    }
                };
            };
        };
     };
        ?>
    </main>
</body>
</html>