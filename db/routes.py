from flask import Flask, jsonify, request

# from flask_wtf import FlaskForm
# from wtforms import StringField
# from wtforms.validators import DataRequired

application = Flask(__name__)


@application.route("/db")
def db():
    return jsonify({"description": "Expose stored data, such as measurements."})


@application.route("/db/temperature-humidity-readings", methods=['POST'])
def create_measurement():
    # form = MeasurementForm(csrf_enabled=False)
    return jsonify({"data": {"date": "UUUUUUUU", "temperature": "22"}})
