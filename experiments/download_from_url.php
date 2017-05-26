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
file_put_contents("files/$fname", fopen($url, "r"));
 



?></span>

        </section>
        <footer></footer>
    </body>
</html>
