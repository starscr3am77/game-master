import RPi.GPIO as GPIO
from time import sleep
import os.path

GPIO.setmode(GPIO.BOARD)
GPIO.setwarnings(False)

#Listen for GPIO
GPIO.setup(16, GPIO.IN)

timer = 3

while True:
    state = GPIO.input(16)
    print(state);
    sleep(1)
    if state == 0:
        timer = timer - 1
    print (timer)
    
    if timer == 0:
        os.system("killall omxplayer.bin")
        os.system("omxplayer -o hdmi -b /var/www/html/vid/ending_fail.mp4")
        os.system("xrefresh -display :0")
#for i in range(0,60):
#    print(60-i)
#    sleep(1)