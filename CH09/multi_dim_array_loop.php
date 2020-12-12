<?php

$books = array (
					array ( name => 'Web Publishing',
			  				edition => '2nd',
			  				price => "BDT 300" ),
					array ( name => 'Expert Networking',
			  				edition => '2nd',
			  				price => "BDT 280" ),
					array ( name => 'Linux Networking',
			  				edition => '1st',
			  				price => "BDT 300" ),
					array ( name => 'Red Hat/Fedora Linux',
			  				edition => '2nd',
			  				price => "BDT 500" ),
					array ( name => 'Windows 2000 Server',
			  				edition => '1std',
			  				price => "BDT 450" )
				);

foreach ( $books as $vals) {
		{
		foreach ( $vals as $key=>$final_val ) {
				print "$key: $final_val<br>";
			}
		print "<br>";
		}

		};


?>