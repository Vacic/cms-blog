<?php 
$db['db_host'] = 'johnny.heliohost.org:2083';
$db['db_user'] = 'vacic_vacic';
$db['db_pass'] = '82469173';
$db['db_name'] = 'vacic_cms';

foreach($db as $key => $value) {
define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

/*if($connection) {
	echo "We are connected";
}*/
?>