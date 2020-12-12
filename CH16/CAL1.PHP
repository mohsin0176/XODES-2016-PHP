<?php
echo <<<EOT
<HTML>
<HEAD>
<STYLE>
td {font-family: verdana; font-size: 12px;}
A:Link {color: #FFFFFF;}
A:Visited {color: #FFFFFF;}
A:Active {color: #FFFFFF;}
A:Hover {color: #FFFFFF;}
</STYLE>
</HEAD>
<BODY>
EOT;

$thismonth = date("n");
$thisyear = date("y");
$todaysdate = date("j");

/* text color for month and year */

$title_color = "#FFFFFF"; 

/* background color for top row */

$title_bgcolor = "#333399"; 

/* background color for second row (SMTWTFS) */

$day_bgcolor = "#CCCCFF";

/* text color for current day */

$currday_color = "#FF0000";


/* Check to see if the month and year are set, if not default to the current month & year */

if(isset($_REQUEST['month'])) {

$month = $_REQUEST['month'];

}

if(!isset($month)) {

$month = date("n");

}

if(isset($_REQUEST['year'])) {

$year = $_REQUEST['year'];

}

if(!isset($year)) {

$year = date("y");

}

$nextmonth = $month + 1;
$lastmonth = $month - 1;
$nextyear = $year + 1;
$lastyear = $year - 1;


/* find out how many days are in the current month and what day starts out the month */

$days_in_month = date("t", mktime(0,0,0,$month,1,$year));

$first_day_is = date("w", mktime(0,0,0,$month,1,$year));

$header1 = date("F", mktime(0,0,0,$month,1,$year));

$header2 = date("Y", mktime(0,0,0,$month,1,$year));


/* Find out how many rows are needed to display without extra rows */

if($days_in_month == "28" && $first_day_is == "0") {

$rows = 4;

} elseif($days_in_month == "31" && $first_day_is >= "5") {

$rows = 6;

} elseif($days_in_month == "30" && $first_day_is == "6") {

$rows = 6;

} else {

$rows = 5;

}

echo "<TABLE border=\"1\" cellpadding=\"2\" cellspacing=\"0\">
<TR>
<TD colspan=\"7\" bgcolor=\"$title_bgcolor\">
<center>
<font color=\"$title_color\">
<a href=\"$_SERVER[PHP_SELF]?month=$lastmonth&year=$year\">&laquo;</a>
&nbsp;$header1&nbsp;
<a href=\"$_SERVER[PHP_SELF]?month=$nextmonth&year=$year\">&raquo;</a><BR>
<a href=\"$_SERVER[PHP_SELF]?year=$lastyear&month=$month\">&laquo;</a>&nbsp;$header2&nbsp;
<a href=\"$_SERVER[PHP_SELF]?year=$nextyear&month=$month\">&raquo;</a></font>
</center>
</TD>
</TR>
<TR>
<td bgcolor=\"$day_bgcolor\"><center>S</center></td>
<td bgcolor=\"$day_bgcolor\"><center>M</center></td>
<td bgcolor=\"$day_bgcolor\"><center>T</center></td>
<td bgcolor=\"$day_bgcolor\"><center>W</center></td>
<td bgcolor=\"$day_bgcolor\"><center>T</center></td>
<td bgcolor=\"$day_bgcolor\"><center>F</center></td>
<td bgcolor=\"$day_bgcolor\"><center>S</center></td>
</TR>

";

/* Display the days */

$i = 0;

$day = 1;

while($i < $rows) {

echo "<TR>";

$weekday = 0;

while($weekday < 7) {

if($day > $days_in_month) {

$contents = "&nbsp;";

} elseif($i == "0" && $weekday < $first_day_is) {

$contents = "&nbsp;";

} else {

/* See if it's today */

if($month == "$thismonth" && $year == "$thisyear" && $day == "$todaysdate") {

$contents = "<font color=\"$currday_color\">$day</font>";

} else {

$contents = $day;

}

$day++;

}


echo "<td><center>$contents</center></td>";

$weekday++;

}

echo "</TR>";

$i++;

}

echo "</TABLE>";
echo "</BODY></HTML>";

?>