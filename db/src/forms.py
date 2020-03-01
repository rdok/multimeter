from flask_wtf import FlaskForm
from wtforms import StringField, DecimalField, DateTimeField
from wtforms.validators import NumberRange, InputRequired


class StoreMeasurementsForm(FlaskForm):
    class Meta:
        csrf = False

    sensor = StringField('sensor', validators=[InputRequired()])
    takenAt = DateTimeField('takenAt', validators=[InputRequired()])
    temperature = DecimalField('temperature', validators=[InputRequired()])
    humidity = DecimalField('humidity', validators=[InputRequired(), NumberRange(0, 100)])
