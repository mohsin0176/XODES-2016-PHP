<?PHP
$string = "This is\tan example\nstring";

$tok = strtok($string, " \n\t");

while ($tok !== false) {
   echo "$tok<br />";
   $tok = strtok(" \n\t");
}
?>