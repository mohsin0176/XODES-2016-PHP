<html>
   <head>
      <title>Example Form - Multiple Select</title>
    </head>
   <body>
    <form action="process2.php" method="POST">
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
        <textarea cols="50" rows="8" wrap="VIRTUAL" name="comment"></textarea> <br />
        <input type="submit" value="Send" />
    </form>
   </body>
</html>
