@echo off
echo "tehd��n kuvakkeet"
CONVERT="E:\Tools\ImageMagick-6.6.0-Q8\convert"
cd images_in
for file in *.jpg do $CONVERT -define jpeg:size=200x200 %%a -thumbnail 115x110 -background black -gravity center -extent 115x110 ..\baked\gallery\thumbnails\tn_%%a
cd ..
pause