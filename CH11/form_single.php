<?PHP
echo <<<EOT
<html>
   <head>
      <title>Example Form - Multiple Select</title>
    </head>
   <body>
    <form action="$_SERVER[PHP_SELF]" method="POST">
        User Name: <br />
        <input type="text" size="20" name="user" /> <br />
        Books in collection: <br />
        <select size="5" name="books[]" multiple>
        <option>Web Publishing
        <option>Expert Networking
        <option>Windows 2000 Professional
        <option>XML
        <option>Red Hat/Fedora Linux
        <option>Linux Networking
        </select> <br />
        Comment: <br />
        <textarea cols="50" rows="2" wrap="VIRTUAL" name="comment"></textarea> <br />
        <input type="submit" value="Send" />
    </form>
EOT;
 if ($_POST) {
 	

    print "<p>Welcome <b>$_POST[user]</b>";
    print "<p>Here is your comment: <br /> <i> $_POST[comment]</i>";
    print "<p><b>You have the following books in collection:</b>";
    print "<ol>";
    foreach ($_POST[books] as $book) {
      print "<li>$book <br />";
    }
    print "</ol>";
 }
 echo "</body></html>";
 
?>