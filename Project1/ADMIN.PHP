<html>
<head>
<title>Online Voting System – Administration Panel</title>
</head>
<body>

<h2>Administration Panel</h2>

<h4>Current Polls:</h4>
<table border = '0' cellspacing = '10'>

<?php

// ডাটাবেজ সংযোগের জন্য কনফিগারেশন ফাইল যোগ করবে
include('config.php');

// ডাটাবেজ সংযোগ তৈরি করবে
$connection = mysql_connect($host, $user, $pass) or die('ERROR: Unable to connect!');

// ডাটাবেজ সিলেক্ট করবে
mysql_select_db($db) or die('ERROR: Unable to select database!');

// কোয়েরি পালন করে সবকটি প্রশ্ন নেবে
$query = 'SELECT qid, qtitle, qdate FROM questions ORDER BY qdate DESC';
$result = mysql_query($query) or die('ERROR: $query. '.mysql_error());

// প্রশ্ন পাওয়া গেলে যা করবে 
if (mysql_num_rows($result) > 0) {
   // লুপ তৈরি করে দেখে নেবে
   // প্রশ্নের শিরোনাম টাইপ করবে
    while($row = mysql_fetch_object($result)) {
        ?>
        <tr>
            <td><?php echo $row->qtitle; ?></td>
            <td><a href = 'view.php?qid=<?php echo $row->qid; ?>'>view report</a></td>
            <td><a href = 'delete.php?qid=<?php echo $row->qid; ?>'>delete</a></td>
        	<td><a href = 'vote.php?qid=<?php echo $row->qid; ?>'>vote</a></td>
            </tr>
    <?php
    }
}
// কোনো প্রশ্ন পাওয়া না গেলে মেসেজ দেখাবে
else {
?>
    <font size='-1'>No polls currently configured</font>
<?php
}

// ডাটাবেজ সংযোগ বন্ধ করবে
mysql_close($connection);
    
?>

</table>


<h4>Add New Question:</h4>
<form action = 'add.php' method ='post'>
<table border = '0' cellspacing = '5'>
<tr>
    <td>Question</td>
    <td><input type = 'text' name = 'qtitle'></td>
</tr>
<tr>
    <td>Option #1</td>
    <td><input type = 'text' name = 'options[]'></td>
</tr>
<tr>
    <td>Option #2</td>
    <td><input type = 'text' name = 'options[]'></td>
</tr>
<tr>
    <td>Option #3</td>
    <td><input type = 'text' name = 'options[]'></td>
</tr>
<tr>
    <td>Option #4</td>
    <td><input type = 'text' name = 'options[]'></td>
</tr>
<tr>
    <td>Option #5</td>
    <td><input type = 'text' name = 'options[]'></td>
</tr>
<tr>
    <td colspan = '2' align = 'right'><input type = 'submit' name = 'submit' value = 'Add Question'></td>
</tr>
</table>
</form>

</body>
</html> 
