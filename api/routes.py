import requests
from flask import request

from app import application
from TransformResponse import TransformResponse

dbAPI = 'http://proxy/db/temperatures/'


@application.route("/api/temperatures/")
def get_measurement():
    response = requests.get(dbAPI)

    return TransformResponse().handle(application, response)
