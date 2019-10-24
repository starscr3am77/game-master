<?php
	if(isset($_POST['action'])){
		switch($_POST['action']) {
			case 'jumper':
				jumper();
				break;
			case 'light':
				light();
				break;
		}
	}
	
	function jumper() {
		shell_exec('sudo -u www-data python /var/www/html/jumper.py');
		exit;
	}
	
	function light() {
		shell_exec('sudo -u www-data python /var/www/html/light.py');
		exit;
	}
	
	//shell_exec('sudo -u www-data python /var/www/html/opening.py');
	//} else if(isset($_GET['fail'])){
	//shell_exec('sudo -u www-data python /var/www/html/fail.py');
	//} else if(isset($_GET['success'])){
	//shell_exec('sudo -u www-data python /var/www/html/success.py');
	//} else if(isset($_GET['jumper'])){
	//
	//} else if(isset($_GET['light'])){
	//
	//} else if(isset($_GET['guide'])){
	//shell_exec('sudo -u www-data python /var/www/html/guide.py');
	//}
?>
