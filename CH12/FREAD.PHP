<?PHP

echo <<<EOT
<htmL>
<head>
<title>Opening and Reading data from file by fread</title>
</head>
<body>
EOT;

$file_name = "myfile.txt";
$fp = fopen($file_name, "r") or die("Couldn't oprn $file_name");
while (!feof($fp)) {
	$chunk = fread($fp, 25);
	print "$chunk<br/>";
}

echo "</body></html>";
?>