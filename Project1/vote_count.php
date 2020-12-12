<?php
// এই জরিপের জন্য কুকি ইউজারের মেশিনে সেট করা হযেছে কি না যাচাই করে দেখবে
// কুকি থাকলে তার বোট নেয়া হবে না
if (isset($_COOKIE) && !empty($_COOKIE)) {
    if ($_COOKIE['lastpoll'] && $_COOKIE['lastpoll'] == $_POST['qid']) {
        die('ERROR: You have already voted in this poll');
    }
}

// কুকি না থাকলে তার ভোট গ্রহণ করো এবং এই কুকি সেট করো
setCookie('lastpoll', $_POST['qid'], time() + 2592000);

?>
<html>
<head>
<title>Online Voting System</title>
</head>
<body>
<?php





//নিচের কোডটি দেখে নেবে ফরম সাবমিট করা হযেছে কিনা। ফরম সাবমিট করা হলে এটি দেখবে উত্তরের নম্বর (aid) কত
//উত্তরের নম্বর না থাকা মানে ইউজার কোনো অপশন সিলেক্ট না করেই ভোট দিযেছে। এটি ইউজারকে জানিয়ে দেয়া হবে
if (isset($_POST['submit'])) {

    if (!isset($_POST['aid'])) {
        die('ERROR: Please select one of the available choices');
    }

    // ডাটাবেজ সংযোগের জন্য কনফিগারেশন ফাইল যোগ করবে
    include('config.php');
    
    // ডাটাবেজ সংযোগ তৈরি করবে
    $connection = mysql_connect($host, $user, $pass) or die('ERROR: Unable to connect!');
    
    // ডাটাবেজ সিলেক্ট করবে
    mysql_select_db($db) or die('ERROR: Unable to select database!');
    
    // ভোটের কাউন্টার আপডেট করবে। লক্ষ্য করুন এখানে প্রতিটি উত্তরের aid কীভাবে ব্যবহার করা হচ্ছে
    $query = "UPDATE answers SET acount = acount + 1 WHERE aid = ".$_POST['aid']." AND qid = ".$_POST['qid'];
    $result = mysql_query($query) or die("ERROR: $query. ".mysql_error());

    // ডাটাবেজ সার্ভারেরসাথে সংযোগ বন্ধ করবে
    mysql_close($connection);


    // ভোট দেয়া সফল হয়েছে কি না তা ইউজারকে জানাবে    
    echo 'Your vote was successfully registered!';
}
else {
    die('ERROR: Data not correctly submitted');
}

?>

</body>
</html> 
