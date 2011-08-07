<?php 
$lines = file(trim($argv[1]));
if(is_array($lines)){
	$out = 0;
	//array_pop()
	echo "start ". $argv[1] ;
	foreach($lines as $line) {
		if(substr(trim($line), 0, 5)=="<BODY") {
			$out=1;
			$comment=true;
		}
		if(trim($line)=="</BODY>") $out=0;
		if($comment!=true) {
			if($out==1) { echo $line;

			}
		} else $comment=false;
	}
}

?>
