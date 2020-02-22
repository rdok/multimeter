import time

import adafruit_dht
import board
import psutil


class DHT22:
    @staticmethod
    def get_readings():
        attempts = 13
        for attempt in range(0, attempts):
            try:
                dht_device = adafruit_dht.DHT22(board.D17)
                temperature_c = dht_device.temperature
                temperature_f = temperature_c * (9 / 5) + 32
                humidity = dht_device.humidity
                DHT22._kill_libgpiod_pulsein()

                return humidity, temperature_c, temperature_f
            except:
                DHT22._kill_libgpiod_pulsein()
                time.sleep(1)
                continue

        raise ValueError('Unable to get dht22 sensor readings.')

    @staticmethod
    def _kill_libgpiod_pulsein():
        for proc in psutil.process_iter():
            if proc.name() == "libgpiod_pulsein":
                proc.kill()
