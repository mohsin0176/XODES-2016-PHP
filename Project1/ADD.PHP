<html>
<head>
<title>Online Voting System – Administration Panel</title>
</head>
<body>

<h2>Administration Panel</h2>

<?php

if (isset($_POST['submit'])) {
    // ফরমের মাধ্যমে যা দাখিল করা হলো তাতে ত্রুটি আছে কি না যাচাই করে নিই

    // প্রশ্নের শিরোনাম যাচাই করি, ফা৳কা থাকলে এরর মেসেজ দেখাই। আর এর আগে-পিছের স্পেস বাদ দিই
    if (trim($_POST['qtitle']) == '') {
        die('ERROR: Please enter a question');
    }

    // অপশনসমূহ পরিষ্কার করি, আগে-পিছের স্পেস বাদ দিই
    // এরপর অপশনগুলিকে একটি এরে হিসেবে রাখি
    foreach ($_POST['options'] as $o) {
        if (trim($o) != '') {
            $atitles[] = $o;
        }
    }

    // কমপক্ষে দুটি অপশন দেযা হয়েছে কি না তা যাচাই করে দেখি    
    if (sizeof($atitles) <= 1) {
        die('ERROR: Please enter at least two answer choices');
    }

    // ডাটাবেজ কনফিগারেশন ফাইল যোগ করি
    include('config.php');
    
    // ডাটাবেজ সংযোগ তৈরি করি
    $connection = mysql_connect($host, $user, $pass) or die('ERROR: Unable to connect!');

    // ডাটাবেজ সিলেক্ট করি
    mysql_select_db($db) or die('ERROR: Unable to select database!');
    
    // প্রশ্ন যোগ করার জন্য কোয়েরি তৈরি ও তা পালন করি
    $query = "INSERT INTO questions (qtitle, qdate) VALUES ('{$_POST['qtitle']}', NOW())";
    $result = mysql_query($query) or die("ERROR: $query.".mysql_error());

    // ইনসার্ট করা রেকর্ডের আইডি জানি
    $qid = mysql_insert_id();

    // ভ্যারিয়েবলসমূহ রিসেট করি
    unset($query);
    unset ($result);

    // এখন অপশনগুলি ইনসার্ট করি
    // প্রতিটি প্রশ্নের আইডির সাথে যুক্ত করে উত্তর ইনসার্ট করা হবে 
    foreach ($atitles as $atitle) {
        $query = "INSERT INTO answers (qid, atitle, acount) VALUES ('$qid', '$atitle', '0')";
        $result = mysql_query($query) or die("ERROR: $query. ".mysql_error());
    }

    // ডাটাবেজ সংযোগ বন্ধ করি
    mysql_close($connection);

    // প্রশ্ন যোগ করা সফল হলো কি না তা জানিয়ে দিই
    echo "Poll successfully added to the database! Click <a href='admin.php'>here</a> to return to the main page";
}
else {
    die('ERROR: Data not correctly submitted');
}

?>

</body>
</html> 
