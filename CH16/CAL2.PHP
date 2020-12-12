<?PHP
include("calendar.class.php");
$cal = new calendar();
$cal->bordersize= 2;
$cal->timestamp= mktime(8,34,44,12,16,2006);
$cal->show();
?>