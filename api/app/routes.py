import requests
from flask import request

from app import application
from app.TransformResponse import TransformResponse

dbAPI = 'http://proxy/db/temperature-humidity-readings/'


@application.route("/api/temperature-humidity-readings/")
def get_measurement():
    response = requests.get(dbAPI)

    return TransformResponse().handle(application, response)


@application.route("/api/temperature-humidity-readings/", methods=['POST'])
def create_measurement():
    print('POST: @application.route("/api/temperature-humidity-readings/")')
    response = requests.post(dbAPI, None, request.json)

    return TransformResponse().handle(application, response)
