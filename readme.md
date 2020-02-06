### Multimeter

![Initial setup](logo.jpg "Initial Setup")

```bash
source aliases.sh
docker-compose up -d
python3 src/entry.py hello 5
```

### TODO.ci
- Install python3-pip


```bash
pi@falcon9:~ $ python3
Python 3.7.3 (default, Apr  3 2019, 05:39:12)
[GCC 8.2.0] on linux
Type "help", "copyright", "credits" or "license" for more information.
>>> import RPi.GPIO as GPIO
>>> ledPin = 7
>>> GPIO.setmode(GPIO.BOARD)
>>> GPIO.setup(ledPin, GPIO.OUT)
>>> GPIO.output(ledPin, GPIO.LOW)
>>> GPIO.output(ledPin, GPIO.HIGH)
>>> GPIO.output(ledPin, GPIO.MEDIUM)
Traceback (most recent call last):
  File "<stdin>", line 1, in <module>
AttributeError: module 'RPi.GPIO' has no attribute 'MEDIUM'
>>> GPIO.output(ledPin, GPIO.LOW)
>>> GPIO.output(ledPin, GPIO.HIGH)
>>> GPIO.output(ledPin, GPIO.LOW)
>>>
```