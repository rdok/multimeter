from flask_wtf import FlaskForm
from wtforms import StringField, DecimalField, DateTimeField
from wtforms.validators import DataRequired, NumberRange, InputRequired


class StoreTemperatureHumidityReadingForm(FlaskForm):
    class Meta:
        csrf = False
    sensorID = StringField('sensorID', validators=[InputRequired()])
    takenAt = DateTimeField('takenAt', validators=[InputRequired()])
    temperatureC = DecimalField('temperatureC', validators=[InputRequired()])
    temperatureF = DecimalField('temperatureF', validators=[InputRequired()])
    humidity = DecimalField('temperatureF', validators=[InputRequired(), NumberRange(0, 100)])
