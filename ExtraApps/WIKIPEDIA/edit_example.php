<?PHP
include 'wikipedia.class.php';
$x = new wikipedia('http://en.wikipedia.org/');
echo $x->edit_page('Content_Management_System', true);
?>