# born2code
Raccolta di esperienze di programmazione
_______________________________________________

Questa repository contiene alcuni estratti delle mie esperienze di programmazione.
I file sono ordinati in ordine cronologico, dal meno recente (_0) al più recente (_6).

Di seguito una lista dei file più significativi e più sotto una spiegazione per ognuno dei file caricati.

## I più significativi:
*  **_3 - adr-rotazione-splash.php**    - Sistema di rotazione immagini a logica esperienziale/temporale
*  **_6 - ard-Blinking_LED_SOS.ino**    - Sketch Arduino
*  **_5 - adr-racconti-premiati.php**   - Interfaccia backend per la visualizzazione di racconti premiati

_______________________________________________

## Contenuto dei file

### _3 - adr-rotazione-splash.php

**Sistema di rotazione immagini a logica esperienziale/temporale**

**Ambito:** Wordpress / PHP / JS / JQ

**Link:** https://accademia.leonardomancori.com

**Obiettivo:** Cambiare il tema di un sito sostituendo le immagini di sfondo dell'header, le relative citazioni ed altri elementi legati alla stessa immagine.
Ogni utente, a prescindere dal proprio comportamento e dalle proprie abitudini di utilizzo del sito, deve poter visualizzare le immagini sempre nella stessa successione e mai troppo frequentemente, sia per non compromettere l'identità visiva del sito, sia per non creare disorientamento durante la navigazione.

**Spiegazione:**
Il sistema realizzato sfrutta le sessioni del server e i cookie tecnici per mostrare il tema corretto (su qualunque pagina) in base al tempo passato dalla prima visualizzazione del tema corrente.
A seconda del tema attualmente attivo viene printato sul documento uno script JQuery che cambia le classi responsabili della visualizzazione delle immagini di sfondo. Le citazioni vengono invece selezionate da un array a corrispondenza biunivoca tema - citazione.

**Immagini**

1. https://ibb.co/z5b8DpD
1. https://ibb.co/pJMJXPS
1. https://ibb.co/nzvb8KH
1. https://ibb.co/jbMvY4S
1. https://ibb.co/VTh27Mb
1. https://ibb.co/jDXN1yK
1. https://ibb.co/7rKtYNF
1. https://ibb.co/jvVPxz7
1. ![GitHub Logo](/born2code/images/adr/_1.png) 
1. ![GitHub Logo](/born2code/images/adr/_2.png)
1. ![GitHub Logo](/born2code/images/adr/_3.png)
1. ![GitHub Logo](/born2code/images/adr/_4.png)
1. ![GitHub Logo](/born2code/images/adr/_5.png)
1. ![GitHub Logo](/born2code/images/adr/_6.png)
1. ![GitHub Logo](/born2code/images/adr/_7.png)
1. ![GitHub Logo](/born2code/images/adr/_8.png)




### _6 - ard-Blinking_LED_SOS.ino

**Sketch Arduino**

**Ambito:** Arduino IDE / Prima esperienza

**Obiettivo:** Far lampeggiare un messaggio di SOS in codice Morse.

**Spiegazione:**
Ho riportato i rapporti tratto punto spazio (https://en.wikipedia.org/wiki/Morse_code#Representation,_timing,_and_speeds) in delle variabili iniziali, moltiplicandoli per una costante (attraverso la quale ho potuto modificare la velocità di trasmissione del messaggio).
Ho definito le funzioni blink_S e blink_O, richiamandole poi in blink_sos (alternate a dei delay definiti dalle variabili iniziali).

**Nota:** Il branch v2 è una versione modificata per segnalare la fine trasmissione di ogni SOS attraverso un altro led





Indice:
*  _0 - arg-function.php
*  _1 - adr-draft_to_pendig_date_time.php
*  _2 - adr-adr_get_prize.php
*  _3 - adr-rotazione-splash.php
*  _4 - adr-racconti-archivio.php
*  _5 - adr-racconti-premiati.php
*  _6 - ard-Blinking_LED_SOS.ino
  

