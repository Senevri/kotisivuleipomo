<?php 
echo "tehdaan web-kokoiset kuvat...\n";
$imagedir="images_in";
$imagick='E:\\Tools\\ImageMagick-6.6.0-Q8';
$cmd = trim($argv[1]);

if($cmd="path"){
	$imagedir=trim($argv[2]);
}
$cmd = trim($argv[3]);

echo shell_exec($imagick+'\\mogrify -format jpg '+$imagedir+"\\*");
$files = scandir($imagedir);
foreach($files as $file) {
	if(strtolower(substr($file, -3, 3))=="jpg") {
		$tmp[]=$file;
	}
}
$files = $tmp; 
foreach($files as $file ) {
	printf("$file\n");
	//	printf("$imagick\\convert -define jpeg:size=800x600 \"$imagedir\\$file\" -resize 800x600 -background black -gravity center -extent 800x600 baked\\gallery\\". str_replace(' ', '_', $file));
	if($cmd!="only_tn"){
		system("$imagick\\convert -define jpeg:size=800x600 \"$imagedir\\$file\" -resize 800x600 -background black -gravity center -extent 800x600 baked\\gallery\\kuvat\\". str_replace(' ', '_', $file));
	}
	if($cmd!="no_tn") {	
		system("$imagick\\convert -define jpeg:size=200x200 \"$imagedir\\$file\" -thumbnail 115x110 -background black -gravity center -extent 115x110 baked\\gallery\\thumbnails\\tn_".str_replace(' ', '_', $file));
	}
}	
?>
