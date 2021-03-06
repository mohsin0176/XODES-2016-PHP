<?php
function flag_error ($fieldname, $errstr)
{
     global $fields_with_errors, $errors;
     $fields_with_errors[$fieldname] = 1;
     $errors[] = $errstr;
}
function has_error ($fieldname)
{
     global $fields_with_errors;
     if (isset ($fields_with_errors[$fieldname]))
          return true;
     return false;
}
/* define (DB_ERR_DOC, '<html><body>Due to an internal error on the server ' .
                    'your request cannot be processed at this time. ' .
                    'Please try again in a few minutes.</body></html>');
*/
$p =& $_POST;
$errors = array();

if (count ($p) > 0)
{
     // error checking
     if (trim ($p['firstname']) == '')
          flag_error ('firstname', 'Please enter your first name.');
     if (trim ($p['lastname']) == '')
          flag_error ('lastname', 'Please enter your last name.');
     if (trim ($p['username']) == '')
          flag_error ('username', 'Please enter a username.');
     elseif (eregi ('[^a-z0-9]', $p['username']))
          flag_error ('username', 'The username you chose is not valid. ' .
                      'Usernames may only contain letters and digits.');
     if (trim ($p['password']) == '')
          flag_error ('password', 'Please enter a password.');

     // if data is otherwise valid, try to insert record
     if (count ($errors) == 0)
     {
          //code for database connection and record insertion
     }

     if (count ($errors) == 0)
     {
          // SUCCESS!
          $msg = sprintf ('User account created for <b>%s %s</b> with ' .
                          'username <b>%s</b> and user id <b>%s</b>.',
                          $p['firstname'], $p['lastname'],
                          $p['username'], $user_id);
          print ('<html><body>' . $msg . '</body></html>');
          exit;
     }
}
?>
<html>
<head>
     <title>Sign Up Today!</title>
     <style type="text/css">
          *       { font-family: sans-serif }
          *.error { font-size: smaller;
                    font-weight: bold;
                    color: red; }
     </style>
</head>
<body bgcolor="#FFFFFF">
<h2>Sign Up for Your Free Account</h2>
<hr noshade>
<small>Please fill out the form below to register for an account. When you
register, you will be allowed to ask and answer questions on our site.
Your username must contain only letters and digits (no punctuation or
spaces).</small>
<?php
if (count ($errors) > 0)
{
     ?>
     <p class="error">There were errors in your form. Please correct
     the following errors and resubmit the form:</p>
     <ul>
     <?php
          $n = count ($errors);
          for ($i = 0; $i < $n; $i++)
               print ("<li class=\"error\">" . $errors[$i] . "</li>\n");
     ?>
     </ul>
     <?php
}
?>
<form action="<?php print ($PHP_SELF); ?>" method="POST">
<table border="0">
<tr>
     <td align="right">
          <font size="1"><b>FIRST NAME</b></font></td>
     <td align="left">
          <input type="text" name="firstname"
           value="<?php if (isset ($p['firstname'])) print ($p['firstname']);
           ?>" />
          <?php if (has_error ('firstname')) print ('<span class="error">
          *</span>'); ?></td>
</tr>
<tr>
     <td align="right">
          <font size="1"><b>LAST NAME</b></font></td>
     <td align="left">
          <input type="text" name="lastname"
           value="<?php if (isset ($p['lastname'])) print ($p['lastname']);
           ?>" />
          <?php if (has_error ('lastname')) print ('<span class="error">
          *</span>'); ?></td>
</tr>
<tr>
     <td align="right">
          <font size="1"><b>USERNAME</b></font></td>
     <td align="left">
          <input type="text" name="username"
           value="<?php if (isset ($p['username'])) print ($p['username']);
           ?>" />
          <?php if (has_error ('username')) print ('<span class="error">
          *</span>'); ?></td>
</tr>
<tr>
     <td align="right">
          <font size="1"><b>PASSWORD</b></font></td>
     <td align="left">
          <input type="password" name="password"
           value="<?php if (isset ($p['password'])) print ($p['password']);
           ?>" />
          <?php if (has_error ('password')) print ('<span class="error">
          *</span>'); ?></td>
</tr>
<tr>
     <td align="center" colspan="2">
          <font size="1"><b>REMEMBER PASSWORD:</b></font>
          <input type="checkbox" name="setcookie" value="1"
          <?php if (isset ($p['setcookie'])) print (' checked'); ?> /></font></td>
</tr>
<tr>
     <td>&nbsp;</td>
     <td><input type="submit" name="submit" value="Submit" /></td>
</tr>
</table>
</form>
</body>
</html>