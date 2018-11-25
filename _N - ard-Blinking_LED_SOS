//TITLE
//Send an SOS via LED 12


const int LED = 12; //LED connected to digital pin 12


//Define morse contants

  //Define time multiplier
const int MULT = 300;

  //Define morse timing relationship
const int DOT = 1*MULT;
const int SPACE = 1*MULT;
const int LINE = 3*MULT;
const int CHAR_SPACE = 3*MULT;
const int WORD_SPACE = 7*MULT;


//Start the code

void setup() {
  pinMode(LED, OUTPUT);   // Initialize digital pin 12 as an output.

}

void loop() {
  blink_sos ();           // Blink SOS and repeat infinitely
}

void blink_sos () {

  blink_S ();                     //Blink S
  delay (CHAR_SPACE);             // Character space
  
  blink_O ();                     //Blink O
  delay (CHAR_SPACE);             // Character space
  
  blink_S ();                     //Blink S
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
