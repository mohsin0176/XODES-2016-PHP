<html>
<head>
<title>Online Voting System – Administration Panel</title>
</head>
<body>

<h2>Administration Panel</h2>

<?php

if ($_GET['qid'] && is_numeric($_GET['qid'])) {
    // ডাটাবেজ কনফিগারেশন ফাইল যোগ করি
    include('config.php');
    
    // ডাটাবেজ সংযোগ তৈরি করি
    $connection = mysql_connect($host, $user, $pass) or die('ERROR: Unable to connect!');
    
    // ডাটাবেজ সিলেক্ট করি
    mysql_select_db($db) or die('ERROR: Unable to select database!');
    
    // উত্তর মোছার জন্য কোয়েরি তৈরি ও পালন করি
    $query = "DELETE FROM answers WHERE qid = '".$_GET['qid']."'";
    $result = mysql_query($query) or die("ERROR: $query. ".mysql_error());

    // প্রশ্ন মোছার জন্য কোয়েরি তৈরি ও পালন করি
    $query = "DELETE FROM questions WHERE qid = '".$_GET['qid']."'";
    $result = mysql_query($query) or die("ERROR: $query. ".mysql_error());

    // ডাটাবেজ সংযোগ বন্ধ করি
    mysql_close($connection);

    // প্রশ্ন মোছা সফল হলো কি না জানিয়ে দিই
    echo "Poll successfully removed from the database! Click <a href = 'admin.php'>here</a> to return to the main page";
}
else {
    die('ERROR: Data not correctly submitted');
}

?>

</body>
</html> 
