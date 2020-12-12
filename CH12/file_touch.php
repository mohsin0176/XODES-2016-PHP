<?PHP

echo <<<EOT
<htmL>
<head>
<title>File properties</title>
</head>
<body>
EOT;

$file_name = "myfile.txt";

if (touch($file_name)) {
   echo "$file_name modification time has been changed to present time";
} else {
   echo "Sorry, could not change modification time of $file_name";
}


echo "</body></html>";
?>