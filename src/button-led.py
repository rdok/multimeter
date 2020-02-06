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

    if buttonPressed:
        print('pressed')
        GPIO.output(ledPin, GPIO.HIGH)
    else:
        GPIO.output(ledPin, GPIO.LOW)
        print('not pressed')

    time.sleep(.1)

GPIO.cleanup()
