<?php
define('COMPANY_EMAIL', 'konikbus@gmail.com');
define('COMPANY_NAME', 'Iwona Buza');
define('SEND_EMAIL_TO_CLIENT', true);
include_once 'db_conn.php';
/****************************************************************************************************************
 db_sendEmail($fromName, $fromEmail, $title, $message, $toEmail)
 */
function db_sendEmail($fromName, $fromEmail, $title, $message, $toEmail) {
	$headers   = array();
 	$headers[] = "MIME-Version: 1.0";
	$headers[] = "Content-type: text/html; charset=UTF-8";
	$headers[] = "Content-Transfer-Encoding: 8bit";
	$headers[] = "From: =?UTF-8?B?".base64_encode($fromName)."?= <".$fromEmail.">";
	$headers[] = "X-Mailer: PHP/".phpversion(); 
	
	$titleToSend= '=?UTF-8?B?'.base64_encode($title).'?=';
	$messageToSend = '<html><body>'.$message.'</body></html>';
	
	mail($toEmail, $titleToSend, $messageToSend, implode("\r\n", $headers));
}

/****************************************************************************************************************
 getFieldValue($newValue, $oldValue, $pre)
 */
function getFieldValue($newValue, $oldValue, $pre) {
	if($newValue && $oldValue) {
		if($newValue == $oldValue) {
			return $pre . ' <b>'.$newValue.'</b><br>';
		}
		return $pre . ' <b style="background-color: #fad169;">'.$newValue.'</b><br>';
	} else if(!$newValue && $oldValue) {
		//removed
		return '<span style="background-color: #f2dede;">' . $pre . ' <b>'.$oldValue.'</b></span><br>';
	} else if($newValue && !$oldValue) {
		//added
		return '<span style="background-color: #dff0d8;">' . $pre . ' <b>'.$newValue.'</b></span><br>';
	}
	return '';
}
/****************************************************************************************************************
 getFieldJsonValue($newValue, $oldValue, $pre, $kind)
 */
function getFieldJsonValue($newValue, $oldValue, $pre, $kind) {	
	if($newValue && $oldValue) {
		if($newValue == $oldValue) {
			switch($kind) {
				case 'detale':
					return decodePackages($newValue, $pre, 'not changed');
				case 'dzieci':
					return decodeChildren($newValue, $pre, 'not changed');
				default:
					return $pre . ' <b>'.$newValue.'</b><br>';
			}
		}
		switch($kind) {
			case 'detale':
				return decodePackages($newValue, $pre, 'changed');
			case 'dzieci':
				return decodeChildren($newValue, $pre, 'changed');
			default:
				return $pre . ' <b style="background-color: #fad169;">'.$newValue.'</b><br>';
		}
	} else if(!$newValue && $oldValue) {
		//removed
		switch($kind) {
			case 'detale':
				return decodePackages($oldValue, $pre, 'removed');
			case 'dzieci':
				return decodeChildren($oldValue, $pre, 'removed');
			default:
				return '<span style="background-color: #f2dede;">' . $pre . ' <b>'.$oldValue.'</b></span><br>';
		}
	} else if($newValue && !$oldValue) {
		//added
		switch($kind) {
			case 'detale':
				return decodePackages($newValue, $pre, 'added');
			case 'dzieci':
				return decodeChildren($newValue, $pre, 'added');
			default:
				return '<span style="background-color: #dff0d8;">' . $pre . ' <b>'.$newValue.'</b></span><br>';
		}
	}
	return '';
}

function decodeChildren($value, $pre, $action) {
	$children = json_decode($value);
	if(!$children) {
		return ''; 
	}
	$result = '';
	foreach ($children as &$child) {
		if(!$result) {
			$result = $child->wiek;
		} else {
			$result = $result . ', ' . $child->wiek;
		}
	}
	switch($action) {
		case 'added'://#dff0d8
			return '<span style="background-color: #dff0d8;">' . $pre . ' <b>'.$result.'</b></span><br>';
		case 'removed'://#f2dede
			return '<span style="background-color: #f2dede;">' . $pre . ' <b>'.$result.'</b></span><br>';
		case 'changed'://#fad169
			return $pre . ' <b style="background-color: #fad169;">'.$result.'</b><br>';
		default: //not changed
	}
	return $pre . ' <b>' . $result . '</b><br>';
}

function decodePackages($value, $pre, $action) {
	$packages = json_decode($value);
	if(!$packages) {
		return ''; 
	}
	$result = '';
	$count = 0;
	foreach ($packages as &$pack) {
		$count++;
		$p = $pack->w.'x'.$pack->s.'x'.$pack->g.' '.$pack->c . 'kg';
		
		switch($action) {
			case 'added'://#dff0d8
				$result = $result . '<span style="background-color: #dff0d8;">' . $pre . $count . '. <b>'.$p.'</b></span><br>';
				break;
			case 'removed'://#f2dede
				$result = $result . '<span style="background-color: #f2dede;">' . $pre . $count . '. <b>'.$p.'</b></span><br>';
				break;
			case 'changed'://#fad169
				$result = $result . $pre . $count . '. <b style="background-color: #fad169;">'.$p.'</b><br>';
				break;
			default: //not changed
				$result = $result . $pre . $count . '. <b>' . $p . '</b><br>';
				break;
		}
	}
	return $result;
}

function getCategory($id_kategorii, $arr) {
	if(!$id_kategorii) {
		//not set, so just return
		return $id_kategorii;
	}
	foreach ($arr as &$item) {
		if($id_kategorii == $item->id_kategorii) {
			return $item->nazwa;
		}
	}
	return null;
}

function getInvoiceValue($faktura, $dane_faktury, $faktura_old, $dane_faktury_old, $transl) {	
	$nazwa = null; $adres = null; $nip = null; $informacje = null;
	$nazwa_old = null; $adres_old = null; $nip_old = null; $informacje_old = null;
	
	if($faktura && $dane_faktury) {
		$dane = json_decode($dane_faktury);
		@$nazwa = @$dane->nazwa;
		if(@$dane->adres) {
			$adres = str_replace(array("\r\n", "\n", "\r"), '; ', $dane->adres);
		}
		@$nip = @$dane->nip;
		if(@$dane->informacje) {
			$informacje = str_replace(array("\r\n", "\n", "\r"), '; ', $dane->informacje);
		}
	}
	if($faktura_old && $dane_faktury_old) {
		$dane = json_decode($dane_faktury_old);
		@$nazwa_old = @$dane->nazwa;
		if(@$dane->adres) {
			$adres_old = str_replace(array("\r\n", "\n", "\r"), '; ', $dane->adres);
		}
		@$nip_old = @$dane->nip;
		if(@$dane->informacje) {
			$informacje_old = str_replace(array("\r\n", "\n", "\r"), '; ', $dane->informacje);
		}
	}
	
	$invoice = getFieldValue($faktura ? $transl['i_yes'] : null, $faktura_old ? $transl['i_yes'] : null, $transl['i_invoice']);
	$invoice .= getFieldValue($nazwa, $nazwa_old, ' &nbsp; &nbsp; ' . $transl['i_for']);
	$invoice .= getFieldValue($nip, $nip_old, ' &nbsp; &nbsp; ' . $transl['i_taxid']);
	$invoice .= getFieldValue($adres, $adres_old, ' &nbsp; &nbsp; ' . $transl['i_address']);
	$invoice .= getFieldValue($informacje, $informacje_old, ' &nbsp; &nbsp; ' . $transl['i_info']);

	return $invoice;
}
/****************************************************************************************************************
 db_messageForOrder($data, $return_date, $kategoria, $oldData, $lang)
 */
function db_messageForOrder($conn, $data, $return_date, $kategoria, $oldData, &$payment_form, $lang) {
	if($oldData) {
		$oldData = (array)$oldData;
	} else {
		//new one (do not show changes)
		$oldData = $data;
	}
	
	$sth = $conn->prepare('SELECT id, id_kategorii, nazwa, grupa FROM kategorie WHERE grupa > 0;');
	$sth->execute();
	$cat_arr = $sth->fetchAll(PDO::FETCH_OBJ);
	$sth->closeCursor();
	
	

	switch($lang) {
		case 'pl':
			$transl = array(
			   's_category' => 'Kategoria:',
			   's_sender' => 'Nadawca:',
			   's_phone' => 'Telefon:',
			   's_email' => 'Adres e-mail:',
			   's_sender_address' => 'Adres nadania:',
			   's_street' => 'Ulica:',
			   's_postcode' => 'Kod pocztowy:',
			   's_city' => 'Miejscowość:',
			   's_country' => 'Region:',
			   's_receiver' => 'Odbiorca:',
			   's_receiver_address' => 'Adres odbioru:',
			   's_details' => 'Szczegóły wysyłki',
			   's_date' => 'Data nadania:',
			   's_quantity' => 'Ilość:',
			   's_payment_form' => 'Forma płatności:',
			   's_payment_currency' => 'Waluta płatności:',
			   's_info' => 'Informacje:',

			   't_name' => 'Imię i nazwisko lub nazwa firmy:',
			   't_passenger' => 'Imię i nazwisko pasażera:',
			   't_date_departure' => 'Data wyjazdu:',
			   't_date_return' => 'Data powrotu:',
			   't_persons' => 'Liczba osób:',
			   't_children_age' => 'W tym dzieci w wieku:',
			   't_luggage' => 'Ilość bagażu:',
			   't_departure' => 'Wyjazd z:',
			   't_arrival' => 'Przyjazd do:',
			   't_confirmation' => 'Potwierdzenie zamówienia:',

			   'i_invoice' => 'Faktura:',
			   'i_yes' => 'TAK',
			   'i_for' => 'Dla:',
			   'i_taxid' => 'NIP:',
			   'i_address' => 'Adres:',
			   'i_info' => 'Informacje dodatkowe:',
			   'l_title' => 'Legenda:',
			   'l_info' => 'Informacja:',
			   'l_info_n' => 'nowa',
			   'l_info_u' => 'zmieniona',
			   'l_info_d' => 'usunięta'
			 );
			break;
		default:
			$transl = array(
			   's_category' => 'Category:',
			   's_sender' => 'Sender:',
			   's_phone' => 'Telephone no.:',
			   's_email' => 'Email address:',
			   's_sender_address' => 'Pickup address:',
			   's_street' => 'Street name:',
			   's_postcode' => 'Post code:',
			   's_city' => 'City/Town:',
			   's_country' => 'Region:',
			   's_receiver' => 'Recipient:',
			   's_receiver_address' => 'Destination address:',
			   's_details' => 'Order details',
			   's_date' => 'Date:',
			   's_quantity' => 'Number of items:',
			   's_payment_form' => 'Payment:',
			   's_payment_currency' => 'Pay in:',
			   's_info' => 'Additional information:',

			   't_name' => 'Full name or company name:',
			   't_passenger' => 'Passenger full name:',
			   't_date_departure' => 'Departure date:',
			   't_date_return' => 'Return date:',
			   't_persons' => 'Passengers:',
			   't_children_age' => 'Including children with ages:',
			   't_luggage' => 'Luggage items:',
			   't_departure' => 'Departure address:',
			   't_arrival' => 'Arrival address:',
			   't_confirmation' => 'Reservation confirmation:',

			   'i_invoice' => 'Invoice:',
			   'i_yes' => 'YES',
			   'i_for' => 'For:',
			   'i_taxid' => 'Tax ID:',
			   'i_address' => 'Full address:',
			   'i_info' => 'Additional information:',
			   'l_title' => 'Legend:',
			   'l_info' => 'Information:',
			   'l_info_n' => 'new',
			   'l_info_u' => 'updated',
			   'l_info_d' => 'removed'
			 );
			
		foreach ($cat_arr as &$item) {
			if($item->grupa == 64) {
				switch($item->id_kategorii) {
					case -1:
						$item->nazwa = 'when boarding';
						break;
					case -2:
						$item->nazwa = 'at destination';
						break;
					case -3:
						$item->nazwa = 'bank transfer';
						break;
					case -4:
						$item->nazwa = 'online';
						break;
				}
			} else if($item->grupa == 1 || $item->grupa == 2) {
				switch($item->id) {
					case 2:
						$item->nazwa = 'Passenger transfer';
						break;
					case 3:
						$item->nazwa = 'Packages';
						break;
				}
			}
		}
	}
	
	$payment_form = getCategory($data['forma_platnosci'], $cat_arr);
	
	$e_message = "";
	if($kategoria == 2) {
		$e_message .= getFieldValue(getCategory($data['kategoria'], $cat_arr), getCategory($oldData['kategoria'], $cat_arr), $transl['s_category']);
		$e_message .= '<br>';
		$e_message .= getFieldValue($data['imie_nazwisko'], $oldData['imie_nazwisko'], $transl['s_sender']);
		$e_message .= getFieldValue($data['tel_1'], $oldData['tel_1'], $transl['s_phone']);
		$e_message .= getFieldValue($data['tel_2'], $oldData['tel_2'], $transl['s_phone']);
		$e_message .= getFieldValue($data['email'], $oldData['email'], $transl['s_email']);
		$e_message .= "\r\n";
		$e_message .= $transl['s_sender_address'] . '<br>';
		$e_message .= getFieldValue($data['adres_z'], $oldData['adres_z'], ' &nbsp; &nbsp; ' . $transl['s_street']);
		$e_message .= getFieldValue($data['kod_z'], $oldData['kod_z'], ' &nbsp; &nbsp; ' . $transl['s_postcode']);
		$e_message .= getFieldValue($data['miejscowosc_z'], $oldData['miejscowosc_z'], ' &nbsp; &nbsp; ' . $transl['s_city']);
		$e_message .= getFieldValue($data['kraj_z'], $oldData['kraj_z'], ' &nbsp; &nbsp; ' . $transl['s_country']);
		$e_message .= getFieldValue($data['imie_nazwisko2'], $oldData['imie_nazwisko2'], $transl['s_receiver']);
		$e_message .= getFieldValue($data['tel2_1'], $oldData['tel2_1'], $transl['s_phone']);
		$e_message .= getFieldValue(@$data['tel2_2'], @$oldData['tel2_2'], @$transl['s_phone']);
		$e_message .= getFieldValue(@$data['dokument2'], @$oldData['dokument2'], @$transl['s_email']);
		$e_message .= "\r\n";
		$e_message .= $transl['s_receiver_address'] . '<br>';
		$e_message .= getFieldValue($data['adres_do'], $oldData['adres_do'], ' &nbsp; &nbsp; ' . $transl['s_street']);
		$e_message .= getFieldValue($data['kod_do'], $oldData['kod_do'], ' &nbsp; &nbsp; ' . $transl['s_postcode']);
		$e_message .= getFieldValue($data['miejscowosc_do'], $oldData['miejscowosc_do'], ' &nbsp; &nbsp; ' . $transl['s_city']);
		$e_message .= getFieldValue($data['kraj_do'], $oldData['kraj_do'], ' &nbsp; &nbsp; ' . $transl['s_country']);
		$e_message .= "\r\n";
		$e_message .= $transl['s_details'] . '<br>';
		$e_message .= getFieldValue($data['data'], $oldData['data'], ' &nbsp; &nbsp; ' . $transl['s_date']);
		$e_message .= getFieldValue($data['ilosc_bagazu'], $oldData['ilosc_bagazu'], ' &nbsp; &nbsp; ' . $transl['s_quantity']);
		$e_message .= getFieldJsonValue(@$data['detale'], @$oldData['detale'], ' &nbsp; &nbsp; &nbsp; ', 'detale');
		
		$e_message .= getFieldValue($payment_form, getCategory($oldData['forma_platnosci'], $cat_arr), ' &nbsp; &nbsp; ' . $transl['s_payment_form']);
		$e_message .= getFieldValue($data['waluta_platnosci'], $oldData['waluta_platnosci'], ' &nbsp; &nbsp; ' . $transl['s_payment_currency']);
		$e_message .= getFieldValue($data['informacje'], $oldData['informacje'], ' &nbsp; &nbsp; ' . $transl['s_info']);
		$e_message .= "\r\n";
		$e_message .= getInvoiceValue($data['faktura'], $data['dane_faktury'], $oldData['faktura'], $oldData['dane_faktury'], $transl);		
	} else {
		$e_message .= getFieldValue(getCategory($data['kategoria'], $cat_arr), getCategory($oldData['kategoria'], $cat_arr), $transl['s_category']);
		$e_message .= '<br>';
		$e_message .= getFieldValue($data['imie_nazwisko'], $oldData['imie_nazwisko'], $transl['t_name']);
		$e_message .= getFieldValue(@$data['imie_nazwisko2'], @$oldData['imie_nazwisko2'], $transl['t_passenger']);
		$e_message .= getFieldValue($data['data'], $oldData['data'], $transl['t_date_departure']);
		if($return_date) {
			$e_message .= getFieldValue($return_date, $return_date, $transl['t_date_return']);
		}
		$e_message .= getFieldValue($data['osob'], $oldData['osob'], $transl['t_persons']);
		$e_message .= getFieldJsonValue($data['dzieci'], $oldData['dzieci'], $transl['t_children_age'], 'dzieci');
		$e_message .= getFieldValue($data['ilosc_bagazu'], $oldData['ilosc_bagazu'], $transl['t_luggage']);
		
		$e_message .= getFieldValue($payment_form, getCategory($oldData['forma_platnosci'], $cat_arr), $transl['s_payment_form']);
		$e_message .= getFieldValue($data['waluta_platnosci'], $oldData['waluta_platnosci'], $transl['s_payment_currency']);
		
		$e_message .= getInvoiceValue($data['faktura'], $data['dane_faktury'], $oldData['faktura'], $oldData['dane_faktury'], $transl);
		$e_message .= "\r\n";
		$e_message .= $transl['t_departure'] . '<br>';
		$e_message .= getFieldValue($data['adres_z'], $oldData['adres_z'], ' &nbsp; &nbsp; ' . $transl['s_street']);
		$e_message .= getFieldValue($data['kod_z'], $oldData['kod_z'], ' &nbsp; &nbsp; ' . $transl['s_postcode']);
		$e_message .= getFieldValue($data['miejscowosc_z'], $oldData['miejscowosc_z'], ' &nbsp; &nbsp; ' . $transl['s_city']);
		$e_message .= getFieldValue($data['kraj_z'], $oldData['kraj_z'], ' &nbsp; &nbsp; ' . $transl['s_country']);
		$e_message .= "\r\n";
		$e_message .= $transl['t_arrival'] . '<br>';
		$e_message .= getFieldValue($data['adres_do'], $oldData['adres_do'], ' &nbsp; &nbsp; ' . $transl['s_street']);
		$e_message .= getFieldValue($data['kod_do'], $oldData['kod_do'], ' &nbsp; &nbsp; ' . $transl['s_postcode']);
		$e_message .= getFieldValue($data['miejscowosc_do'], $oldData['miejscowosc_do'], ' &nbsp; &nbsp; ' . $transl['s_city']);
		$e_message .= getFieldValue($data['kraj_do'], $oldData['kraj_do'], ' &nbsp; &nbsp; ' . $transl['s_country']);
		$e_message .= "\r\n";
		$e_message .= $transl['t_confirmation'] . '<br>';
		$e_message .= getFieldValue($data['tel_1'], $oldData['tel_1'], ' &nbsp; &nbsp; ' . $transl['s_phone']);
		$e_message .= getFieldValue($data['tel_2'], $oldData['tel_2'], ' &nbsp; &nbsp; ' . $transl['s_phone']);
		$e_message .= getFieldValue($data['email'], $oldData['email'], ' &nbsp; &nbsp; ' . $transl['s_email']);
		$e_message .= getFieldValue($data['informacje'], $oldData['informacje'], $transl['s_info']);
	}
	$e_message .= '<p></p>';
	
	if(strpos($e_message, '#dff0d8') !== false || strpos($e_message, '#f2dede') !== false || strpos($e_message, '#fad169') !== false) {
		$e_message .= "\r\n";
		$e_message .= $transl['l_title'] . '<br>';
		$e_message .= '<span style="background-color: #dff0d8;">' . $transl['l_info'] . ' <b>' . $transl['l_info_n'] . '</b></span><br>';
		$e_message .= $transl['l_info'] . ' <b style="background-color: #fad169;">' . $transl['l_info_u'] . '</b><br>';
		$e_message .= '<span style="background-color: #f2dede;">' . $transl['l_info'] . ' <b>' . $transl['l_info_d'] . '</b></span><br>';
	}
	return $e_message;
}

/****************************************************************************************************************
 db_newOrder($conn, $data, $return_date, $lang)
 @param $conn - connection object
 @param $data - an array of fields and values (where the key is field name)
 @param $return_date - if specified then the second order is created with oposite direction and return date, can be NULL if no return.
 @param $lang - language (en, pl)
 @return TRUE if successfully created, otherwise FALSE.

 The $data is of the following format:
		$data = array(
			'id_wlasciciela' => -1,            //OPTIONAL: not NULL, -1 if passenger is not from DB, can be skipped
			'id_pasazera' => -1,               //OPTIONAL: not NULL, -1 if passenger is not from DB, can be skipped
			'imie_nazwisko' => 'Jan Kowalski', //REQUIRED: not NULL
			'email' => $_POST['_email'],       //OPTIONAL: can be skipped or NULL
			'tel_1' => $_POST['_telefon'],     //OPTIONAL: can be skipped or NULL
			'tel_2' => NULL,                   //OPTIONAL: can be skipped or NULL

			'id_adres_z' => -1,                //OPTIONAL: not NULL, -1 if the address is not from DB, can be skipped
			'id_regionu_z' => -1,              //OPTIONAL: not NULL, -1 if the address is not from DB, can be skipped
			'kraj_z' => $_POST['_z_kraj'],     //REQUIRED: not NULL
			'miejscowosc_z' => $_POST['_z_miejscowosc'],//REQUIRED: not NULL
			'adres_z' => $_POST['_z_ulica'],   //OPTIONAL: can be skipped or NULL
			'kod_z' => $_POST['_z_kod'],       //OPTIONAL: can be skipped or NULL
			'lat_z' => NULL,                   //OPTIONAL: can be skipped or NULL
			'lng_z' => NULL,                   //OPTIONAL: can be skipped or NULL

			'id_adres_do' => -1,               //OPTIONAL: not NULL, -1 if the address is not from DB, can be skipped
			'id_regionu_do' => -1,             //OPTIONAL: not NULL, -1 if the address is not from DB, can be skipped
			'kraj_do' => $_POST['_do_kraj'],   //REQUIRED: not NULL
			'miejscowosc_do' => $_POST['_do_miejscowosc'],//REQUIRED: not NULL
			'adres_do' => $_POST['_do_ulica'], //OPTIONAL: can be skipped or NULL
			'kod_do' => $_POST['_do_kod'],     //OPTIONAL: can be skipped or NULL
			'lat_do' => NULL,                  //OPTIONAL: can be skipped or NULL
			'lng_do' => NULL,                  //OPTIONAL: can be skipped or NULL

			'data' => (new DateTime($_POST['_data']))->format("Y-m-d"), //REQUIRED: not NULL, yyyy-mm-dd
			'osob' => $_POST['_osob'],         //REQUIRED: not NULL
			'forma_platnosci' => -1,           //REQUIRED: not NULL -1 (Przy wsiadaniu), -2 (Na miejscu), -3 (Przelew), -4 (Płatność on-line)
			'waluta_platnosci' => NULL,        //OPTIONAL: currency code (PLN, EUR)
			'faktura' => FALSE,                //OPTIONAL: invoice (true or false)
			'dane_faktury' => NULL,            //OPTIONAL: NULL if invoice == true
			'ilosc_bagazu' => $_POST['_bagaz'],//OPTIONAL: can be skipped or NULL
			'informacje' => $_POST['_info'],   //OPTIONAL: can be skipped or NULL
			'id_powrotu' => -1, //-1 or skip if no return journey, ID of the return journey
			'zrodlo' => 1,                     //REQUIRED: 0-application, 1-WWW, 2-Android, 4-IOS, 8-Windows Mobile, 16-Client's Panel
			'kategoria' => CATEGORY_ID,        //REQUIRED: category ID from DB
			
			//category group can be extracted from CATEGORY_ID as follows:
			//group is 'travel' if (CATEGORY_ID >> 16) == 1
			//group is 'sending' if (CATEGORY_ID >> 16) == 2
										
			//additional fields for 'travel':
			'dzieci' => NULL,           //OPTIONAL: can be skipped or NULL; children in JSON [{"wiek":7},{"wiek":12}]						
			
			//additional fields for 'sending':
			'id_odbiorcy' => -1,        //REQUIRED: -1 for unknown user, ID for known user
			'imie_nazwisko2' => 'name', //REQUIRED: not NULL; name of the recipient 
			'tel2_1' => NULL,           //OPTIONAL: can be skipped or NULL; phone number of the recipient 
			'tel2_2' => NULL,           //OPTIONAL: can be skipped or NULL; phone number of the recipient 
			'dokument2' => NULL,        //OPTIONAL: can be skipped or NULL; document of the recipient 
			'detale' => NULL            //OPTIONAL: can be skipped or NULL; packages in JSON [{"c":50,"w":23,"s":12,"g":12},...]
 );
 ****************************************************************************************************************/
function db_newOrder($conn, $data, $return_date, $lang) {
	
	$kategoria = 1;
	if(is_numeric($data['kategoria'])) {
		$kategoria = ($data['kategoria'] >> 16);
		if($kategoria !== 2) {
			//wrong category then set to 'travel'
			$kategoria = 1;
		}
	}
	
	//fix boolean values
	if (isset($data['faktura'])) {
		$data['faktura'] = ($data['faktura'] ? 1 : 0);
	}

	switch($lang) {
		case 'pl':
			$message_title = ($kategoria == 2?'Zlecenie przesyłki (':'Rezerwacja przejazdu (') .$data['data'].')';
			$message_welcome = 'Zostało złożone zlecenie - <b>' . ($kategoria == 2?'PRZESYŁKA':'PRZEJAZD') . '</b><br>';
			break;
		default:
			$message_title = ($kategoria == 2?'Consignment commission (':'Transfer booking (') .$data['data'].')';
			$message_welcome = 'New order - <b>' . ($kategoria == 2?'CONSIGNMENT':'TRANSFER') . '</b><br>';
			break;
	}
	
	$payment_form = '';

	$message_content = db_messageForOrder($conn, $data, $return_date, $kategoria, null, $payment_form, $lang);
	
	// db_sendEmail($data['imie_nazwisko'], $data['email'], $message_title . ' (' . $payment_form . ')', $message_welcome . $message_content, COMPANY_EMAIL);
	
	// if(SEND_EMAIL_TO_CLIENT) {
	// 	switch($lang) {
	// 		case 'pl':
	// 			$message_welcome = '<p>Witaj '. $data['imie_nazwisko'] . ',</p><p>dziękujemy za skorzystanie z naszego systemu rezerwacji on-line.<br>';
	// 			$message_welcome .= 'Przyjęliśmy zlecenie o następującej treści:</p>';
	// 			$message_regards = '<p>Z poważaniem,<br>zespół ' . COMPANY_NAME . '</p>';
	// 			$message_content .= "\r\n";
	// 			$message_content .= '<p>Jeśli wybrałeś/wybrałaś płatność przelewem, to otrzymasz dane do przelewu w osobnym e-mailu.</p>';
	// 			$message_content .= "\r\n";
	// 			$message_content .= "<p>W przypadku płatności u kierowcy prosimy o zgłaszanie wszystkich nieprawidłowości związanych z wysokością kwoty lub zadeklarowaną walutą płatności.</p>";
	// 			$message_content .= "\r\n";
	// 			$message_content .= '<p>Pamiętaj, że złożenie zlecenia (w dowolnej formie) jest równoznaczne z zawarciem umowy pomiędzy Tobą a przewoźnikiem i ma konsekwencje prawne, zarówno w stosunku do Ciebie jak i przewoźnika. Dlatego pamiętaj, aby jak najwcześniej anulować zlecenie w przypadku, gdy nie będziesz mógł/mogła skorzystać z jego usług. W przeciwnym razie przewoźnik może obciążyć Cię poniesionymi stratami. Nie blokuj miejsca innym pasażerom.</p>';
	// 			$message_content .= "\r\n";
	// 			break;
	// 		default:
	// 			$message_welcome = '<p>Dear '. $data['imie_nazwisko'] . '.</p><p>Thank you for using our booking service.<br>';
	// 			$message_welcome .= 'We have received your booking with the following details:</p>';
	// 			$message_regards = '<p>Sincerely,<br>' . COMPANY_NAME . ' team.</p>';
	// 			$message_content .= "\r\n";
	// 			$message_content .= '<p>If you have chosen payment by bank transfer, you will receive bank details in a separate email.</p>';
	// 			$message_content .= "\r\n";
	// 			$message_content .= '<p>If the payment is made directly to the driver, let us know if there are any inaccuracies regarding the price or the payment currency. </p>';
	// 			$message_content .= "\r\n";
	// 			$message_content .= '<p>Remember, booking a transport service (whether using the online booking system, by telephone, email or in person), constitutes a legal agreement between you and ' . COMPANY_NAME . '. Therefore, if you are unable to use the service you have booked, you need to cancel the booking in advance. Failure to do so may incur a fee.</p>';
	// 			$message_content .= "\r\n";
	// 			break;
	// 	}
	// 	db_sendEmail(COMPANY_NAME, COMPANY_EMAIL, $message_title, $message_welcome . $message_content. $message_regards, $data['email']);
	// }

	$order_id = db_insertOrder($conn, $data);
	if(!$order_id) {
		return FALSE;
	}
	
	if($return_date) {
		$r_data = $data;//copy data
		
		//clean up informacje
		unset($r_data['informacje']);
		
		$r_data['id_powrotu'] = $order_id;
		
		$r_data['data'] = $return_date;
		//revert addresses
		$r_data['kraj_z'] = $data['kraj_do'];
		$r_data['miejscowosc_z'] = $data['miejscowosc_do'];
		$r_data['adres_z'] = $data['adres_do'];

		if($data['id_adres_do']) {
			$r_data['id_adres_z'] = $data['id_adres_do'];
		} else {
			$r_data['id_adres_z'] = -1;
		}
		if($data['id_regionu_do']) {
			$r_data['id_regionu_z'] = $data['id_regionu_do'];
		} else {
			$r_data['id_regionu_z'] = -1;
		}		
		if($data['kod_do']) {
			$r_data['kod_z'] = $data['kod_do'];
		} else {
			$r_data['kod_z'] = NULL;
		}
		if($data['lat_do']) {
			$r_data['lat_z'] = $data['lat_do'];
		} else {
			$r_data['lat_z'] = NULL;
		}
		if($data['lng_do']) {
			$r_data['lng_z'] = $data['lng_do'];
		} else {
			$r_data['lng_z'] = NULL;
		}
		
		$r_data['kraj_do'] = $data['kraj_z'];
		$r_data['miejscowosc_do'] = $data['miejscowosc_z'];
		$r_data['adres_do'] = $data['adres_z'];
		
		if($data['id_adres_z']) {
			$r_data['id_adres_do'] = $data['id_adres_z'];
		} else {
			$r_data['id_adres_do'] = -1;
		}
		if($data['id_regionu_z']) {
			$r_data['id_regionu_do'] = $data['id_regionu_z'];
		} else {
			$r_data['id_regionu_do'] = -1;
		}
		if($data['kod_z']) {
			$r_data['kod_do'] = $data['kod_z'];
		} else {
			$r_data['kod_do'] = NULL;
		}
		if($data['lat_z']) {
			$r_data['lat_do'] = $data['lat_z'];
		} else {
			$r_data['lat_do'] = NULL;
		}
		if($data['lng_z']) {
			$r_data['lng_do'] = $data['lng_z'];
		} else {
			$r_data['lng_do'] = NULL;
		}
		
		$return_order_id = db_insertOrder($conn, $r_data);
		if(!$return_order_id) {
			return FALSE;
		}
		
		$sth = $conn->prepare('UPDATE poczekalnia SET id_powrotu = ? WHERE id = ?;');
		$sth->execute(array($return_order_id, $order_id));
		
		if($sth->rowCount() > 0) {
			return TRUE;
		}
		return FALSE;
	}
	return TRUE;
}

function db_insertOrder($conn, $data) {
	if (!isset($data)) {
		return FALSE;
	}
	$valid_keys = array('id_pasazera', 'id_wlasciciela', 'imie_nazwisko', 'id_adres_z', 'id_adres_do', 'id_regionu_z', 'id_regionu_do', 'tel_1', 'tel_2', 'email', 'kraj_z', 'miejscowosc_z', 'adres_z', 'kod_z', 'lat_z', 'lng_z', 'kraj_do', 'miejscowosc_do', 'adres_do', 'kod_do', 'lat_do', 'lng_do', 'data', 'osob', 'dzieci', 'forma_platnosci', 'waluta_platnosci', 'faktura', 'dane_faktury', 'ilosc_bagazu', 'informacje', 'status_zamowienia', 'id_powrotu', 'zrodlo', 'kategoria', 'id_odbiorcy', 'imie_nazwisko2', 'tel2_1', 'tel2_2', 'dokument2', 'detale');

	$data['status_zamowienia'] = 0;//set state to 'New'
	
	$data_array = array();
	$indices = array();
	
	$keys = array_keys($data);
	foreach ($keys as $field_name) {
		$data_array[] = $data[$field_name];
		$indices[] = "?";
		if(!in_array($field_name, $valid_keys)){
			ini_set("log_errors", 1);
			ini_set("error_log", "my-errors.log");
			error_log( 'insert order has failed - unknown field ' . $field_name );
			return FALSE;
		}
	}

	$query = 'INSERT INTO poczekalnia (' . implode(', ', $keys) . ') VALUES (' . implode(', ', $indices) . ')';
	$sth = $conn->prepare($query);
	$sth->execute($data_array);

	if($sth->rowCount() != 0) {
		return $conn->lastInsertId('poczekalnia_id_seq');
	}
	return FALSE;
}

/****************************************************************************************************************
 db_getRegions($conn)
 @param $conn - connection object
 @return table of regions, or empty array.

  The list of fields in region_row:
  	$region_row->id
  	$region_row->nazwa_regionu
  	$region_row->kraj
****************************************************************************************************************/
function db_getRegions($conn) {
	$sth = $conn->prepare('SELECT id, nazwa_regionu, kraj FROM regiony;');
	$sth->execute();
	return $sth->fetchAll(PDO::FETCH_OBJ);
}
/****************************************************************************************************************
 db_getCategories($conn)
 @param $conn - connection object
 @return table of categories, or empty array.

  The list of fields in category_row:
    	$category_row->id
    	$category_row->id_kategorii
    	$category_row->nazwa
    	$category_row->grupa (1 - travel, 2 - shipment, 32 - payment status, 64 - payment form)
****************************************************************************************************************/
function db_getCategories($conn) {
	$sth = $conn->prepare('SELECT id, id_kategorii, nazwa, grupa FROM kategorie WHERE grupa > 0 AND online = true ORDER BY kolejnosc;');
	$sth->execute();
	return $sth->fetchAll(PDO::FETCH_OBJ);
}


