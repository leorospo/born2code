<?php
	session_start();
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];
?>


<?php	//ROTAZIONE DEGLI HEADER E DELLE CITAZIONI
	if (!isset($_COOKIE['adr_next_time_theme'])) {							// SE NON SONO MAI STATO SUL SITO, HO CANCELLATO I COOKIE, O SONO PASSATI 30g DA L'ULTIMA VISITA (cookie non presenti)
		
		$img_num = 0;																// Immagine da visualizzare
		$_SESSION['adr_current_theme'] = $img_num ;									// Setta la sessione con immagine da visualizzare
		setcookie('adr_next_time_theme', ++$img_num, time()+86400*30, '/');			// Setta il cookie immagine successiva +1 - scade in 30 giorni
		setcookie('adr_theme_expire', 'expire', time()+86400, '/');						// Setta il cookie scadenza - scade in 24 ore
		
		
	} elseif ( $_COOKIE['adr_next_time_theme'] <= 3 ) {						// SE IL COOKIE DICE CHE SONO TRA LA PRIMA E L'ULTIMA ILLUSTRAZIONE	// numero di illustrazioni meno 1 perchè c'è lo 0
		
		if (isset($_COOKIE['adr_theme_expire'])) {									// E IL COOKIE SCADENZA NON è SCADUTO
			$_SESSION['adr_current_theme'] = --$_COOKIE['adr_next_time_theme'];			// assicurati che session abbia il giusto valore (-1 rispetto al registrato)
			
		} else {																	// E IL COOKIE SCADENZA è SCADUTO
			$img_num = $_COOKIE['adr_next_time_theme'];									// Immagine da visualizzare
			$_SESSION['adr_current_theme'] = $img_num ;									// Setta la sessione con immagine da visualizzare
			setcookie('adr_next_time_theme', ++$img_num, time()+86400*30, '/');			// Setta il cookie immagine successiva +1 - scade in 30 giorni
			setcookie('adr_theme_expire', 'expire', time()+86400, '/');						// Setta il cookie scadenza - scade in 24 ore
			
		}
	} else { 																	// SE LA VOLTA SCORSA HO VISTO L'ULTIMA IMG
		
		if (isset($_COOKIE['adr_theme_expire'])) {									// E IL COOKIE SCADENZA NON è SCADUTO
			$_SESSION['adr_current_theme'] = --$_COOKIE['adr_next_time_theme'];			// assicurati che session abbia il giusto valore (-1 rispetto al registrato)
			
		} else {																	// E IL COOKIE SCADENZA è SCADUTO
			session_destroy();															// cancella i dati della sesisone
			session_start();															// ricominciamo a registrare dati sessione

			$img_num = 0;																// Immagine da visualizzare
			$_SESSION['adr_current_theme'] = $img_num ;									// Setta la sessione con immagine da visualizzare
			setcookie('adr_next_time_theme', 1, time()+86400*30, '/');					// Setta il cookie immagine successiva a 0
			setcookie('adr_theme_expire', 'expire', time()+86400, '/');						// Setta il cookie scadenza - scade in 24 ore
		}
	}
?>
