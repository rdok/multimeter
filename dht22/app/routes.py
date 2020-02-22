from app.dht22 import DHT22
from flask import jsonify

from app import application


@application.route("/dht22/current")
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
