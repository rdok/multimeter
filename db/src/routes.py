import datetime

from src.forms import StoreHumidityForm, StoreMeasurementsForm
from src.models import Temperature
from flask import jsonify, request

from src import application, db


@application.route("/db/")
def default():
    return jsonify({"description": "Expose stored data, such as measurements."})


@application.route("/db/measurements")
def measurements():
    return jsonify({
        "status": 200,
        "data": {"date": "UUUUUUUU", "temperature": "22"}
    })


@application.route("/db/measurements/", methods=['POST'])
def store_measurements():
    data = request.json

    form = StoreMeasurementsForm().from_json(data)

    if not form.validate():
        return jsonify(errors=form.errors), 422

    record = Temperature(
        sensorID=data['sensorID'],
        createdAt=datetime.datetime.now(),
        takenAt=datetime.datetime.strptime(data['takenAt'], "%Y-%m-%d %H:%M:%S"),
        temperature=data['temperature'],
        humidity=data['humidity'],
    )

    db.session.add(record)
    db.session.commit()

    return jsonify({'id': record.id})

