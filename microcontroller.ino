#include <ESP32Servo.h>
#include <ESP32PWM.h>
#ifdef ESP32
  #include <WiFi.h>
  #include <HTTPClient.h>
  #include <WiFiClient.h>
#else
  #include <ESP8266WiFi.h>
  #include <ESP8266HTTPClient.h>
  #include <WiFiClient.h>
#endif

// Network SSID
const char* WLAN_SSID = "Hehe"; // ubah ssid
const char* WLAN_PASS = "11223345"; //ubah password

//IP Server
const char* host = "smartclothesline.mdbgo.io";

// Deklarasi pin
int pin_sensor_air = 15;
int pin_sensor_cahaya = 4;
int pin_servo = 2;
int data_hujan = 0;
int data_cahaya = 0;
int led1 = 5;
int led2 = 19;
int led3 = 23;
Servo motorServo;  // Objek Servo

// Variabel kalibrasi
int servoMin = 0;   // Posisi minimum servo
int servoMax = 180; // Posisi maksimum servo
int currentServoPos = 0; // Posisi awal servo

// Variabel tambahan untuk melacak status dan putaran
int maxPutaran = 1;
int putaranSaatIni = 0;
bool jemuranTerbuka = true;  // Status apakah jemuran terbuka
bool sekali = false;
bool hujanTerang = false;

int currentDegree = 90;  // Posisi awal servo (90 derajat)
String cuaca = "Cerah";
bool cahaya = true; 

void setup() {
  ESP32PWM::allocateTimer(0);
  motorServo.attach(pin_servo);
  motorServo.setPeriodHertz(50); // Setting frekuensi servo
  Serial.begin(9600);
  pinMode(pin_sensor_air, INPUT);     // Sensor hujan
  pinMode(pin_sensor_cahaya, INPUT);  // Sensor cahaya
  pinMode(led1, OUTPUT);
  pinMode(led2, OUTPUT);
  pinMode(led3, OUTPUT);
  // pinMode(lampuLuar, OUTPUT);

  // BlynkEdgent.begin();
  // Koneksi WIFI
  Serial.println(); Serial.println();
  Serial.print("Connecting to ");
  Serial.println(WLAN_SSID);

  WiFi.begin(WLAN_SSID, WLAN_PASS);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println();
  Serial.println("WiFi connected");
  Serial.println("IP address: "); Serial.println(WiFi.localIP());
}

void loop() {
  // Koneksi ke server
  WiFiClient client;
  const int httpPort = 	80;

  // uji koneksi server
  if(!client.connect(host, httpPort)){
    Serial.println("Gagal koneksi ke server");
    return;
  }


  // Serial.println("Berhasil koneksi ke server");
  String LinkJemur;
  HTTPClient httpJemur;
  LinkJemur = "http://"+String(host)+"/conf/bacajemur.php";
  httpJemur.begin(LinkJemur);
  httpJemur.GET();
  String responseJemur = httpJemur.getString();
  Serial.println(responseJemur);
  httpJemur.end();

  // Posisi
  String LinkPosisi;
  HTTPClient httpPosisi;
  LinkPosisi = "http://"+String(host)+"/conf/bacaposisi.php";
  httpPosisi.begin(LinkPosisi);
  httpPosisi.GET();
  String responsePosisi = httpPosisi.getString();
  Serial.println(responsePosisi);
  httpPosisi.end();

  String LinkPosisiTutup;
  HTTPClient httpPosisiTutup;
  LinkPosisiTutup = "http://"+String(host)+"/conf/bacaposisiTutup.php";
  httpPosisiTutup.begin(LinkPosisiTutup);
  httpPosisiTutup.GET();
  String responsePosisiTutup = httpPosisiTutup.getString();
  Serial.println(responsePosisiTutup);
  httpPosisiTutup.end();

  // Posisi
  String LinkMode;
  HTTPClient httpMode;
  LinkMode = "http://"+String(host)+"/conf/bacamode.php";
  httpMode.begin(LinkMode);
  httpMode.GET();
  String responseMode = httpMode.getString();
  Serial.println(responseMode);
  httpMode.end();

  Serial.println(responseJemur);
  Serial.println(responsePosisi);
  Serial.println(responseMode);


  

  // Membaca data dari sensor hujan
  data_hujan = analogRead(pin_sensor_air);
  bool hujan = data_hujan > 500;
  Serial.print("hujan");
  Serial.println(data_hujan);

  // Membaca data dari sensor cahaya
  data_cahaya = digitalRead(pin_sensor_cahaya);
  bool gelap = data_cahaya; // Asumsi nilai cahaya rendah berarti gelap
  bool terang = !data_cahaya;

  if(gelap){
    cahaya = false;
  }else{
    cahaya = true;
  }

  if(hujan && data_cahaya){
    cuaca = "Hujan Gelap";
    digitalWrite(led2, HIGH);
    digitalWrite(led1, LOW);
    digitalWrite(led3, LOW);

  }else if (hujan && !data_cahaya){
    cuaca = "Hujan Terang";
    digitalWrite(led1, HIGH);
    digitalWrite(led2, LOW);
    digitalWrite(led3, LOW);
  }else if (!hujan && data_cahaya) {
    cuaca = "Mendung";
    digitalWrite(led1, HIGH);
    digitalWrite(led2, LOW);
    digitalWrite(led3, LOW);
  }else if (!hujan && !data_cahaya){
    cuaca = "Cerah";
    digitalWrite(led3, HIGH);
    digitalWrite(led2, LOW);
    digitalWrite(led1, LOW);
  }



  

  if (!sekali){ // identifikasi awal menentukan kondisi
    if (terang ){
      jemuranTerbuka = false;
      sekali = true;
    }
    else{
      jemuranTerbuka = true;
      sekali = true;
    }
  }
  // Serial.println("kondisi data , hujan : "+data_hujan+ " , data terang : "+terang+" + data gelap : "+gelap);
  // Logika membuka/menutup jemuran
  if(hujan && terang){
    motorServo.write(currentDegree);
  }
  hujanTerang = hujan && terang;
  // Serial.println(hujanTerang);

  // motorServo.write(responsePosisi.toInt());
  // Serial.print("bergerak ke");
  // Serial.println(responsePosisi.toInt());
  // delay(1000);
  // motorServo.write(90);

  if(responseMode.toInt() == 1){
    if (hujan || gelap || hujanTerang) { //jemuran tidak dijemur
      Serial.println("masuk gelap atau hujan");
      if (jemuranTerbuka) { //cek apakah jemuran terjemur
          if(putaranSaatIni < maxPutaran){
            Serial.println("Menutup Jemuran... ");
            currentDegree = 120;
            motorServo.write(currentDegree);
            putaranSaatIni++;
            delay(1000);
              // Gerakkan servo ke posisi menutup (0 derajat)
          }else{
            Serial.println("berhenti memnutup jemuran");
            jemuranTerbuka = false;
            putaranSaatIni = 0; 
            currentDegree = 90;
            motorServo.write(currentDegree);
          }
        }
      }
    if (terang && !hujanTerang) { // menjemur
      // Kondisi membuka jemuran
      Serial.println("masuk terang");
      if (!jemuranTerbuka && !hujanTerang) {
          if(putaranSaatIni < maxPutaran){
            Serial.println("Membuka Jemuran...");
            currentDegree = 60;
            motorServo.write(currentDegree);
            putaranSaatIni++; // Gerakkan servo ke posisi menutup (0 derajat)
            delay(1000);
          }else{
            Serial.println("berhenti membuka jemuran");
            jemuranTerbuka = true;
            putaranSaatIni = 0;
            currentDegree = 90;
            motorServo.write(currentDegree);
          }
        }
      }
    } else {
      // Mode Manual
      if(responseJemur.toInt() && !jemuranTerbuka){
        if(putaranSaatIni < maxPutaran){
          if(responsePosisi.toInt() < 90){
            Serial.println("Membuka Jemuran...");
            motorServo.write(responsePosisi.toInt());
            putaranSaatIni++; // Gerakkan servo ke posisi menutup (0 derajat)
            delay(1000);
          }else{
            Serial.println("Membuka Jemuran...");
            currentDegree = 60;
            motorServo.write(currentDegree);
            putaranSaatIni++; // Gerakkan servo ke posisi menutup (0 derajat)
            delay(1000);
          }
        }else{
          Serial.println("berhenti membuka jemuran");
          jemuranTerbuka = true;
          putaranSaatIni = 0;
          currentDegree = 90;
          motorServo.write(currentDegree);
        }
      } else if(!responseJemur.toInt() && jemuranTerbuka){
        if(putaranSaatIni < maxPutaran){
          if(responsePosisiTutup.toInt() > 90){
             Serial.println("Menutup Jemuran... ");
            motorServo.write(responsePosisiTutup.toInt());
            putaranSaatIni++;
            delay(1000);
          }else{
            Serial.println("Menutup Jemuran... ");
            currentDegree = 120;
            motorServo.write(currentDegree);
            putaranSaatIni++;
            delay(1000);
              // Gerakkan servo ke posisi menutup (0 derajat)
          }
        }else{
          Serial.println("berhenti memnutup jemuran");
          jemuranTerbuka = false;
          putaranSaatIni = 0; 
          currentDegree = 90;
          motorServo.write(currentDegree);
        }
      }
    }

  // Jika sudah mencapai putaran maksimum, tidak akan berputar lagi
     // Proses Mengirim Data Ke Server
  String Link;
  HTTPClient http;
  Link = "http://"+String(host)+"/conf/kirimdata.php?jemur="+ String(responseJemur) + "&posisi="+ String(responsePosisi)+"&posisiTutup="+String(responsePosisiTutup)+"&mode="+String(responseMode)+"&cuaca="+String(cuaca)+"&hujan="+String(hujan)+"&cahaya="+String(cahaya);
  Serial.println(Link);
  http.begin(Link);
  http.GET();
  http.end();
  delay(1000);  
}