from app import db


class TemperatureHumidityReading(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    sensorID = db.Column(db.String(120))
    createdAt = db.Column(db.DateTime)
    takenAt = db.Column(db.DateTime)
    temperature_c = db.Column(db.Numeric())
    temperature_f = db.Column(db.Numeric())
    humidity = db.Column(db.Numeric())

    def __repr__(self):
        return '<TemperatureHumidityReading {}>'.format(self.id)
