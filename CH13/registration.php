<?php
if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username'])) {
	$ret = add_to_database();
	if (!$ret) {
		print "Error: Database error";
		} else {
		print "Thank you for submission";
		}
} else {
	write_form();
}

//functions
function write_form() {
	$self =$_SERVER['PHP_SELF'];
	echo <<<EOT
	<form action="$self" method="POST">
	<table>
	<tr>
	  <td>First Name:</td>
	  <td><input type="text" name="firstname" /></td>
	</tr>
	<tr>
	  <td>Last Name:</td>
	  <td><input type="text" name="lastname" /></td>
	</tr>
	<tr>
	  <td>User Name:</td>
	  <td><input type="text" name="username" /></td>
	</tr>
	<tr>
	  <td>E-mail:</td>
	  <td><input type="text" name="useremail" /></td>
	</tr>
	<tr>
	  <td>Web URL:</td>
	  <td><input type="text" name="userweb" /></td>
	</tr>
	<tr>
	  <td>Country:</td>
	  <td><input type="text" name="country" /></td>
	</tr>
	<tr>
	  <td>Sex:</td>
	  <td>
	   <select name="sex">
	   <option value="1">Male
	   <option value="2">Female
	   </select>
	  </td>
	</tr>
	<tr>
	  <td>&nbsp</td>
	  <td><input type="submit" /></td>
	</tr>
	</table>
   </form>
EOT;
}

function add_to_database() {
	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['lastname']);
	$username = trim($_POST['username']);
	$email = trim($_POST['useremail']);
	$web =trim($_POST['userweb']);
	$country = trim($_POST['country']);
	$sex = trim($_POST['sex']);
	
	mysql_connect("localhost","root") or die("Couldn't connect to server");
	mysql_select_db("my_site");
	check_user($username);
	check_email($email);
	$sql = "INSERT INTO `site_users` (`user_id`, `first_name`, `last_name`, `username`, `user_email`, `user_web`, `country`, `sex`) VALUES ('', '$firstname', '$lastname', '$username', '$email', '$web', '$country', '$sex')";
	mysql_query($sql);
	mysql_close();
	return true;
}

//this will check whether there is user with same user name
function check_user($usr) {
	
	$sql = "SELECT * FROM `site_users` WHERE username='$usr'";
	$result = mysql_query($sql);
	$rows =mysql_num_rows($result);
	if ($rows>0) {
		print "The user $usr already exists. Please select another username.";
		exit;
	}
}
//checks that email is unique
function check_email($em) {
	
	$sql = "SELECT * FROM `site_users` WHERE user_email='$em'";
	$result = mysql_query($sql);
	$rows =mysql_num_rows($result);
	if ($rows>0) {
		print "The e-mail address $em already exists. Please type another e-mail address.";
		exit;
	}
}
?>