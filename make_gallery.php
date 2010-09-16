<?php 
echo "tehdaan galleria\n";
$imagedir="images_in";
$imagick='E:\\Tools\\ImageMagick-6.6.0-Q8';

$header = file_get_contents("templates\\gallery_header.tpl.html");
$footer = file_get_contents("templates\\footer.tpl.html");
$files = scandir($imagedir);
$tmp = array();
$col = 0;
$body = "<div>\n
	<a href=\"index.htm\">
	<img style=\"border: 0px solid ; width: 176px; height: 64px;\" alt=\"Takaisin\" src=\"takaisin_2.gif\">
	</a>\n
	</div>\n";
$body .="<h2>Otsikko</h2><div><i><h4>Paikka ja aika</h4></i><span>tekstiä</span></div><table><tr>";
foreach($files as $file) {
	if(strtolower(substr($file, -3, 3))=="jpg") {
		$tmp[] = str_replace(' ', '_', $file);
	}
}
$files = $tmp;
foreach($files as $file) {
	//if(strtolower(substr($file, -3, 3))=="jpg") {
	$body .= "<td><a href=\"gallery/$file.html\">\n<img src=\"gallery/thumbnails/tn_$file\" /><a></td>\n";
	$col++;
	if ($col==4) {
		$col=0;
		$body .= "</tr>\n<tr>\n";
	}
	//}
}
$body = $body . "</table>\n<hr />\n";
//if ($flag!=1) $body+="</tr>";
//printf($header);
//printf($body);
//printf($footer);

$outfile="baked\\galleria-" . date("Y-m-j") . ".html";
echo $outfile . "\n";
file_put_contents($outfile, $header . $body . $footer);

$index = 0;
//$outfile="baked\\gallery\\". date("Y-m-j");
$outfile="baked\\gallery\\";
$header = file_get_contents("templates\\image_header.tpl.html");
foreach($files as $file ) {
	$body = "<div>\n
		<a href=\"..\galleria" . /*date("Y-m-j") .*/ ".htm\">
	<img style=\"border: 0px solid ; width: 176px; height: 64px;\" alt=\"Takaisin\" src=\"..\\takaisin_2.gif\">
	</a>\n
	</div>\n";
	$body.="<table><tr><td>";
	if($index>0) {
		$prev = $index-1;
		$body .= "<a href=\"$files[$prev].html\">";
		$body .= "<img src=\"thumbnails/tn_$files[$prev]\" alt=\"edellinen\" /></a>";
	}
	$body .= "</td><td><img src=\"kuvat/$file\" /></td><td>";

	if($index!=(count($files)-1) ) {
		$next = $index+1;
		$body .= "<a href=\"$files[$next].html\">";
		$body .= "<img src=\"thumbnails/tn_$files[$next]\" alt = \"seuraava\" /></a>";
	}
	$body .= "</td></tr></table>\n";
	$body .= "<div id=\"kuvateksti\"></div>";
	file_put_contents($outfile . $file . ".html", $header . $body . $footer);
	$index++;
}	
?>
