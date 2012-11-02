<?php
	date_default_timezone_set('America/New_York');
	require_once 'Socket.class.php';
	$socket = new Socket();
	
	// Cloud IP
	$ip = '10.0.1.11';
	$port = 1234;
	
	$socket->udp_send($ip, $port, 'Client 2: Cloud can you hear me?', 'Client 2');