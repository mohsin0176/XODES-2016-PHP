<?php
echo <<<EOT
<html>
<head>
<title>Use of show_source() Function to Highlight PHP Syntax</title>
</head>
<body>
<form action="$_SERVER[PHP_SELF]" method="get">
Enter a file name: <input type="text" name="file"><br>
<input type="submit" />
</form>
EOT;
echo "<hr>";
if (isset($_GET[file])){
	highlight_file($_GET[file]); }
echo "</body>";
echo "</html>";
?>