#!bash
USER=""
PASSWORD=""
SERVER=""
FTP="ftp"
CMD="$FTP -m -R -u $USER -p $PASSWORD $SERVER / baked/"
$CMD
