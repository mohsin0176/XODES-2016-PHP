<?php

$url = "http://www.suhreed.org/index.php";

$fp = fopen($url, "r") or die("Could Not open $url");

while (!feof($fp)) {
  print fgets($fp, 1024);

}

 ?>
