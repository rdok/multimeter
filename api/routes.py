import requests
from flask import Flask, request

from measurements.TransformResponse import TransformResponse

application = Flask(__name__)


@application.route("/api/temperature-humidity-readings/")
def get_measurement():
    response = requests.get('http://proxy/dht22')

    return TransformResponse().handle(application, response)


@application.route("/api/temperature-humidity-readings/", methods=['POST'])
def create_measurement():
    url = 'http://proxy/db/temperature-humidity-readings/'
    response = requests.post(url, request.data)
    print('db.response: >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>')
    print(response)

    return TransformResponse.handle(application, response)
