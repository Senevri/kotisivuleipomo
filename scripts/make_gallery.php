<?php 
$subdir="alikansio";
echo "tehdaan galleria\n";
$imagedir="images_in";
$imagick='c:\\Apps\\ImageMagick-6.9.2-Q16';
$cmd = trim($argv[1]);
if($cmd=="path") {
	$imagedir = trim($argv[2]);
	$cmd = trim($argv[3]);
}


$header = file_get_contents("templates\\gallery_header.tpl.html");
$footer = file_get_contents("templates\\footer.tpl.html");
$files = scandir($imagedir);
$tmp = array();
$col = 0;
$body .= "<!--galleria--><h2 class=\"gallery\">Otsikko</h2><div><i><h4>Paikka ja aika</h4></i><span>tekstiä</span></div>";
$body .= "<table class=\"gallery\"><tr>";
foreach($files as $file) {
	if(strtolower(substr($file, -3, 3))=="jpg") {
		$tmp[] = str_replace(' ', '_', $file);
	}
}
if ($cmd=="scandir") {
	echo "kirjoitetaan vain tiedostot tekstifiluun";
	file_put_contents("files.txt", implode("\n", $tmp));
	exit();
}
if ($cmd=="usefile") {
	echo "käytetään files.txt:tä tiedostojen järjestykseen.";
	$tmp = explode("\n", file_get_contents("files.txt"));	
}


$files = $tmp;

foreach($files as $file) {
	echo $file."\n";
}

$unixsubdir="";
if (strlen($subdir)>0) {
	$unixsubdir=$subdir . "/";	
}
foreach($files as $file) {
	//if(strtolower(substr($file, -3, 3))=="jpg") {
	$body .= "<td><a href=\"gallery/$unixsubdir$file.html\">\n<img src=\"gallery/" .$unixsubdir. "thumbnails/tn_$file\" /><a></td>\n";
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
if($cmd!="update") {
	file_put_contents($outfile, $header . $body . $footer);
} else {
	$template = file_get_contents("baked\\galleria.html");
	$template = str_replace('<!--galleria-->', $body, $template);
	file_put_contents($outfile, $template);
}

$index = 0;
//$outfile="baked\\gallery\\". date("Y-m-j");

$outfile="baked\\gallery\\";
if(strlen($subdir)>0) {
	$outfile .= $subdir . "\\";	
}

//$header = file_get_contents("templates\\image_header.tpl.html");
$template = file_get_contents('templates\gallery_view.tpl.php');
$output = $template;


foreach($files as $file ) {
	if($index>0) {
		$prev = $index-1;
		$content = "<a href=\"$files[$prev].html\">";
		$content .= "<img src=\"thumbnails/" . "tn_$files[$prev]\" alt=\"edellinen\" /></a>";
		$output = str_replace('<!--prev-->', $content, $template);
	}
	$output = str_replace('<!--file-->', $file, $output);
	if($index!=(count($files)-1) ) {
		$next = $index+1;
		$content = "<a href=\"$files[$next].html\">";
		$content .= "<img src=\"thumbnails/" . "tn_$files[$next]\" alt = \"seuraava\" /></a>";
		$output = str_replace('<!--next-->', $content, $output);
	}
	//if (strlen($subdir) > 0) {
	//	$output = str_replace("{{subdir}}",  , $output);
	//}
	file_put_contents($outfile . $file . ".html", $output);
	$index++;
}	
?>
