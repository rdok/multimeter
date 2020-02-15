from app import db


class TemperatureHumidityReading(db.Model):
    id = db.Column(db.Integer(), primary_key=True)
    sensorID = db.Column(db.String(64), nullable=False)
    createdAt = db.Column(db.DateTime(), index=True, nullable=False)
    takenAt = db.Column(db.DateTime(), index=True, nullable=False)
    temperature_c = db.Column(db.String(3), nullable=False)
    temperature_f = db.Column(db.String(4), nullable=False)
    humidity = db.Column(db.String(3), nullable=False)

    def __repr__(self):
        return '<TemperatureHumidityReading {}>'.format(self.id)
