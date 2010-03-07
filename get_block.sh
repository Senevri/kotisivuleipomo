#!bash
# usage: $0 <filename
FLAG=0
echo start
while read LINE; do
#for ((LINE in `cat $1`)); do
	#read LINE
	echo "doing stuff"
	echo $LINE;
	if [ "$LINE" = "" ] ; then break ; fi
	if [ "$line"="<!--start block -->"]
	then 
		$FLAG=1	
	fi
	if ["$line"="<!--end block-->"]
	then $FLAG="0"
	fi
	if ["$FLAG"="1"]
	then echo $line
	fi
	echo "loop"
done
