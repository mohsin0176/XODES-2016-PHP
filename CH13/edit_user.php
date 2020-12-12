<?php
if (isset($_POST['user_id'])) {
	$user_id = $_POST['user_id'];
	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['lastname']);
	$username = trim($_POST['username']);
	$email = trim($_POST['useremail']);
	$web =trim($_POST['userweb']);
	$country = trim($_POST['country']);
	$sex = trim($_POST['sex']);
	
	mysql_connect("localhost","root") or die("Couldn't connect to server");
	mysql_select_db("my_site");
	$sql = "UPDATE `site_users` SET `user_id`='$user_id', `first_name`='$firstname', `last_name`='$lastname', `username`='$username', `user_email`='$email', `user_web`= '$web',`country`='$country', `sex`='$sex'";
	mysql_query($sql);
mysql_close();
print "Your record has been updated";
} 
elseif (isset($_GET['id']))
{
	$id = $_GET['id'];	
	mysql_connect("localhost","root") or die("Couldn't connect to server");
	mysql_select_db("my_site");
	$sql = "SELECT * FROM site_users WHERE user_id ='$id'";
	$result = mysql_query($sql);
	$arr = mysql_fetch_array($result);

	$self =$_SERVER['PHP_SELF'];
	echo <<<EOT
	<form action="$self" method="POST">
	<table>
	<input type="hidden" name="user_id" value="$id" />
	<tr>
	  <td>First Name:</td>
	  <td><input type="text" name="firstname" value ="$arr[first_name]"/></td>
	</tr>
	<tr>
	  <td>Last Name:</td>
	  <td><input type="text" name="lastname" value ="$arr[last_name]"/></td>
	</tr>
	<tr>
	  <td>User Name:</td>
	  <td><input type="text" name="username" value ="$arr[username]"/></td>
	</tr>
	<tr>
	  <td>E-mail:</td>
	  <td><input type="text" name="useremail" value ="$arr[user_email]"/></td>
	</tr>
	<tr>
	  <td>Web URL:</td>
	  <td><input type="text" name="userweb" value ="$arr[user_web]"/></td>
	</tr>
	<tr>
	  <td>Country:</td>
	  <td><input type="text" name="country" value ="$arr[country]"/></td>
	</tr>
	<tr>
	  <td>Sex:</td>
	  <td>
	   <select name="sex" selected ="$arr[sex]">
	   <option value="1">Male
	   <option value="2">Female
	   </select>
	  </td>
	</tr>
	<tr>
	  <td>&nbsp</td>
	  <td><input type="submit" value="Update"/></td>
	</tr>
	</table>
   </form>
EOT;
mysql_close();

} else {
	print "I don't know what to do";
}

?>