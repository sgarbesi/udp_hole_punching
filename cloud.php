<?php
	/**
	*	UDP Hole Punching
	*
	*	Basically the client that wants to initiate contact will first contact the server,
	*	by contacting the server the a port will open up on that clients local, which then,
	*	can be used to communicate with that client. The same has to be done for the client
	*	destination as well. This example is simply showing you the port that opens up that
	*	you can now communicate to the user on, getting around they're firewall without
	*	having to modify their router configuration.
	*
	*	After opening up the ports on the clients, adjust the script to use the udp_send()
	*	function with the clients ip and open ports to send messages back and forth.
	*
	*	@author		Salvatore Garbesi <sal@garbesi.com>
	*	@website	http://salvatore.garbesi.com
	*/

	date_default_timezone_set('America/New_York');
	require_once 'Socket.class.php';
	$socket = new Socket();
	
	// Cloud IP
	$ip = '10.0.1.11';
	$port = 1234;
	
	$socket->udp_server($ip, $port);