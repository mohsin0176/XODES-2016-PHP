<?php

$PriceOfBeef = 120;
if ($PriceOfBeef<=100) {
	print "Buy 2 kg beef";
	}
elseif ($PriceOfBeef==120) {
	print "Buy 1.5 kg beef";
	}
elseif ($PriceOfBeef==150) {
	print "Buy 1 kg beef";
	}
else {
	print "Do not buy beef. Because its price is $PriceOfBeef";
}

?>