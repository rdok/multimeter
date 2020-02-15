from flask import Flask, jsonify

from DHT22 import DHT22

application = Flask(__name__)


@application.route("/dht22/")
def default():
    try:
        humidity, temperature_c, temperature_f = DHT22().get_readings()
    except Exception as error:
        return jsonify({"error": str(error)})

    return jsonify({"data": {
        "temperature": {
            "celsius": "{:.1f}".format(temperature_c),
            "fahrenheit": "{:.1f}".format(temperature_f),
        },
        "humidity": {"percentage": "{:.1f}".format(humidity)},
    }})
