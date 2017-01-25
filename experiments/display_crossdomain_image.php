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
//file_put_contents("files/$fname", fopen($url, "r"));
//$data = file_get_contents(fopen($url, "r"));
$data = file_get_contents($url);
$type = pathinfo($url, PATHINFO_EXTENSION);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);



?></span>
    <img src="<?php echo $base64 ?>"></img>
        </section>
        <footer></footer>
    </body>
</html>
