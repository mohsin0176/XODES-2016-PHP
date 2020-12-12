<html>
<head>
<title>Use of show_source() Function to Highlight PHP Syntax</title>
</head>
<body>
<form action="<?php print $_SERVER[PHP_SELF] ?>" method="get">
Enter a file name: <input type="text" name="file" value="<?php print $_GET[file]; ?>"><br>
<input type="submit" />
</form>
<hr>
<?php
if (isset($_GET[file])){
	show_source( $_GET['file'] ) or print "couldn't open";
	}
?>
</body>
</html>


