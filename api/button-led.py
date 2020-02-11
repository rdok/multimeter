import RPi.GPIO as GPIO
import time

ledPin = 7
buttonPin = 8

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)

GPIO.setup(buttonPin, GPIO.IN)
GPIO.setup(ledPin, GPIO.OUT)

while True:
    buttonPressed = GPIO.input(buttonPin)

    GPIO.output(ledPin, GPIO.HIGH) \
        if buttonPressed else GPIO.output(ledPin, GPIO.LOW)

    time.sleep(.1)

GPIO.cleanup()
