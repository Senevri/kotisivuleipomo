#!bash
echo tehdaan web-kokoiset kuvat...
cd images_in
IMAGIC="E:/Tools/ImageMagick-6.6.0-q8"
$IMAGIC/mogrify -format jpg *
for file in *.jpg 
do 
	$IMAGIC/convert -define jpeg:size=800x600 $file -resize 800x600 -background black -gravity center -extent 800x600 ../baked/gallery/$file
done
cd ..
