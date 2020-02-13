import sys
import board
import psutil
import adafruit_dht

from flask import Flask, jsonify

application = Flask(__name__)


@application.route("/dht22")
def default():
    try:
        dhtDevice = adafruit_dht.DHT22(board.D17)

        temperature_c = dhtDevice.temperature
        temperature_f = temperature_c * (9 / 5) + 32
        humidity = dhtDevice.humidity

        kill_libgpiod_pulsei()

        return jsonify({"data": {
            "temperature": {
                "celsius": "{:.1f}".format(temperature_c),
                "fahrenheit": "{:.1f}".format(temperature_f),
            },
            "humidity-percentage": humidity,
        }})
    except RuntimeError as error:
        kill_libgpiod_pulsei()
        return jsonify({"error": str(error)})


def kill_libgpiod_pulsei():
    for proc in psutil.process_iter():
        if proc.name() == "libgpiod_pulsein":
            print('killing ' + proc.name())
            proc.kill()


if __name__ == "__main__":
    application.run(host='0.0.0.0', port=8090)
