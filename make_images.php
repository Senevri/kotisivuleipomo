<?php 
echo "tehdaan web-kokoiset kuvat...";
$imagedir="images_in";
$imagick='E:\\Tools\\ImageMagick-6.6.0-Q8';

echo shell_exec($imagick+'\\mogrify -format jpg '+$imagedir+'\\*');
$files = scandir($imagedir);
foreach($files as $file ) {
	echo($file);
	//echo $imagick+'\\convert -define jpeg:size=800x600 '+"$imagedir+'\\'+$file"+' -resize 800x600 -background black -gravity center -extent 800x600 baked\\gallery\\'+$file;
	/*$out = shell_exec($imagick+'\\convert -define jpeg:size=800x600 '+"$imagedir+'\\'+$file"+' -resize 800x600 -background black -gravity center -extent 800x600 baked\\gallery\\'+$file);
	echo $out;
	$out = shell_exec($imagick+'\\convert -define jpeg:size=200x200 '+"$imagedir+'\\'+$file"+' -thumbnail 115x110 -background black -gravity center -extent 115x110 baked\\gallery\\thumbnails\\tn_'+$file);
	echo $out;*/
}	
?>
