import RPi.GPIO as GPIO

ledPin = 7
GPIO.setmode(GPIO.BOARD)
GPIO.setup(ledPin, GPIO.OUT)
GPIO.output(ledPin, GPIO.LOW)
GPIO.output(ledPin, GPIO.HIGH)

# # BCM system
# gpioLedPin = 4
# GPIO.setmode(GPIO.BCM)
# GPIO.setup(gpioLedPin, GPIO.OUT)
# GPIO.output(gpioLedPin, GPIO.LOW)
# GPIO.output(gpioLedPin, GPIO.HIGH)
