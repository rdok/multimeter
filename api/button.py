import RPi.GPIO as GPIO
import time

buttonPin = 8
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)
GPIO.setup(buttonPin, GPIO.IN)

while True:
    buttonValue = GPIO.input(buttonPin)
    print(buttonValue)
    if buttonValue:
        print("Pressed")
    else:
        print("Not Pressed")

    time.sleep(10)


GPIO.cleanup()
