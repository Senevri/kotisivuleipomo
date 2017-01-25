<!doctype html>
<html>
    <head>
        <style>
        
        </style>
    </head>
    <body>
        <header></header>
        <section>
            <span>Hello, world!</span>
            <span><?php
echo htmlspecialchars($_GET["url"]);
if (!file_exists('files')) {
    mkdir('files', 0777, true);
}


$url = $_GET['url'];
$fname = basename($url);

/* write a file from url  in files folder */
//file_put_contents("files/$fname", fopen($url, "r"));
//$data = file_get_contents(fopen($url, "r"));

/* encode image in bae64 and display as image*/

$base64="";
/*function encode_base64_src($url) {
    $data = file_get_contents($url);
    $type = pathinfo($url, PATHINFO_EXTENSION);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return $base64;
}
$base64 = encode_base64_src($url);
 */

$data = fopen($url, "r");
$connection = ftp_connect( "ftp.example.fi" ) or die("ftp connection fail");

if (ftp_login($connection, "uname", "paswd")) {
    ftp_pasv($connection, true) or die("could not switch to passive mode");
    ftp_chdir($connection, 'public/html/dev');
    ftp_fput($connection, $fname, $data, FTP_BINARY) or die("could not ftp put file $fname");
}



?></span>
    <img src="<?php echo $base64 ?>"></img>
        </section>
        <footer></footer>
    </body>
</html>