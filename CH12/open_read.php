<?PHP

echo <<<EOT
<htmL>
<head>
<title>Opening and Reading data from file</title>
</head>
<body>
EOT;

$file_name = "myfile.txt";
$fp = fopen($file_name, "r") or die("Couldn't oprn $file_name");
while (!feof($fp)) {
	$line = fgets($fp, 1024);
	print "$line<br/>";
}

echo "</body></html>";
?>