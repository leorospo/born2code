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


<!-- D. La magia delle immagini -->
		<script>
			
			quote = new Array(4)																		// 4 = numero di citazioni presenti nell'array
			quote[0] = 'Scrivete delle questioni che vi toccano. Sono le sole cose di cui vale la pena scrivere.'
			quote[1] = 'Le parole sono, nella mia non modesta opinione, la nostra massima e inesauribile fonte di magia.'
			quote[2] = 'Amo le frasi che non si sposterebbero di un millimetro nemmeno se le attraversasse un esercito.'
			quote[3] = 'Il talento è solo uno strumento. È come avere una penna che scrive invece di una che non scrive.'
			
			
			author = new Array(4)																		// 4 = numero di autori presenti nell'array
			author[0] = 'Chuck Palahniuk'
			author[1] = 'Albus Silente'
			author[2] = 'Virginia Woolf'
			author[3] = 'David Foster Wallace'

			
			<?php
				if (isset($_SESSION['adr_current_theme'])) {
			?>

					//Display theme
					$( document ).ready(function() {
						
			<?php
						switch ($_SESSION['adr_current_theme']):

							case 0:
								echo '$("#splash").addClass("splash-sea");';
								echo '$("#quote-space").addClass("quote-TR");';
								echo '$("#cta").addClass("cta-sea");';
								break;

							case 1:
								echo '$("#splash").addClass("splash-ship");';
								echo '$("#quote-space").addClass("quote-TL");';
								echo '$("#cta").addClass("cta-ship");';
								break;

							case 2:
								echo '$("#splash").addClass("splash-mount");';
								echo '$("#quote-space").addClass("quote-TL");';
								echo '$("#cta").addClass("cta-mount");';
								break;

							case 3:
								echo '$("#splash").addClass("splash-ice");';
								echo '$("#quote-space").addClass("quote-TL");';
								echo '$("#cta").addClass("cta-ice");';
								break;

						endswitch;
			?>
						$('.quote-text').text( get_related_quote() );
						$('.quote-author').text( get_related_quote_author() );

					});
			
					function get_related_quote() {
						return(quote[<?php echo $_SESSION['adr_current_theme']; ?>])
					}

					function get_related_quote_author() {
						return(author[<?php echo $_SESSION['adr_current_theme']; ?>])
					}

			<?php

				} else {
			?>

					//Qualcosa è andato storto con i cookie e le sessioni, mostriamo una roba base
					$( document ).ready(function() {
						$("#splash").addClass("splash-sea");
						$('.quote-text').text( get_related_quote() );
						$('.quote-author').text( get_related_quote_author() );
						$("#quote-space").addClass("quote-TR");
						$("#cta").addClass("cta-sea");
						
					});
					
					function get_related_quote() {
						return(quote[0])
					}

					function get_related_quote_author() {
						return(author[0])
					}
			
			<?php

				}
			?>
			
		</script>
