from app.dht22 import DHT22
from flask import jsonify

from app import application


@application.route("/dht22")
def default():
    try:
        temperature, humidity = DHT22().get_readings()
    except Exception as error:
        return jsonify({"error": str(error)})

    return jsonify({"temperature": temperature, "humidity": humidity})
