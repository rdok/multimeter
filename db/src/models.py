from src import db


class Temperature(db.Model):
    id = db.Column(db.Integer(), primary_key=True)
    sensorID = db.Column(db.String(64), nullable=False)
    createdAt = db.Column(db.DateTime(), index=True, nullable=False)
    takenAt = db.Column(db.DateTime(), index=True, nullable=False)
    temperature = db.Column(db.String(3), nullable=False)

    def __repr__(self):
        return '<Temperature {}>'.format(self.id)


class Humidity(db.Model):
    id = db.Column(db.Integer(), primary_key=True)
    sensorID = db.Column(db.String(64), nullable=False)
    createdAt = db.Column(db.DateTime(), index=True, nullable=False)
    takenAt = db.Column(db.DateTime(), index=True, nullable=False)
    humidity = db.Column(db.String(3), nullable=False)

    def __repr__(self):
        return '<Humidity {}>'.format(self.id)
