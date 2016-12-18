<!DOCTYPE html >

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Restroom Location</title>
    <script type="text/javascript" src="js/maps.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top" style="margin-top:7%">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    Restroom Location<small> - A project by Rezha Kusuma</small>
                </a>
            </div>
        </div>
    </nav>
    <div id="style-selector-control" class="map-control">
      <p>POINT OF INTEREST</p>
      <input type="radio" name="show-hide" id="hide-poi"
          class="selector-control">
      <label for="hide-poi">Hide</label>
      <input type="radio" name="show-hide" id="show-poi"
          class="selector-control" checked="checked">
      <label for="show-poi">Show</label>
    </div>
    <div id="floating-panel" >
      <input onclick="showAllToilet();" type=button value="Show All Toilets" class="btn btn-info">
      <input onclick="show24hrToilet();" type=button value="Show only 24/7 Toilets" class="btn btn-info">
      <input onclick="shownot24hrToilet();" type=button value="Show only non-24/7 Toilets" class="btn btn-info">
    </div>
    <div id="map"></div>
    <br>
    <div class="col-md-6 col-centered panel panel-default">
        <h3>Help Us Complete Restroom Location in ITB!</h3>
        <br>
        <form method="post" action="add2mysql.php" name="addToilet">
            <div class="form-group">
                <label for="UserNIM">Your NIM</label>
                <input type="text" class="form-control" name="UserNIM">
            </div>
            <div class="form-group">
                <label for="ToiletName">Restroom Name</label>
                <input type="text" class="form-control" name="ToiletName">
            </div>
            <div class="form-group">
                <label for="ToiletDesc">Description</label>
                <input type="text" class="form-control" name="ToiletDesc">
            </div>
            <div class="row">
                <div class="form-group col-xs-6">
                    <label for="ToiletLat">Latitude</label>
                    <input type="text" class="form-control" name="ToiletLat" placeholder="Right-click on the desired location" value="">
                </div>
                <div class="form-group col-xs-6">
                    <label for="ToiletLng">Longitude</label>
                    <input type="text" class="form-control" name="ToiletLng" placeholder="Right-click on the desired location" value="">
                </div>
            </div>
            <div class="radio">
                 <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="0">
                     The toilet is available 24/7
                 </label>
            </div>
            <div class="radio">
                <label>
                     <input type="radio" name="optionsRadios" id="optionsRadios2" value="1">
                       The toilet is not available 24/7. Choose this if you are not sure
                 </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2qQzprSbNBaE4hsZbZudfMDAR6dMvlDk&callback=initMap">
    </script>
</body>

</html>
