from flask import Flask, jsonify

application = Flask(__name__)


@application.route("/db")
def db():
    return jsonify({"description": "Expose stored data, such as measurements."})


@application.route("/db/measurements")
def measurements():
    return jsonify({"data": {"date": "1/1/2000", "temperature": "22"}})


if __name__ == "__main__":
    application.run(host='0.0.0.0', port=8080)
