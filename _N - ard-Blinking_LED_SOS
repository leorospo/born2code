//TITLE
//Send an SOS via LED 12 and signal the start of a new message


const int LED = 12; //LED connected to digital pin 12
const int END_LED = 11; //LED connected to digital pin 11


//Define morse contants

  //Define time multiplier
const int MULT = 250;

  //Define morse timing relationship
const int DOT = 1*MULT;
const int SPACE = 1*MULT;
const int LINE = 3*MULT;
const int CHAR_SPACE = 3*MULT;
const int WORD_SPACE = 7*MULT;


//Start the code

void setup() {
  pinMode(LED, OUTPUT);   // Initialize digital pin 12 as an output.
  pinMode(LED, OUTPUT);   // Initialize digital pin 12 as an output.


}

void loop() {
  blink_sos ();                   // Blink SOS
  digitalWrite (END_LED, HIGH);        // End message indicator on
  delay (100);
  digitalWrite (END_LED, LOW);         // End message indicator off
  delay (200);                     // Delay the start of a new mwssage


}

void blink_sos () {

  blink_S ();                     // Blink S
  delay (CHAR_SPACE);             // Character space
  
  blink_O ();                     // Blink O
  delay (CHAR_SPACE);             // Character space
  
  blink_S ();                     // Blink S
  delay (WORD_SPACE);             // Word space

  }

void blink_S () {
  digitalWrite (LED, HIGH);       // LED On
  delay (DOT);                    // Dot
  digitalWrite (LED, LOW);        // LED Off
  delay (SPACE);                  // Space
  
  digitalWrite (LED, HIGH);       // LED On
  delay (DOT);                    // Dot
  digitalWrite (LED, LOW);        // LED Off
  delay (SPACE);                  // Space
  
  digitalWrite (LED, HIGH);       // LED On
  delay (DOT);                    // Dot
  digitalWrite (LED, LOW);        // LED Off
  
  }

void blink_O () {
  digitalWrite (LED, HIGH);       // LED On
  delay (LINE);                   // Line
  digitalWrite (LED, LOW);        // LED Off
  delay (SPACE);                  // Space
  
  digitalWrite (LED, HIGH);       // LED On
  delay (LINE);                   // Line
  digitalWrite (LED, LOW);        // LED Off
  delay (SPACE);                  // Space
  
  digitalWrite (LED, HIGH);       // LED On
  delay (LINE);                   // Line
  digitalWrite (LED, LOW);        // LED Off

  }
