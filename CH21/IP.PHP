<?php
echo "<html><head><title>using popen() to output results of ipconfig command</title></head><body>";
echo "<h1>IP Configuration</h1>";
echo "<pre>";
$p = popen("ipconfig /all","r") or die("Couldn't open connection to the server");
$host ="localhost";

while (!feof($p)) {
    $line = fgets($p);
    print $line;
}
pclose($p);
echo "</pre>";
echo "</body></html>";

 ?>
