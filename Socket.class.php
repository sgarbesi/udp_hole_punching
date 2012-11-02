<?php
	class Socket {
		public $socket = null;

		private $cloud = array(
			'address'	=>	'127.0.0.1',
			'port'		=>	'1234'
		);

		public function udp_send($address, $port, $data, $whoami = 'Cloud') {
			if (!$this->socket) {
				$socket = stream_socket_client("udp://$address:$port");
				fwrite($socket, $data);
				$buf = fgets($socket, 128);
				print_r($buf);
				fclose($socket);
			} else {
				stream_socket_sendto($this->socket, $whoami . '/' . date('Y-m-d H:i:s') . '/' . $peer . "\r\n", 0, $peer);
				echo '> SENT MSG!' . "\n";
			}
		}
		
		public function udp_server($address, $port, $whoami = 'Cloud') {
			$this->socket = stream_socket_server("udp://" . $address . ":" . $port, $errno, $errstr, STREAM_SERVER_BIND);

			if (!$this->socket) {
			    die("$errstr ($errno)");
			}

			if ($whoami != 'Cloud') {
				stream_socket_sendto($this->socket, $whoami . '/' . date('Y-m-d H:i:s') . "\r\n", 0, $this->cloud['address'] . ':' . $this->cloud['port']);
				echo "> MSG CLOUD SENT!\n";
			}
				
			do {
				$packet = stream_socket_recvfrom($this->socket, 128, 0, $peer);
				echo "$peer -- " . $packet . "\n";

				stream_socket_sendto($this->socket, $whoami . '/' . date('Y-m-d H:i:s') . '/' . $peer . "\r\n", 0, $peer);
				echo '> REPLY SENT!' . "\n";
			} while ($packet !== false);
		}
	}