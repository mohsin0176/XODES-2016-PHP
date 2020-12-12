<?php
	class HTTP_Client
	{
		var $host;
		var $port;
		var $socket;
		var $errno;
		var $errstr;
		var $timeout;
		var $buf;
		var $path;
		
		/* Constructor, set default timeout to 30s */
		function HTTP_Client($host, $port, $timeout = 30)
		{
			$this->host = $host;
			$this->port = $port;
			$this->timeout = $timeout;
			$this->path = "/";
		}
		
		/* Opens a connections and returns true or false on success/failure */
		function connect()
		{
			$this->socket = fsockopen($this->host, $this->port, $this->errno, $this->errstr, $this->timeout);
			
			if(!$this->socket)
				return false;
			else
				return true;
		}
		
		/* Sets the path that will be requested */
		function set_path($path)
		{
			$this->path = $path;
		}
		
		/* Send the request and clean up the connection */
		function send_request()
		{
			if(!$this->connect())
			{
				return false;
			}
			else
			{
				$this->buf = "";
				fwrite($this->socket, "GET $this->path HTTP/1.0\r\nHost: $host\r\nUser-Agent: MasteringPHP Client\r\n\r\n");			
				while(!feof($this->socket))			
					$this->buf .= fgets($this->socket, 2048);
					
				$this->close();						
				return true;		
			}				
		}
		
		/* Return any data lounging about the object */
		function get_data()
		{
			return $this->buf;
		}
		
		/* Internal function to clean the socket up */
		function close()
		{
			fclose($this->socket);
		}
	}
?>