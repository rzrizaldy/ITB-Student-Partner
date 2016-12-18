<html>
    <head>
		<title>NIM Finder</title>
    	<?php
			require('./headnav.php');
			require('./scripts.php');
		?>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/mainstyle.css" rel="stylesheet">
        <script>
			function showHint(str) {
			    if (str.length == 0) { 
			        document.getElementById("txtHint").innerHTML = "";
			        return;
			    } else {
			        var xmlhttp = new XMLHttpRequest();
			        xmlhttp.onreadystatechange = function() {
			            if (this.readyState == 4 && this.status == 200) {
			                document.getElementById("txtHint").innerHTML = this.responseText;
			            }
			        };
			        xmlhttp.open("GET", "gethint.php?q=" + str, true);
			        xmlhttp.send();
			    }
			}
		</script>

		<script type="text/javascript"> 
			function stopRKey(evt) { 
				var evt = (evt) ? evt : ((event) ? event : null); 
				var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
				if ((evt.keyCode == 13) && (node.type=="text"))  {
					return false;
				} 
			}
			document.onkeypress = stopRKey; 
		</script>
    </head>
    <body>
	    <div class="wrapper-utama" align = "center">
	    	<div class='container-utama'>
            <h3 style="color:#fff">Search Student's Name</h3>
            <form>
            	<input type="text" onkeyup="showHint(this.value)" placeholder="Student's Name">
            </form>
            <h5 style="color:#fff"><span id="txtHint"></span></h5>
        </div>
        <div class="footnya" align="center">
        	<div class="col-xs-12 col-sm-4">
	        	<h5>Kecepatan Internet Anda Mempengaruhi Kecepatan Pencarian</h5>
        	</div>
        	<div class="col-xs-12 col-sm-4">
	        	<h5>NIM Finder 1.0</h5>
        	</div>
        	<div class="col-xs-12 col-sm-4">
	        	<h5>Created by <a href="http://www.facebook.com/mahbub.haq.alfarisi" target="blank">Mahbub Haq Al Farisi/18214018</a></h5>
        	</div>
        </div>
	</body>
</html>

