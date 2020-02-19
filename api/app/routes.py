import requests
from flask import Flask, request

from app.TransformResponse import TransformResponse

application = Flask(__name__)
dbAPI = 'http://proxy/db/temperature-humidity-readings/'


@application.route("/api/dht22/")
def current_measurement():
    response = requests.get('http://dht22/current')

    return TransformResponse().handle(application, response)


@application.route("/api/temperature-humidity-readings/")
def get_measurement():
    print('GET: @application.route("/api/temperature-humidity-readings/")')
    response = requests.get(dbAPI)

    return TransformResponse().handle(application, response)


@application.route("/api/temperature-humidity-readings/", methods=['POST'])
def create_measurement():
    print('POST: @application.route("/api/temperature-humidity-readings/")')
    response = requests.post(dbAPI, None, request.json)

    return TransformResponse().handle(application, response)
