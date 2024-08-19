#include <Arduino.h>
#line 1 "C:\\xampp\\htdocs\\final\\Final-Project\\Arduino_ESP32\\Arduino_ESP32.ino"
#include <ArduinoJson.h>
#include <WiFiManager.h>
#include <HTTPClient.h>
#include <WiFiClientSecure.h>
#include <Wire.h>
#include "SparkFun_SCD30_Arduino_Library.h"

const char *serverAddress = "https://mushroom.aru-smart-farm.com/db/esp32-upload.php";

WiFiManager wm;
WiFiClientSecure *client = new WiFiClientSecure;

unsigned long period_sensor = 3000;
unsigned long period_relay = 2000;
unsigned long period_monitor = 5000;
unsigned long last_time_sensor = 0;
unsigned long last_time_relay = 0;
unsigned long last_time_monitor = 0;

int switch_pump, switch_fan, switch_valve, switch_led;
int pump = 32;
int valve = 33;
int fan = 25;
int led = 26;
int status_pump, status_fan, status_valve, status_led;
int config_status, config_temp, config_humi, config_co2;

int buttonPin = 16;
int buzzer = 22;

int voltPin = 35;
int voltage_offset = 20;
int volt;
double voltage;

SCD30 airSensor1;
SCD30 airSensor2;

#define SDA_1 27
#define SCL_1 14
#define SDA_2 12
#define SCL_2 13

float co2_1, temp_1, humidity_1;
float co2_2, temp_2, humidity_2;

#line 47 "C:\\xampp\\htdocs\\final\\Final-Project\\Arduino_ESP32\\Arduino_ESP32.ino"
void setup();
#line 96 "C:\\xampp\\htdocs\\final\\Final-Project\\Arduino_ESP32\\Arduino_ESP32.ino"
void loop();
#line 194 "C:\\xampp\\htdocs\\final\\Final-Project\\Arduino_ESP32\\Arduino_ESP32.ino"
void uploadData(float co2_1, float temp_1, float humi_1, float co2_2, float temp_2, float humi_2);
#line 219 "C:\\xampp\\htdocs\\final\\Final-Project\\Arduino_ESP32\\Arduino_ESP32.ino"
void fetchData();
#line 447 "C:\\xampp\\htdocs\\final\\Final-Project\\Arduino_ESP32\\Arduino_ESP32.ino"
void uploadStatus(int status_pump, int status_fan, int status_valve, int status_led, double voltage);
#line 472 "C:\\xampp\\htdocs\\final\\Final-Project\\Arduino_ESP32\\Arduino_ESP32.ino"
void WiFi_Reset();
#line 47 "C:\\xampp\\htdocs\\final\\Final-Project\\Arduino_ESP32\\Arduino_ESP32.ino"
void setup()
{
  digitalWrite(pump, HIGH);
  digitalWrite(fan, HIGH);
  digitalWrite(valve, HIGH);
  digitalWrite(led, HIGH);

  Serial.begin(115200);
  pinMode(pump, OUTPUT);
  pinMode(fan, OUTPUT);
  pinMode(valve, OUTPUT);
  pinMode(led, OUTPUT);

  pinMode(buttonPin, INPUT_PULLUP);
  pinMode(buzzer, OUTPUT);

  tone(buzzer, 650, 300);
  delay(400);
  tone(buzzer, 750, 300);
  delay(300);
  tone(buzzer, 850, 300);
  delay(300);

  Wire.begin(SDA_1, SCL_1);
  airSensor1.begin();

  Wire1.begin(SDA_2, SCL_2);
  airSensor2.begin(Wire1);

  airSensor1.beginMeasuring();
  airSensor2.beginMeasuring();

  if (wm.autoConnect("@WiFi To Mushroom"))
  {
    Serial.println("");
    Serial.println("Connected already WiFi :) ");
    Serial.println("IP Address : ");
    Serial.println(WiFi.localIP());
    tone(buzzer, 4000, 300);
    delay(10);
  }
  else
  {
    Serial.println("failed to connect and hit timeout");
    delay(2000);
    ESP.restart();
  }
}

void loop()
{
  client->setInsecure();

  // Get Switch And Upload Status Hardware
  if (millis() - last_time_relay > period_relay)
  {
    volt = analogRead(voltPin);
    voltage = map(volt, 0, 4096, 0, 1650) + voltage_offset;
    voltage /= 100;
    fetchData();
    Serial.println(" ");
    Serial.println(" ----- Relay ----- ");
    Serial.println(" ");
    Serial.print("Pump = ");
    Serial.print(status_pump);
    Serial.print(", Fan = ");
    Serial.print(status_fan);
    Serial.print(", Valve = ");
    Serial.print(status_valve);
    Serial.print(", Led = ");
    Serial.print(status_led);
    Serial.println(" ");

    Serial.print("Voltage: ");
    Serial.print(voltage);
    Serial.println("V");
    last_time_relay = millis();
  }

  // Get Sensor Value And Upload
  if (millis() - last_time_sensor > period_sensor)
  {
    // Check Sensor
    if (airSensor1.dataAvailable() || airSensor2.dataAvailable())
    {
      // Sensor 1
      if (airSensor1.dataAvailable())
      {
        co2_1 = airSensor1.getCO2();
        temp_1 = airSensor1.getTemperature();
        humidity_1 = airSensor1.getHumidity();
        // Monitor
        if (millis() - last_time_monitor > period_monitor)
        {
          Serial.println(" ");
          Serial.println(" ----- Senser1 ----- ");
          Serial.println(" ");
          Serial.print("Co2 = ");
          Serial.print(co2_1);
          Serial.println(" ppm");
          Serial.print("Temp = ");
          Serial.print(temp_1);
          Serial.println(" °C");
          Serial.print("Humi = ");
          Serial.print(humidity_1);
          Serial.println(" %");
          Serial.println(" ");
        }
      }

      // Sensor 2
      if (airSensor2.dataAvailable())
      {
        co2_2 = airSensor2.getCO2();
        temp_2 = airSensor2.getTemperature();
        humidity_2 = airSensor2.getHumidity();
        // Monitor
        if (millis() - last_time_monitor > period_monitor)
        {
          Serial.println(" ");
          Serial.println(" ----- Senser2 ----- ");
          Serial.println(" ");
          Serial.print("Co2 = ");
          Serial.print(co2_2);
          Serial.println(" ppm");
          Serial.print("Temp = ");
          Serial.print(temp_2);
          Serial.println(" °C");
          Serial.print("Humi = ");
          Serial.print(humidity_2);
          Serial.println(" %");
          Serial.println(" ");
        }
      }
      uploadData(co2_1, temp_1, humidity_1, co2_2, temp_2, humidity_2);
    }
  }

  // Control Hardware
  digitalWrite(pump, (status_pump == 1) ? LOW : HIGH);
  digitalWrite(fan, (status_fan == 1) ? LOW : HIGH);
  digitalWrite(valve, (status_valve == 1) ? LOW : HIGH);
  digitalWrite(led, (status_led == 1) ? LOW : HIGH);

  WiFi_Reset();
}

void uploadData(float co2_1, float temp_1, float humi_1, float co2_2, float temp_2, float humi_2)
{
  if (WiFi.status() == WL_CONNECTED)
  {
    String dataToSend = "co2_1=" + String(co2_1) + "&temp_1=" + String(temp_1) + "&humi_1=" + String(humi_1) + "&co2_2=" + String(co2_2) + "&temp_2=" + String(temp_2) + "&humi_2=" + String(humi_2);
    // Serial.println("Sending data to server...");
    HTTPClient https;
    https.begin(*client, serverAddress);
    https.addHeader("Content-Type", "application/x-www-form-urlencoded");
    int httpPOSTResponseCode = https.POST(dataToSend);

    if (httpPOSTResponseCode > 0)
    {
      String response = https.getString();
      // Serial.println(httpPOSTResponseCode);
    }
    else
    {
      Serial.println("การร้องขอล้มเหลว 1");
      Serial.println(https.errorToString(httpPOSTResponseCode).c_str());
    }
    https.end();
  }
}

void fetchData()
{
  if (WiFi.status() == WL_CONNECTED)
  {
    HTTPClient https;
    https.begin(*client, serverAddress);
    int httpResponseCode = https.GET();

    if (httpResponseCode == 200)
    {
      String response = https.getString();
      StaticJsonDocument<256> doc;
      DeserializationError error = deserializeJson(doc, response);

      if (!error)
      {
        config_status = doc["config_status"];
        config_temp = doc["config_temp"];
        config_humi = doc["config_humi"];
        config_co2 = doc["config_co2"];

        if (config_status == 1)
        {
          if (config_temp == 0 || config_humi == 0 || config_co2 == 0)
          {
            // ON Co2
            if (config_temp == 0 && config_humi == 0)
            {
              if (co2_1 > config_co2 + 500)
              {
                status_fan = 1;
              }
              else if (co2_1 <= config_co2)
              {
                status_fan = 0;
              }
            }
            // ON Humi
            else if (config_temp == 0 && config_co2 == 0)
            {
              if (humidity_1 < config_humi - 5)
              {
                status_pump = 1;
              }
              else if (humidity_1 >= config_humi)
              {
                status_pump = 0;
              }

              if (humidity_1 > config_humi + 5)
              {
                status_fan = 1;
              }
              else if (humidity_1 <= config_humi)
              {
                status_fan = 0;
              }
            }
            // ON Temp
            else if (config_humi == 0 && config_co2 == 0)
            {
              if (temp_1 > config_temp + 3)
              {
                status_pump = 1;
              }
              else if (temp_1 <= config_temp)
              {
                status_pump = 0;
              }

              if (abs(temp_1 - config_temp) > 3)
              {
                status_fan = 1;
              }
              else if (abs(temp_1 - config_temp) < 0.5)
              {
                status_fan = 0;
              }

              if (temp_1 > config_temp + 3)
              {
                status_valve = 1;
              }
              else if (temp_1 <= config_temp)
              {
                status_valve = 0;
              }
            }
            // ON Temp and Humi
            else if (config_co2 == 0)
            {
              if (temp_1 > config_temp + 3 || humidity_1 < config_humi - 5)
              {
                status_pump = 1;
              }
              else if (temp_1 <= config_temp && humidity_1 >= config_humi)
              {
                status_pump = 0;
              }

              if (abs(temp_1 - config_temp) > 3 || humidity_1 > config_humi + 5)
              {
                status_fan = 1;
              }
              else if (abs(temp_1 - config_temp) < 0.5 && humidity_1 <= config_humi)
              {
                status_fan = 0;
              }

              if (temp_1 > config_temp + 3)
              {
                status_valve = 1;
              }
              else if (temp_1 <= config_temp)
              {
                status_valve = 0;
              }
            }
            // ON Temp and Co2
            else if (config_humi == 0)
            {
              if (temp_1 > config_temp + 3)
              {
                status_pump = 1;
              }
              else if (temp_1 <= config_temp)
              {
                status_pump = 0;
              }

              if (abs(temp_1 - config_temp) > 3 || co2_1 > config_co2 + 500)
              {
                status_fan = 1;
              }
              else if (abs(temp_1 - config_temp) < 0.5 && co2_1 <= config_co2)
              {
                status_fan = 0;
              }

              if (temp_1 > config_temp + 3)
              {
                status_valve = 1;
              }
              else if (temp_1 <= config_temp)
              {
                status_valve = 0;
              }
            }
            // ON Humi and Co2
            else if (config_temp == 0)
            {
              if (humidity_1 < config_humi - 5)
              {
                status_pump = 1;
              }
              else if (humidity_1 >= config_humi)
              {
                status_pump = 0;
              }

              if (humidity_1 > config_humi + 5 || co2_1 > config_co2 + 500)
              {
                status_fan = 1;
              }
              else if (humidity_1 <= config_humi && co2_1 <= config_co2)
              {
                status_fan = 0;
              }
            }
          }
          else
          {
            // ALL ON
            // PUMP
            if (temp_1 > config_temp + 3 || humidity_1 < config_humi - 5)
            {
              status_pump = 1;
            }
            else if (temp_1 <= config_temp && humidity_1 >= config_humi)
            {
              status_pump = 0;
            }

            // FAN
            if (abs(temp_1 - config_temp) > 3 || humidity_1 > config_humi + 5 || co2_1 > config_co2 + 500)
            {
              status_fan = 1;
            }
            else if (abs(temp_1 - config_temp) < 0.5 && humidity_1 <= config_humi && co2_1 <= config_co2)
            {
              status_fan = 0;
            }

            // VALVE
            if (temp_1 > config_temp + 3)
            {
              status_valve = 1;
            }
            else if (temp_1 <= config_temp)
            {
              status_valve = 0;
            }
          }
        }
        else
        {
          switch_pump = doc["switch_pump"];
          switch_fan = doc["switch_fan"];
          switch_valve = doc["switch_valve"];

          status_pump = (switch_pump == 1) ? 1 : 0;
          status_fan = (switch_fan == 1) ? 1 : 0;
          status_valve = (switch_valve == 1) ? 1 : 0;
        }

        switch_led = doc["switch_led"];
        status_led = (switch_led == 1) ? 1 : 0;
        uploadStatus(status_pump, status_fan, status_valve, status_led, voltage);
      }
    }
    else
    {
      Serial.println("การร้องขอล้มเหลว  2");
    }
    https.end();
  }
}

void uploadStatus(int status_pump, int status_fan, int status_valve, int status_led, double voltage)
{
  if (WiFi.status() == WL_CONNECTED)
  {
    String dataToSend = "status_pump=" + String(status_pump) + "&status_fan=" + String(status_fan) + "&status_valve=" + String(status_valve) + "&status_led=" + String(status_led) + "&voltage=" + String(voltage);
    // Serial.println("Sending data to server...");
    HTTPClient https;
    https.begin(*client, serverAddress);
    https.addHeader("Content-Type", "application/x-www-form-urlencoded");
    int httpPOSTResponseCode = https.POST(dataToSend);

    if (httpPOSTResponseCode > 0)
    {
      String response = https.getString();
      // Serial.println(httpPOSTResponseCode);
    }
    else
    {
      Serial.println("การร้องขอล้มเหลว 3");
      Serial.println(https.errorToString(httpPOSTResponseCode).c_str());
    }
    https.end();
  }
}

void WiFi_Reset()
{
  if (digitalRead(buttonPin) == LOW)
  {
    Serial.println("WiFi Reset? Pls. waiting 3S..");
    delay(3500);
    if (digitalRead(buttonPin) == LOW)
    {
      delay(10);
      while (digitalRead(buttonPin) == LOW)
      {
        tone(buzzer, 4000, 300);
        delay(500);
      }
      Serial.println("WiFi Reset Setting .. OK!");
      wm.resetSettings();
    }
    ESP.restart();
  }
}

