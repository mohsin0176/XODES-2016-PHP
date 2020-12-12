<?PHP

echo <<<EOT
<htmL>
<head>
<title>File properties</title>
</head>
<body>
EOT;

$file = "myfile.txt";
file_test_info($file);

function file_test_info($f) {
	if (!file_exists($f)) {
		print "$f does'n't exists<br />";
		return;
	}
	print "$f is ".(is_file($f)?" ":"not ")."a file<br/>";
	print "$f is ".(is_dir($f)?" ":"not ")."a directory<br/>";
	print "$f is ".(is_readable($f)?" ":"not ")."readable<br/>";
	print "$f is ".(is_writable($f)?" ":"not ")."writable<br/>";
	print "$f is ".(is_executable($f)?" ":"not ")."executable<br/>";
	print "$f is ".filesize($f)." bytes<br/>";
	print "$f was accessed on ".date("D d M Y g:i A", fileatime($f))."<br/>";
    print "$f was modified on ".date("D d M Y g:i A", filemtime($f))."<br/>";
    print "$f was changed on ".date("D d M Y g:i A", filectime($f))."<br/>";
    //print "$f was changed on ".filectime($f)."<br/>";
}
/*
$c= file_get_contents($file);
print "<b>Contents of $file is here:</b> ".$c."<br/>";
*/
echo "</body></html>";
?>