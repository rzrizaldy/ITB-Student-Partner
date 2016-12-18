<!DOCTYPE html>
<html lang="en">
<head>
  <title>ITB Menulis</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="./css/mainstyle.css" rel="stylesheet">
</head>
<body>

<div class="wrapper-utama">
<div class="container-utama">
<h1 style="font-family: serif;"><center>ITB Menulis</center></h1>
  <h5 style="font-family: serif;"><I style="color:#fff"><center>This is where you can look into every ITB academicians mind</center></I></h5>
  <!-- page tab -->
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#blog">blog(s)</a></li>
    <li><a data-toggle="tab" href="#menu1">add more blog</a></li>
  </ul>

  <div class="tab-content">
    <div id="blog" class="tab-pane fade in active">
      <div class="content">
            <?php

            $url = array();
            $cookie_name = "data_url";

            if(isset($_COOKIE[$cookie_name])){
            	$url = unserialize($_COOKIE[$cookie_name]);
            }else{
            	$url = array("https://riochr17.wordpress.com/feed/", "http://heyitsekatheresia.blogspot.com/feeds/posts/default?alt=rss", "https://medium.com/feed/@serunifauzialestari", "https://rinaldimunir.wordpress.com/feed", "https://medium.com/feed/@rafidwiriz", "https://readablemind.wordpress.com/feed", "https://medium.com/feed/@Nicoloci");
            } // daftar inisiasi blog

            // submit rss ke cookie
            if(isset($_POST['blogrss'])){
            	if(!in_array($_POST['blogrss'], $url)){
  	          	array_push($url, $_POST['blogrss']);
  	          	setcookie($cookie_name, serialize($url));
  	        }
            }

            //menyimpan url blog yang baru di submit ke dalam array
            $data_to_show = array();
            foreach($url as $key => $value){
  			$xml = simplexml_load_file($value);
  			foreach($xml->channel->item as $itm){
  				array_push($data_to_show, $itm);
  			}
  	      }
  	      	
  	      	//mengurutkan daftar konten blog
  	      	function cmp($a, $b){
  	      		return (strtotime($a->pubDate) < strtotime($b->pubDate)) ? 1 : -1;
  	      	}

  	      	usort($data_to_show, "cmp");

  	      	//menampilkan daftar konten blog
  			echo '<ul class="list-group">';
  			foreach($data_to_show as $key => $itm) {
  				$title = $itm->title;
  				$link = $itm->link;
  				$description = $itm->description;
  				$date = $itm->pubDate;
  				echo '<li class="list-group-item"><a href =" '.$link.'">' .$title.'</a> <hr>'.$description.'<br>' .$date.'</li>';
  			}

  			echo '</ul>';
            ?>
      </div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <div class="center">
      	<!-- menampilkan form untuk memasukkan rss website -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
  	      <label for="blogrss">Enter Your Website RSS Feed</label>
  	      <input type="text" id="blogrss" name="blogrss">
  	      <button for="blogrss" value="Submit" class="button">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
  </div>
  <script type="text/javascript">
  $(document).ready(function(){
  	// untuk menampilkan thumbnail gambar dari sebuah postingan
  	$('img').css({'height': '500px', 'width': '500px'});
  });
  </script>
</body>
</html>