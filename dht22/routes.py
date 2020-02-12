import board
import adafruit_dht

from flask import Flask, jsonify

application = Flask(__name__)

# Initial the dht device, with data pin connected to:
dhtDevice = adafruit_dht.DHT22(board.D17)

@application.route("/dht22")
def default():
    temperature_c = dhtDevice.temperature
    temperature_f = temperature_c * (9 / 5) + 32
    humidity = dhtDevice.humidity

    return jsonify({"data": {
        "temperature-c": "{:.1f}".format(temperature_c),
        "temperature-f": "{:.1f}".format(temperature_f),
        "humidity": humidity,
    }})


if __name__ == "__main__":
    application.run(host='0.0.0.0', port=8090)
