import datetime

from app.forms import StoreTemperatureHumidityReadingForm
from app.models import TemperatureHumidityReading
from flask import jsonify, request

from app import application, db


@application.route("/db/")
def default():
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

    record = TemperatureHumidityReading(
        sensorID=data['sensorID'],
        createdAt=datetime.datetime.now(),
        takenAt=datetime.datetime.strptime(data['takenAt'], "%Y-%m-%d %H:%M:%S"),
        temperature_c=data['temperatureC'],
        temperature_f=data['temperatureF'],
        humidity=data['humidity'],
    )

    db.session.add(record)
    db.session.commit()

    return jsonify({'id': record.id})


@application.route("/db/temperatures/", methods=['POST'])
def store_measurement():
    data = request.json

    form = StoreTemperatureHumidityReadingForm().from_json(data)

    if not form.validate():
        return jsonify(errors=form.errors), 422

    record = TemperatureHumidityReading(
        sensorID=data['sensorID'],
        createdAt=datetime.datetime.now(),
        takenAt=datetime.datetime.strptime(data['takenAt'], "%Y-%m-%d %H:%M:%S"),
        temperature_c=data['temperatureC'],
        temperature_f=data['temperatureF'],
        humidity=data['humidity'],
    )

    db.session.add(record)
    db.session.commit()

    return jsonify({'id': record.id})
