import RPi.GPIO as GPIO
import time

GPIO.setmode(GPIO.BOARD)
GPIO.setwarnings(False)

GPIO.setup(16, GPIO.OUT)
GPIO.output(16, GPIO.HIGH)