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
        $toEmail = "konikbus@gmail.com"; // Recipient email 
        $toName = "Iwona Buza";
        $from = $_POST["email"]; // Sender email 
        $fromName = $_POST['name']; // Sender name 
        
        $attachmentUploadDir = "../uploads/"; 
        $allowFileTypes = array('pdf', 'doc', 'docx','gif'); 
        $allowFileTypes2 = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
        
        
        /* Form submission handler code */ 
        $postData = $uploadedFile = $uploadedFile2 = $statusMsg = $valErr = ''; 
        $msgClass = 'errordiv'; 
        if(isset($_POST['name'])){ 
            // Get the submitted form data 
            $postData = $_POST; 
            $name = trim($_POST['name']); 
            $email = trim($_POST['email']); 
            $phone = $_POST['phone'];
            $subject = trim("Zgłoszenie do pracy."); 
            $message = trim($_POST['message']); 
                    
            // Check whether submitted data is valid 
            if(empty($valErr)){ 
                $uploadStatus = 1; 
                // Upload attachment file 
                print_r($_POST["attachment"]["name"]);
                if(!empty($_FILES["attachment"]["name"]) && !empty($_FILES["attachment2"]["name"])){ 
                   
                    
                    // File path config 
                    $targetDir = $attachmentUploadDir; 
                    $fileName = basename($_FILES["attachment"]["name"]); 
                    $targetFilePath = $targetDir . $fileName; 
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                    $fileName2 = basename($_FILES["attachment2"]["name"]); 
                    $targetFilePath2 = $targetDir . $fileName2; 
                    $fileType2 = pathinfo($targetFilePath2, PATHINFO_EXTENSION); 
                    
                    // Allow certain file formats 
                    if(in_array($fileType, $allowFileTypes)){ 
                        // Upload file to the server 
                        if(move_uploaded_file($_FILES["attachment"]["tmp_name"], $targetFilePath)){ 
                            $uploadedFile = $targetFilePath; 
                            $statusMsg = "Dziękujemy za wysłanie zgłoszenia!";
                        }else{ 
                            $uploadStatus = 0; 
                            $statusMsg = "Przepraszamy, wystąpił błąd podczas przesyłania twojego CV. Spróbuj ponownie przesłać formularz."; 
                        } 
                    }else{ 
                        $uploadStatus = 0; 
                        $statusMsg = 'Przepraszamy, ale dopuszczany rodzaj pliku CV to: '.implode('/', $allowFileTypes).'. Zmień format pliku i spróbuj ponownie.'; 
                    } 
                    if(in_array($fileType2, $allowFileTypes2)){ 
                        // Upload file to the server 
                        if(move_uploaded_file($_FILES["attachment2"]["tmp_name"], $targetFilePath2)){ 
                            $uploadedFile2 = $targetFilePath2; 
                            $statusMsg = "Dziękujemy za wysłanie zgłoszenia!";
                        }else{ 
                            $uploadStatus = 0; 
                            $statusMsg = "Przepraszamy, wystąpił błąd podczas przesyłania twojego skanu prawa jazdy. Spróbuj ponownie przesłać formularz."; 
                        } 
                    }else{ 
                        $uploadStatus = 0; 
                        $statusMsg = 'Przepraszamy, ale dopuszczany rodzaj skanu prawa jazdy to: '.implode('/', $allowFileTypes2).'. Zmień format pliku i spróbuj ponownie.'; 
                    } 
                } 
                
                if($uploadStatus == 1){ 
                    // Email subject 
                    $emailSubject = 'Zgłoszenie do pracy od '.$name; 
                    $emailSubject2 = 'Zgłoszenie do pracy.'; 
                    
                    // Email message  
                    $htmlContent = '<h2>Zgłoszenie do pracy:</h2> 
                        <p><b>Imię i nazwisko:</b> '.$name.'</p> 
                        <p><b>Email:</b> '.$email.'</p> 
                        <p><b>Numer telefonu:</b> '.$phone.'</p>
                        <p><b>Treść wiadomości:</b><br/>'.$message.'</p>'; 

                    $htmlContent2 = '<h2>Oto informacje które przesłałeś/aś w zgłoszeniu do pracy:</h2> 
                        <p><b>Imię i nazwisko:</b> '.$name.'</p> 
                        <p><b>Email:</b> '.$email.'</p> 
                        <p><b>Numer telefonu:</b> '.$phone.'</p>
                        <p><b>Treść wiadomości:</b><br/>'.$message.'</p>'; 
                    
                    // Header for sender info 
                    $headers = "From: $fromName"." <".$from.">"; 
                    $headers2 = "From: $toName"." <".$toEmail.">"; 
        
                    // Add attachment to email 
                    if(!empty($uploadedFile) && file_exists($uploadedFile) && !empty($uploadedFile2) && file_exists($uploadedFile2)){ 
                        
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
                        if(is_file($uploadedFile2)){ 
                            $message .= "--{$mime_boundary}\n"; 
                            $message2 .= "--{$mime_boundary}\n"; 
                            $fp2 =    fopen($uploadedFile2,"rb"); 
                            $data2 =  fread($fp,filesize($uploadedFile2)); 
                            fclose($fp2); 
                            $data2 = chunk_split(base64_encode($data2)); 
                            $message .= "Content-Type: application/octet-stream; name=\"".basename($uploadedFile2)."\"\n" .  
                            "Content-Description: ".basename($uploadedFile2)."\n" . 
                            "Content-Disposition: attachment;\n" . " filename=\"".basename($uploadedFile2)."\"; size=".filesize($uploadedFile2).";\n" .  
                            "Content-Transfer-Encoding: base64\n\n" . $data2 . "\n\n"; 
                            $message2 .= "Content-Type: application/octet-stream; name=\"".basename($uploadedFile2)."\"\n" .  
                            "Content-Description: ".basename($uploadedFile2)."\n" . 
                            "Content-Disposition: attachment;\n" . " filename=\"".basename($uploadedFile2)."\"; size=".filesize($uploadedFile2).";\n" .  
                            "Content-Transfer-Encoding: base64\n\n" . $data2 . "\n\n"; 
                        } 
                        
                        $message .= "--{$mime_boundary}--"; 
                        $message2 .= "--{$mime_boundary}--"; 
                        
                        // Send email 
                        $mail = mail($toEmail, $emailSubject, $message, $headers); 
                        $mail2 = mail($from, $emailSubject, $message2, $headers2); 
                        // Delete attachment file from the server 
                        @unlink($uploadedFile); 
                        @unlink($uploadedFile2); 
                    }else{ 
                            // Set content-type header for sending HTML email 
                        $headers .= "\r\n". "MIME-Version: 1.0"; 
                        $headers .= "\r\n". "Content-type:text/html;charset=UTF-8"; 
                        // Send email 
                        $mail = mail($toEmail, $emailSubject, $htmlContent, $headers);  
                        $mail2 = mail($from, $emailSubject, $htmlContent2, $headers2);  
                    };
                    
                    // If mail sent 
                    print($statusMsg);
                };
            };
        };
     };
        ?>
    </main>
</body>
</html>