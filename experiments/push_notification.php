<?php
// Check if current file changed, if so, do a push notification.
if (isset($_GET["changed"])) {
	$timestamp = $_GET["changed"];
	//wait until file changed;
	// set_time_limit() defaults to 30.
	$timeout=20;
	while ((int)$timestamp === filemtime(__FILE__) && $timeout>0) {
		sleep(500);
		$timeout = $timeout - 1;
	} if ($timeout > 0) {
		echo "Get New";
	} else {
		echo "No Changes Within Timeout";
	}
	
} else {
?>


<!doctype html>
<html>
    <head>
		<meta name="changed" content="<?php echo filemtime(__FILE__) ?>" />
        <style>
        
        </style>
    </head>
    <body>
        <header></header>
        <section>
            <span>Hello, worasdfld!</span>
            <span>I am, once again, changed.</span>
			<p> I should be working. </p>
			<p> Long Poll </p>
			<p> Not working as expected of yet. </p>
			<span>Hello, world!</span>
            <span>I am, once again, changed.</span>
			</section>
			<section>
			
			<span>
			<?php
// Check if current file changed, if so, do a push notification.
			
			?>
			</span>
        </section>
        <footer></footer>
		<script type="text/javascript">
		(function () {
			var changed=document.getElementsByName('changed');
			var strchanged="";
			for (i=0; i<changed.length;i++) {
				if (!isNaN(i)) {
					strchanged = changed[i].getAttribute('content');
					console.log(strchanged);
				}
			}
				
			var heartbeat=window.setInterval(function (){
				console.log("long poll");
				var xmlHttp = new XMLHttpRequest();				
				xmlHttp.onreadystatechange = function (){
					if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
						////console.log(xmlHttp.responseText);
						if (xmlHttp.responseText == "Get New") {
							//console.log("get new and replace body");
							location.reload();
						}
					}
				};
				xmlHttp.open("GET", window.location.href.concat("?changed=", strchanged), true);
				xmlHttp.send(null);
				
			}, 10000); //theory: since the page is reloaded, this delay is negated.
			
// is this actually doable? 			
			var source=new EventSource(window.location.href.concat("?changed=", strchanged));
			source.onmessage = function(event) {	
			}
			//*
		})();
		</script>
    </body>
</html>
<?php } ?>