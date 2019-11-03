import RPi.GPIO as GPIO
import os.path
from time import sleep

GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)

#Listen for GPIO
GPIO.setup(23, GPIO.IN)
GPIO.setup(17, GPIO.IN, pull_up_down=GPIO.PUD_UP)

timer = 10
timer_override = 0
failure_played = 0
success_played = 0
        
while True:
    state = GPIO.input(23)
    lever = GPIO.input(17)
    #print(state)
    #print(lever)
    sleep(1)
    if state == 0 and timer_override == 0:
        timer = timer - 1
    
    print (timer)
        
    if lever == 0 and success_played == 1:
        timer = 10
        timer_override = 0
        failure_played = 0
        success_played = 0
        
    if failure_played == 1:
        timer = 10

    if timer == 0 and failure_played == 0:
        os.system("killall omxplayer.bin")
        os.system("omxplayer -o hdmi -b /var/www/html/vid/ending_fail.mp4")
        os.system("sudo -u www-data python /var/www/html/stop_timer.py")
        os.system("xrefresh -display :0")
        failure_played = 1
        
    if (lever == 0):
        success_played = 0
    else:
        if (success_played == 0):
            os.system("killall omxplayer.bin")
            os.system("omxplayer -o hdmi -b /var/www/html/vid/ending_success.mp4")
            os.system("xrefresh -display :0")
            os.system("sudo -u www-data python /var/www/html/stop_timer.py")
            success_played = 1
            timer_override = 1
            
