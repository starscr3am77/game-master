<?php
	if(isset($_POST['action'])){
		switch($_POST['action']) {
			case 'opening':
				opening();
				break;
			case 'jumper':
				jumper();
				break;
			case 'light':
				light();
				break;
			case 'success':
				success();
				break;
			case 'failure':
				failure();
				break;
			case 'start_timer':
				start_timer();
				break;
			case 'stop_timer':
				stop_timer();
				break;
		}
	}
	
	function opening() {
		shell_exec('sudo -u www-data python /var/www/html/opening.py');
		exit;
	}
	
	function jumper() {
		shell_exec('sudo -u www-data python /var/www/html/jumper.py');
		exit;
	}
	
	function light() {
		shell_exec('sudo -u www-data python /var/www/html/light.py');
		exit;
	}
	
	function success() {
		shell_exec('sudo -u www-data python /var/www/html/success.py');
		exit;
	}
	
	function failure() {
		shell_exec('sudo -u www-data python /var/www/html/failure.py');
		exit;
	}
	
	function start_timer() {
		shell_exec('sudo -u www-data python /var/www/html/start_timer.py');
		exit;
	}
	
	function stop_timer() {
		shell_exec('sudo -u www-data python /var/www/html/stop_timer.py');
		exit;
	}
?>
