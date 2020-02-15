import requests
from measurements.TransformResponse import TransformResponse


class StoreMeasurementsResponse:
    def handle(self, url):

        response = requests.post(url, None, json)

        return TransformResponse().handle(response)
