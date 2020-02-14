begin;

create table temperature_humidity_readings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    sensorID TEXT,
    createdAt DATETIME,
    temperature_c NUMERIC,
    temperature_f NUMERIC,
    humidity NUMERIC
)

commit