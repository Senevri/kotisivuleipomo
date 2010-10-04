<?php 
echo "tehdaan galleria\n";
$imagedir="images_in";
$imagick='E:\\Tools\\ImageMagick-6.6.0-Q8';
$cmd = trim($argv[1]);
if($cmd="path") {
	$imagedir = trim($argv[2]);
}

$header = file_get_contents("templates\\gallery_header.tpl.html");
$footer = file_get_contents("templates\\footer.tpl.html");
$files = scandir($imagedir);
$tmp = array();
$col = 0;
$body = "<div>\n
	<!-- a href=\"index.htm\">
	<img style=\"border: 0px solid ; width: 176px; height: 64px;\" alt=\"Takaisin\" src=\"static/takaisin_2.gif\">
	</a -->\n
	</div>\n";
$body .="<!-- h2>Otsikko</h2><div><i><h4>Paikka ja aika</h4></i><span>teksti�</span></div><table><tr -->";
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
	if ($col==6) {
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
//$header = file_get_contents("templates\\image_header.tpl.html");
$template = file_get_contents('templates\gallery_view.tpl.php');
$output = $template;
foreach($files as $file ) {
	if($index>0) {
		$prev = $index-1;
		$content = "<a href=\"$files[$prev].html\">";
		$content .= "<img src=\"thumbnails/tn_$files[$prev]\" alt=\"edellinen\" /></a>";
		$output = str_replace('<!--prev-->', $content, $template);
	}
	$output = str_replace('<!--file-->', $file, $output);
	if($index!=(count($files)-1) ) {
		$next = $index+1;
		$content = "<a href=\"$files[$next].html\">";
		$content .= "<img src=\"thumbnails/tn_$files[$next]\" alt = \"seuraava\" /></a>";
		$output = str_replace('<!--next-->', $content, $output);
	}
	file_put_contents($outfile . $file . ".html", $output);
	$index++;
}	
?>
