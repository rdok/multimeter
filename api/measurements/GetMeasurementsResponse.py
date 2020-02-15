import requests
from flask import Flask

application = Flask(__name__)

from measurements.TransformResponse import  TransformResponse


class GetMeasurementsResponse:
    def handle(self, application, url):
        response = requests.get(url)

        return TransformResponse().handle(application, response)

