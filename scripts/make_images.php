<?php 
$subdir="alikansio";
echo "tehdaan web-kokoiset kuvat...\n";
$imagedir="images_in";
$imagick='c:\\Apps\\ImageMagick-6.9.2-Q16';
$cmd = trim($argv[1]);

if($cmd=="path"){
	$imagedir=trim($argv[2]);
	$cmd = trim($argv[3]);
}

echo shell_exec($imagick+'\\mogrify -format jpg '+$imagedir+"\\*");
$files = scandir($imagedir);
foreach($files as $file) {
	if(strtolower(substr($file, -3, 3))=="jpg") {
		$tmp[]=$file;
	}
}
$files = $tmp; 
$unixsubdir="";
if (strlen($subdir)>0) {
	$unixsubdir=$subdir . "\\";	
	mkdir("baked\\gallery\\". $unixsubdir);
	mkdir("baked\\gallery\\". $unixsubdir . "kuvat\\");
	mkdir("baked\\gallery\\" . $unixsubdir . "thumbnails\\");
	
}

foreach($files as $file ) {
	printf("$file\n");
	//	printf("$imagick\\convert -define jpeg:size=800x600 \"$imagedir\\$file\" -resize 800x600 -background black -gravity center -extent 800x600 baked\\gallery\\". str_replace(' ', '_', $file));
	if($cmd!="only_tn"){
		system("$imagick\\convert -define jpeg:size=800x600 \"$imagedir\\$file\" -resize 800x600 -background black -gravity center -extent 800x600 baked\\gallery\\". $unixsubdir . "kuvat\\" . str_replace(' ', '_', $file));
	}
	if($cmd!="no_tn") {	
		system("$imagick\\convert -define jpeg:size=200x200 \"$imagedir\\$file\" -thumbnail 115x110 -background black -gravity center -extent 115x110 baked\\gallery\\" . $unixsubdir . "thumbnails\\" . "tn_" . str_replace(' ', '_', $file));
	}
}	
?>
