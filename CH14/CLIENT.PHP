<?php
    require_once("http_client.class.php");

    $host = "www.php.net";
	$port = 80;
	$result = "";

	$client = new HTTP_Client($host, $port);

	$client->set_path("/");

	if(!$client->send_request())
		echo $client->errno . " " . $client->errstr;
	else
		$result = $client->get_data();

	echo $result;
?>