<html>
<head>
<title>Online Voting System</title>
</head>
<body>

<?php

// কনফিগারেশন ফাইল যোগ করি
include('config.php');  //এই ফাইলের মধ্যে আমরা ডাটাবেজ কানেকশনের কনফিগারেশন রাখব

// ডাটাবেজ সার্ভারের সাথে সংযোগ তৈরি করি
$connection = mysql_connect($host, $user, $pass) or die('ERROR: Unable to connect!');

// ডাটাবেজ সার্ভার থেকে আমাদের কাংক্ষিত ডাটাবেজ সিলেক্ট করি
mysql_select_db($db) or die('ERROR: Unable to select database!');

// প্রশ্ন বাছাইয়ের জন্য এই কোয়েরি চালাতে হবে
$query = "SELECT qid, qtitle FROM questions ORDER BY qdate DESC LIMIT 0, 1";
$result = mysql_query($query) or die("ERROR: $query.".mysql_error());

// কোনো রেকর্ড পাওয়া গেলে বা কোনো প্রশ্ন সেখানে থাকলে যা করতে হবে
if (mysql_num_rows($result) > 0) {
    $row = mysql_fetch_object($result);

    // প্রশ্নের নম্বর ও শিরোনাম সংগ্রহ করবে ও তা স্ক্রিনে দেখানো হবে
    $qid = $row->qid;
    echo '<h2>'.$row->qtitle .'</h2>';
    echo "<form method = post action = 'vote_count.php'>";
    
    // প্রশ্নের নম্বর (qid) অনুসারে উত্তরসমূহ বেছে নেয়া হবে
    $query = "SELECT aid, atitle FROM answers WHERE qid = '$qid'";
    $result = mysql_query($query) or die("ERROR: $query.".mysql_error());

    if (mysql_num_rows($result) > 0) {

        // উত্তরের অপশনগুলি রেডিও বাটন হিসেবে দেখাবে
        while ($row = mysql_fetch_object($result)) {
            echo "<input type = radio name = aid value = '".$row->aid."'>".$row->atitle."</input><br />";
        }

    echo "<input type = hidden name = qid value = '".$qid."'>";
    echo "<input type = submit name = submit value = 'Vote!'>";
    }
    
    echo '</form>';
}

// কোনো প্রশ্ন পাওয়া না গেলে নিচের মেসেজ দেখাবে
else {
    echo '<font size="-1"> Sorry! Currently there is no active poll. </font>';
}

// ডাটাবেজের সাথে সংযোগ বন্ধ করবে
mysql_close($connection);

?>

</body>
</html> 
