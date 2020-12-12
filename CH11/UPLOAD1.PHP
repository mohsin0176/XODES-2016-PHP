<HTML>
<HEAD>
<TITLE>File Upload Example</TITLE>
</HEAD>
<BODY>
<H1>File Upload Example</H1>
<?PHP

$upload_dir ="images";
 
if ( isset($_FILES['fupload'])) {
	$file_name = $_FILES['fupload']['name'];
	$file_type = $_FILES['fupload']['type'];
	print "Path: ".$_FILES['fupload']['tmp_name']."<br />";
	print "Name: $file_name <br />";
	print "Size: ".$_FILES['fupload']['size']."<br />";
	print "Type: $file_type <br />";
	if ($file_type =="image/jpeg" or $file_type=="image/gif") {
		copy($_FILES['fupload']['tmp_name'], "$upload_dir/$file_name") or die("Couldn't copy");
		print "<img src=\"$upload_dir/$file_name\"<p>";
	}
}

?>
<FORM enctype="multipart/form-data" action="<?php print $_SERVER['PHP_SELF']; ?>" method="POST">
Select a File: <INPUT type="file" name="fupload" /><BR />
<INPUT type="submit" value="Upload File" />
</FORM>

</BODY>
</HTML>