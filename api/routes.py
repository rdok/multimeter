import requests
from flask import Flask, request

from measurements.TransformResponse import TransformResponse

application = Flask(__name__)
dbAPI = 'http://proxy/db/temperature-humidity-readings/'


@application.route("/api/temperature-humidity-readings/")
def get_measurement():
    print('api >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>')

    response = requests.get(dbAPI)

    return TransformResponse().handle(application, response)


@application.route("/api/temperature-humidity-readings/", methods=['POST'])
def create_measurement():
    response = requests.post(dbAPI, None, request.json)

    return TransformResponse().handle(application, response)
