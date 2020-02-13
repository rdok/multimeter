import sys
import time

import adafruit_dht
import board
import psutil
from flask import Flask, jsonify

application = Flask(__name__)


@application.route("/dht22")
def default():
    try:
        humidity, temperature_c, temperature_f = get_dht22_readings()
    except:
        error = sys.exc_info()[0]
        return jsonify({"error": str(error)})

    return jsonify({"data": {
        "temperature": {
            "celsius": "{:.1f}".format(temperature_c),
            "fahrenheit": "{:.1f}".format(temperature_f),
        },
        "humidity-percentage": humidity,
    }})


def get_dht22_readings():
    for attempt in range(0, 7):
        try:
            dht_device = adafruit_dht.DHT22(board.D17)
            temperature_c = dht_device.temperature
            temperature_f = temperature_c * (9 / 5) + 32
            humidity = dht_device.humidity
            kill_libgpiod_pulsei()

            return humidity, temperature_c, temperature_f
        except:
            kill_libgpiod_pulsei()
            time.sleep(1)
            continue

    raise ValueError('Unable to get dht22 sensor readings.')



def kill_libgpiod_pulsei():
    for proc in psutil.process_iter():
        if proc.name() == "libgpiod_pulsein":
            print('killing ' + proc.name())
            proc.kill()


if __name__ == "__main__":
    application.run(host='0.0.0.0', port=8090)
