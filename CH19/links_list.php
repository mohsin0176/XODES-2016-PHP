<?PHP

function print_links($url) {
	$fp = fopen($url, "r") or die("Couldn't open $url");
	$page = " ";
	while ($new_text = fgets($fp,1024)) {
		$page .= $new_text;
	}

	$match_result = preg_match_all('/<\s*A\s*HREF="([^\"]+)"\s*>([^>]*)<\/A>/i', $page, $match_array, PREG_SET_ORDER);
	
	foreach ($match_array as $entry) {
		$href = $entry[1];
		$anchortext = $entry[2];
		print "<b>HREF</b>: $href <b>Anchortext:</b>:$anchortext<br/>";
		
	}
}

print_links("http://www.w3.org/2004/02/Process-20040205/tr.html");
?>