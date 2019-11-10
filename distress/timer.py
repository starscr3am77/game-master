import RPi.GPIO as GPIO
import os.path
from time import sleep

GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)

#Listen for GPIO
GPIO.setup(23, GPIO.IN)
GPIO.setup(17, GPIO.IN, pull_up_down=GPIO.PUD_UP)

timer = 3600
timer_override = 0
failure_played = 0
success_played = 0
        
while True:
    state = GPIO.input(23)
    lever = GPIO.input(17)
    #print(state)
    #print(lever)
    print(timer)
    sleep(1)
    if state == 0 and timer_override == 0:
        timer = timer - 1
    
    #print (timer)
        
    if lever == 1 and success_played == 1:
        timer = 3600
        timer_override = 0
        failure_played = 0
        success_played = 0
        
    if failure_played == 1:
        timer = 3600

    if timer == 0 and failure_played == 0:
        os.system("killall omxplayer.bin")
        os.system("omxplayer -o hdmi -b /var/www/html/vid/ending_fail.mp4")
        os.system("sudo -u www-data python /var/www/html/stop_timer.py")
        os.system("xrefresh -display :0")
        failure_played = 1
        
    if (lever == 1):
        success_played = 0
    else:
        if (success_played == 0):
            os.system("killall omxplayer.bin")
            os.system("omxplayer -o hdmi -b /var/www/html/vid/ending_success.mp4")
            os.system("xrefresh -display :0")
            os.system("sudo -u www-data python /var/www/html/stop_timer.py")
            success_played = 1
            timer_override = 1
            
    if (timer == 3540):
        #os.system('pkill -9 mpg123')
        os.system('mpg123 -q /var/www/html/snd/Incoming.mp3 &')
        
    if (timer == 3300):
        #os.system('pkill -9 mpg123')
        os.system('mpg123 -q /var/www/html/snd/Warp.mp3 &')
        
    if (timer == 3120):
        #os.system('pkill -9 mpg123')
        os.system('mpg123 -q /var/www/html/snd/Incoming.mp3 &')
        
    if (timer == 2820):
        #os.system('pkill -9 mpg123')
        os.system('mpg123 -q /var/www/html/snd/Incoming.mp3 &')
        
    if (timer == 2520):
        #os.system('pkill -9 mpg123')
        os.system('mpg123 -q /var/www/html/snd/Incoming.mp3 &')
        
    if (timer == 2220):
        #os.system('pkill -9 mpg123')
        os.system('mpg123 -q /var/www/html/snd/Incoming.mp3 &')
        
    if (timer == 1920):
        os.system('pkill -9 mpg123')
        os.system('mpg123 -q /var/www/html/snd/Incoming.mp3 &')
        
    if (timer == 1800):
        #os.system('pkill -9 mpg123')
        os.system('mpg123 -q /var/www/html/snd/30_minutes.mp3 &')
        
    if (timer == 900):
        #os.system('pkill -9 mpg123')
        os.system('mpg123 -q /var/www/html/snd/15_minutes.mp3 &')
        
    if (timer == 300):
        os.system('pkill -9 mpg123')
        os.system('mpg123 -q /var/www/html/snd/5_minutes.mp3 &')
            
