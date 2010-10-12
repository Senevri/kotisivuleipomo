<?php 
$lines = file(trim($argv[1]));
if(is_array($lines)){
	$out = 0;
	//array_pop()
	foreach($lines as $line) {
		if(trim($line)=="<!--start block-->") {
			$out=1;
			$comment=true;
		}
		if(trim($line)=="<!--end block-->") $out=0;
		if($comment!=true) {
			if($out==1) echo $line; 
		} else $comment=false;
	}
}

?>
