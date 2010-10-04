#!bash
#HTED="E:/Tools/KompoZer_0.7.10/kompozer.exe"
HTED='D:/Program Files/Trellian/Trellian WebPage/WebPage.exe'
TIMESTAMP="bin/date +%Y-%m-%d_%H%M%S"
cp templates/juhan_kuulumisia.tpl.html "./kuulumiset_in/kuulumiset_"`$TIMESTAMP`".html"
$HTED kuulumiset_in/kuulumiset_"`$TIMESTAMP`".html

