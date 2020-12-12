<html>
   <head>
      <title>Example Form Processor</title>
    </head>
   <body>
    <?php
    print "Welcome <b>$_POST[user]</b>";
    print "<p>Here is your comment: <br /> <i> $_POST[comment]</i>";
    print "<p><b>You have the following books in collection:</b>";
    print "<ol>";
    foreach ($_POST[books] as $book) {
      print "<li>$book <br />";
    }
    print "</ol>";
    ?>
   </body>
</html>
