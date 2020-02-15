from flask import jsonify, request

from app import application
from app.forms import StoreTemperatureHumidityReadingForm


@application.route("/db/")
def db():
    return jsonify({"description": "Expose stored data, such as measurements."})


@application.route("/db/temperature-humidity-readings/")
def measurements():
    return jsonify({
        "status": 200,
        "data": {"date": "UUUUUUUU", "temperature": "22"}
    })


@application.route("/db/temperature-humidity-readings/", methods=['POST'])
def store_measurement():
    data = request.json
    form = StoreTemperatureHumidityReadingForm().from_json(data)

    if not form.validate():
        return jsonify(errors=form.errors), 422

    print(data)
    return jsonify({
        "status": 200,
        "data": {"date": "UUUUUUUU", "temperature": "22"}
    })
