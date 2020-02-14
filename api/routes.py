import requests
from flask import Flask, jsonify

application = Flask(__name__)


@application.route("/api/temperature-humidity-readings/")
def temperature_humidity_readings():
    response = requests.get('http://proxy/dht22')

    content = response.content if response.status_code == 200 \
        else {"error": response.text}

    print('================================================================================')
    print(content)
    print(response.status_code)

    return application.response_class(
        response=content,
        status=response.status_code,
        mimetype='application/json'
    )

