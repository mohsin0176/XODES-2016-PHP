<?php 
 include 'config.inc.php'; 
 include_once("design.inc.php");

 // initialization 
 $photo_upload_fields = ''; 
 $counter = 1; 

 // If we want more fields, then use, preupload.php?number_of_fields=20 
 $number_of_fields = (isset($_GET['number_of_fields'])) ? 
   (int)($_GET['number_of_fields']) : 5; 

 // First Let's build the Category List 
 $result = mysql_query('SELECT category_id,category_name FROM gallery_category'); 
 while($row = mysql_fetch_array($result)) { 
   $photo_category_list .= "<option value=".$row[0].">".$row[1]."</option>\n";
 } 
 mysql_free_result( $result );   

 // Let's build the Image Uploading fields 
 while($counter <= $number_of_fields) { 
   $photo_upload_fields .= "<tr><td> Photo {".$counter."}"
   						."<input name=\"photo_filename[]\" type=\"file\" />"
   						."</td></tr><tr><td>"
   						."Caption: <textarea name=\"photo_caption[]\" cols=\"30\" rows=\"1\">"
   						."</textarea></td></tr>"; 
   $counter++; 
 } 

 // Final Output 

 echo $design_header;
 echo		"<form enctype=\"multipart/form-data\" action=\"upload.php\" method=\"post\" name=\"upload_form\">"
  		    ."<table width=\"90%\" border=\"0\" align=\"center\" style=\"width: 90%;\">"
			."<tr><td>Select Category: "
			."<select name=\"category\">".$photo_category_list."</select>"
			."</td></tr>"
     	    .$photo_upload_fields
			."<tr><td>"
			."<input type=\"submit\" name=\"submit\" value=\"Add Photos\" />"
			."</td></tr></table>"
			."</form>";
 echo $design_footer;

?>
