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

Tip: Tasto destro, visualizza immagine


![GitHub Logo](https://github.com/leorospo/born2code/blob/master/images/adr/_1.PNG) | ![GitHub Logo](https://github.com/leorospo/born2code/blob/master/images/adr/_2.PNG) | ![GitHub Logo](https://github.com/leorospo/born2code/blob/master/images/adr/_3.PNG)
------------ | ------------- | ------------
![GitHub Logo](https://github.com/leorospo/born2code/blob/master/images/adr/_4.PNG) | ![GitHub Logo](https://github.com/leorospo/born2code/blob/master/images/adr/_5.PNG) | ![GitHub Logo](https://github.com/leorospo/born2code/blob/master/images/adr/_6.PNG)
![GitHub Logo](https://github.com/leorospo/born2code/blob/master/images/adr/_7.PNG) | ![GitHub Logo](https://github.com/leorospo/born2code/blob/master/images/adr/_8.PNG)

### _6 - ard-Blinking_LED_SOS.ino

**Sketch Arduino**

**Ambito:** Arduino IDE / Prima esperienza

**Obiettivo:** Far lampeggiare un messaggio di SOS in codice Morse.

**Spiegazione:**
Ho riportato i rapporti tratto punto spazio (https://en.wikipedia.org/wiki/Morse_code#Representation,_timing,_and_speeds) in delle variabili iniziali, moltiplicandoli per una costante (attraverso la quale ho potuto modificare la velocità di trasmissione del messaggio).
Ho definito le funzioni blink_S e blink_O, richiamandole poi in blink_sos (alternate a dei delay definiti dalle variabili iniziali).

**Nota:** Il branch v2 è una versione modificata per segnalare la fine trasmissione di ogni SOS attraverso un altro led


### _5 - adr-racconti-premiati.php

**Interfaccia backend per la visualizzazione di racconti premiati**

**Ambito:** Wordpress / PHP

**Obiettivo:** Realizzare un interfaccia backend di visualizzazione dei racconti premiati.

**Spiegazione:**
Il file è il template di una pagina di amministrazione del backend di wordpress.
Con delle variabili GET inserite nell'url si è realizzata l'interfaccia a schede, mantenendo uno stile simile al resto del backend di wp.
Applicando tutte le sicurezze del caso si imposta una query per la visualizzazione dei racconti pubblicati, filtrandoli per data di pubblicazione tra le varie schede.
Restituisce messaggi di errore personalizzati a seconda del problema riscontrato e delle capabilities dell'utente.

**Immagini**

Tip: Tasto destro, visualizza immagine

![GitHub Logo](https://github.com/leorospo/born2code/blob/master/images/adr/_9.PNG) | ![GitHub Logo](https://github.com/leorospo/born2code/blob/master/images/adr/_10.PNG)
------------ | -------------
![GitHub Logo](https://github.com/leorospo/born2code/blob/master/images/adr/_11.PNG) | ![GitHub Logo](https://github.com/leorospo/born2code/blob/master/images/adr/_12.PNG)
![GitHub Logo](https://github.com/leorospo/born2code/blob/master/images/adr/_13.PNG)



  

