import RPi.GPIO as GPIO
import time

GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)

GPIO.setup(17, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(27, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(22, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)

prev_input= 0

while True:
    #take a reading
    input17 = GPIO.input(17)
    input27 = GPIO.input(27)
    input22 = GPIO.input(22)
    #if the last reading was low and this one high, print
    if (input17 == 0):
        print(input17)
    else:
        print(input17)
        
    if (input27 == 0):
        print(input27)
    else:
        print(input27)
        
    if (input22 == 0):
        print(input22)
    else:
        print(input22)

    time.sleep(0.05)
