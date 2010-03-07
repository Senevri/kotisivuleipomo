@echo off
echo tehdaan web-kokoiset kuvat...
cd images_in
E:\Tools\ImageMagick-6.6.0-Q8\mogrify -format jpg *
for %%a in (*.jpg) do E:\Tools\ImageMagick-6.6.0-Q8\convert -define jpeg:size=800x600 %%a -resize 800x600 -background black -gravity center -extent 800x600 ..\baked\gallery\%%a
cd ..
