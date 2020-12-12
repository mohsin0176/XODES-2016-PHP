<?php
$link = mysql_connect("localhost","root") or die("Couldn't connect to the database");
mysql_create_db("mysite2",$link) or die("Couldn't create database");
mysql_list_dbs($link);
?>