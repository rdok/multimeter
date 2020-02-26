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
                humidity = dht_device.humidity
                DHT22._kill_libgpiod_pulsein()

                return temperature, humidity
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
