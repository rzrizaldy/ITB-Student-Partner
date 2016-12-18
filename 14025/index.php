<meta charset="UTF-8">
    <title>Ride lots. Run far.</title>
<link rel="stylesheet" href="18214025CaloriesCounter.css">

<div class="fullscreen nopadding">
    <div id="header">
        <img src="http://bbhuisjeweltevree.be/img/bike_hike_icon.png" width="100px" />
        <ul>
            <li>Home</li>
            <li>About</li>
        </ul>
    </div>
    <div class="header">
        <h1>"Running vs Cycling."</h1>
        <p>Which exercise you want to do? Hmm let us know it..</p>
    </div>
</div>

<div class="white nopadding more">
    <a id="more">&#x25BC; More &#x25BC;</a>
</div>

<div class="white">
    <a id="test"></a>
    <h1>Bersepeda atau Berlari? </h1>
    <img class="floatleft" src="http://scoutsixteen.com/wp-content/uploads/2013/07/JD_MJ2.jpg" />
    <p><a href="http://www.fatsecret.co.id/kebugaran/bersepeda">Bersepeda</a> Yap, menikmati pemandangan alam dengan menggunakan sepeda adalah hal yang sangat menyenangkan. Selain kesenangan, manfaat bersepeda juga sangat banyak bagi kesehatan Anda. Selain sebagai alat untuk rekreasi, bersepeda membuat tubuh bergerak aktif. Sebagaimana kita tahu, tubuh yang aktif adalah salah satu syarat penting untuk menjaga kualitas kesehatan kita. Bersepeda sendiri, jika dilakukan minimal 2,5 jam seminggu secara rutin memiliki dampak positif bagi kesehatan tubuh. Bersepeda juga memiliki beberapa kategori cara bersepeda diantaranya yaitu bersepeda santai(16 km/h), lambat(18 km/h), sedang(21 km/h), cepat(24 km/h) dan sangat cepat (28 km/h). </p>
    <img class="floatright" src="http://www.natural-homeremedies.com/fitness/wp-content/uploads/2010/11/Keeping-Your-Body-Fit-With-Running.jpg" />
    <p><a href="http://www.fatsecret.co.id/kebugaran/lari-10-km-jam">Berlari</a> Sebenarnya, dengan rutin menjalankan lari pagi, kerja jantung bisa lebih baik lagi yang berakibat aliran darah pun menjadi lancar. Jika aliran darah lancar, jantung tidak perlu bekerja lebih berat yang bisa berdampak tekanan darah jadi menurun. Kondisi darah yang menurun ini malah bisa mendatangkan banyak penyakit berbahaya seperti stroke dan hipertensi.  Dengan semakin baiknya ritme kerja jantung akan baik pula metabolisme tubuh sehingga baik untuk  memperpanjang usia. Sedangkan Manfaat lari pagi bagi wanita bisa mempercantik kulit karena aliran darah menjadi  lancar sehingga kecerahan kulit menjadi terjaga. Berlari sendiri memiliki beberapa kategori diantaranya yaitu berlari santai(10 km/h), sedang(13 km/h), dan  cepat(15 km/h).</p>
    <center><p> "Lalu dibandingkan dengan treadmill, apakah lebih membakar kalori?" </p></center>
</div>

<div class="semitrans">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="ajax.js"></script>

    <center><pre>Disini anda dapat menghitung berapa kalori yang terbakar dan
jumlah hidrasi yang dibutuhkan dengan cara bersepeda ataupun berlari yang
anda inginkan. Selain itu juga anda dapat mencari rute terbaik untuk
anda ke tempat yang anda inginkan dengan direction yang tertera di
kanan map.

"Selamat berolahraga kawan! Enjoy your day!"
    </pre></center>

    

    <p>
    <label for="distanceInKm">Distance: </label>
    <input type="text" name="distanceKm" id="distanceKm" readonly="true" />
     <label for="distanceInKm">km</label>
     <input type="text" name="distanceMl" id="distanceMl" readonly="true" />
     <label for="distanceInMiles">Miles</label>
    </p>
    
    <p><label> Exercise you want to do: </label>
    <select id="velocity">
        <option value="Sepeda16km">Bersepeda santai(16 km/h)</option>
        <option value="Sepeda18km">Bersepeda lamban (18 Km/h)</option>
        <option value="Sepeda21km">Bersepeda sedang (21 Km/h)</option>
        <option value="Sepeda24km">Bersepeda cepat (24 Km/h)</option>
        <option value="Sepeda28km">Bersepeda sangat cepat (28 Km/h)</option>
        <option value="Lari10km">Berlari santai (10 km/h)</option>
        <option value="Lari13km">Berlari sedang (13 Km/h)</option>
        <option value="Lari15km">Berlari cepat (15 Km/h)</option>
    </select></p>

<center><p>
<img src="http://blog.crossrope.com/wp-content/uploads/2016/06/Weight-Loss-Icon.png" width="50px" />
<input type="text" name="dvVelocity" id="dvVelocity" readonly="true" />
<label for="Kalori">kcal</label>
</p>

<p>
<img src="http://teambottle.nl/wp-content/uploads/2015/10/icon-water.png" width="50px" />
<input type="text" name="dvVelocity1" id="dvVelocity1" readonly="true" />
<label for="hidrasi">Litre</label>

<p>
<img src="http://icons.iconarchive.com/icons/graphicloads/flat-finance/256/timer-icon.png" width="50px" />
<input type="text" name="dvVelocity2" id="dvVelocity2" readonly="true" />
<label for="hidrasi">mins</label>
</p></center>

<p><label> Perbandingan dengan treadmill: </label>
 <input type="text" name="dvVelocity3" id="dvVelocity3" readonly="true" />
 <label for="Kalori">kcal lebih besar.</label>
</p>



    <input id="origin-input" class="controls" type="text"
        placeholder="Enter an origin location">
        
        <input id="destination-input" class="controls" type="text"
            placeholder="Enter a destination location">
            
            <div id="mode-selector" class="controls">
                <input type="radio" name="type" id="changemode-walking" checked="checked">
                    <label for="changemode-walking">Bicycling</label>
                    
                    <input type="radio" name="type" id="changemode-transit">
                        <label for="changemode-transit">Walking</label>
                        
                        <input type="radio" name="type" id="changemode-driving">
                            <label for="changemode-driving">Driving</label>
                            </div>
            <div id="right-panel"></div>
            <div id="map"></div>
            
            <script>
                
                function initMap() {
                    var origin_place_id = null;
                    var destination_place_id = null;
                    var travel_mode = 'WALKING';
                    // Create a map and centre it on Bandung
                    var bandung = {lat: -6.9175, lng: 107.6191};
                    var itb = {lat: -6.8915, lng: 107.6107};
                    var infoWindow = new google.maps.InfoWindow({map: map});
                    var map = new google.maps.Map(document.getElementById('map'), {
                                                  zoom: 13,
                                                  center: bandung
                                                  });
                                                  
                                                  var directionsService = new google.maps.DirectionsService;
                                                  var directionsDisplay = new google.maps.DirectionsRenderer;
                                                  directionsDisplay.setMap(map);
                                                  directionsDisplay.setPanel(document.getElementById('right-panel'));
                                                  
                                                  var origin_input = document.getElementById('origin-input');
                                                  var destination_input = document.getElementById('destination-input');
                                                  var modes = document.getElementById('mode-selector');
                                                  
                                                  
                                                  map.controls[google.maps.ControlPosition.TOP_LEFT].push(origin_input);
                                                  map.controls[google.maps.ControlPosition.TOP_LEFT].push(destination_input);
                                                  map.controls[google.maps.ControlPosition.TOP_LEFT].push(modes);
                                                  
                                                  var origin_autocomplete = new google.maps.places.Autocomplete(origin_input);
                                                  origin_autocomplete.bindTo('bounds', map);
                                                  var destination_autocomplete =
                                                  new google.maps.places.Autocomplete(destination_input);
                                                  destination_autocomplete.bindTo('bounds', map);
                                                  
                                                  
                                                  
                                                  
                                                  // Sets a listener on a radio button to change the filter type on Places
                                                  // Autocomplete.
                                                  function setupClickListener(id, mode) {
                                                      var radioButton = document.getElementById(id);
                                                      radioButton.addEventListener('click', function() {
                                                                                   travel_mode = mode;
                                                                                   });
                                                  }
                                                  setupClickListener('changemode-walking', 'WALKING');
                                                  setupClickListener('changemode-transit', 'TRANSIT');
                                                  setupClickListener('changemode-driving', 'DRIVING');
                                                  
                                                  function expandViewportToFitPlace(map, place) {
                                                      if (place.geometry.viewport) {
                                                          map.fitBounds(place.geometry.viewport);
                                                      } else {
                                                          map.setCenter(place.geometry.location);
                                                          map.setZoom(17);
                                                      }
                                                  }
                                                  
                                                  origin_autocomplete.addListener('place_changed', function() {
                                                                                  var place = origin_autocomplete.getPlace();
                                                                                  if (!place.geometry) {
                                                                                  window.alert("Autocomplete's returned place contains no geometry");
                                                                                  return;
                                                                                  }
                                                                                  expandViewportToFitPlace(map, place);
                                                                                  
                                                                                  // If the place has a geometry, store its place ID and route if we have
                                                                                  // the other place ID
                                                                                  origin_place_id = place.place_id;
                                                                                  
                                                                                  route(origin_place_id, destination_place_id, travel_mode,
                                                                                        directionsService, directionsDisplay);
                                                                                  
                                                                                  
                                                                                  
                                                                                  
                                                                                  });
                                                                                  
                                                                                  destination_autocomplete.addListener('place_changed', function() {
                                                                                                                       var place = destination_autocomplete.getPlace();
                                                                                                                       if (!place.geometry) {
                                                                                                                       window.alert("Autocomplete's returned place contains no geometry");
                                                                                                                       return;
                                                                                                                       }
                                                                                                                       expandViewportToFitPlace(map, place);
                                                                                                                       
                                                                                                                       // If the place has a geometry, store its place ID and route if we have
                                                                                                                       // the other place ID
                                                                                                                       destination_place_id = place.place_id;
                                                                                                                       
                                                                                                                       route(origin_place_id, destination_place_id, travel_mode,
                                                                                                                             directionsService, directionsDisplay);
                                                                                                                       
                                                                                                                       
                                                                                                                       
                                                                                                                       });
                                                                                                                       
                                                                                                                       
                                                                                                                       
                                                                                                                       function route(origin_place_id, destination_place_id, travel_mode,
                                                                                                                                      directionsService, directionsDisplay) {
                                                                                                                           if (!origin_place_id || !destination_place_id) {
                                                                                                                               return;
                                                                                                                           }
                                                                                                                           
                                                                                                                           var startValue =origin_input.value;
                                                                                                                           var endValue = destination_input.value;
                                                                                                                           var distanceInput = document.getElementById("distanceKm");
                                                                                                                           var distanceMl = document.getElementById("distanceMl");
                                                                                                                           var dvVelocity = document.getElementById("dvVelocity");
                                                                                                                           var dvVelocity1 = document.getElementById("dvVelocity1");
                                                                                                                           var dvVelocity2 = document.getElementById("dvVelocity2");
                                                                                                                           var dvVelocity3 = document.getElementById("dvVelocity3");
                                                                                                                           

                                                                                                                           
                                                                                                                           
                                                                                                                        
                                                                                                                           
                                                                                                                           directionsService.route({
                                                                                                                                                   origin: {'placeId': origin_place_id},
                                                                                                                                                   destination: {'placeId': destination_place_id},
                                                                                                                                                   travelMode: travel_mode
                                                                                                                                                   }, function(response, status) {
                                                                                                                                                   if (status === 'OK') {
                                                                                                                                                   directionsDisplay.setDirections(response);
                                                                                                                                                   
                                                                                                                                                   distanceInput.value = response.routes[0].legs[0].distance.value / 1000;
                                                                                                                                                   distanceMl.value =  response.routes[0].legs[0].distance.value * 0.000621371;
                                                                                                                                                   
                                                                                                                                                   
                                                                                          
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   if (document.getElementById("velocity").value == "Sepeda21km") {
                                                                                                                                                   
                                                                                                                                                   dvVelocity.value = distanceInput.value / 0.35 * 9.8;
                                                                                                                                                   
                                                                                                                                                   dvVelocity1.value = dvVelocity.value * 0.0017564;
                                                                                                                                                   dvVelocity2.value = distanceInput.value / 0.35;
                                                                                                                                                   dvVelocity3.value = dvVelocity.value - (distanceInput.value / 0.13 * 9.8);
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                            
                                                                                                                                                   } else if (document.getElementById("velocity").value == "Sepeda16km"){
                                                                                                                                                   
                                                                                                                                                   dvVelocity.value = distanceInput.value / 0.27 * 4.9;
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   dvVelocity1.value = dvVelocity.value * 0.0017564;
                                                                                                                                                   dvVelocity2.value = distanceInput.value / 0.27;
                                                                                                                                                   dvVelocity3.value = dvVelocity.value - (distanceInput.value / 0.13 * 9.8);
                                                                  
                                                                                                                                                   
                                                                                                                                                   } else if (document.getElementById("velocity").value == "Sepeda18km"){
                                                                                                                                                   
                                                                                                                                                   dvVelocity.value = distanceInput.value / 0.3 * 7.35;
                                                                                                                                                
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                            dvVelocity1.value = dvVelocity.value * 0.0017564;
                                                                                                                                                   dvVelocity2.value = distanceInput.value / 0.3;
                                                                                                                                                   dvVelocity3.value = dvVelocity.value - (distanceInput.value / 0.13 * 9.8);
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   } else if (document.getElementById("velocity").value == "Sepeda24km"){
                                                                                                                                                   
                                                                                                                                                   dvVelocity.value = distanceInput.value / 0.4 * 12.25;
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   dvVelocity1.value = dvVelocity.value * 0.0017564;
                                                                                                                                                   dvVelocity2.value = distanceInput.value / 0.4;
                                                                                                                                                   dvVelocity3.value = dvVelocity.value - (distanceInput.value / 0.13 * 9.8);
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   } else if (document.getElementById("velocity").value == "Sepeda28km"){
                                                                                                                                                   
                                                                                                                                                   dvVelocity.value = distanceInput.value / 0.47 * 14.7;
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   dvVelocity1.value = dvVelocity.value * 0.0017564;
                                                                                                                                                   dvVelocity2.value = distanceInput.value / 0.47;
                                                                                                                                                   dvVelocity3.value = dvVelocity.value - (distanceInput.value / 0.13 * 9.8);
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   } else if (document.getElementById("velocity").value == "Lari10km"){
                                                                                                                                                   
                                                                                                                                                   dvVelocity.value = distanceInput.value / 0.167 * 12.25;
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   dvVelocity1.value = dvVelocity.value * 0.0017564;
                                                                                                                                                   dvVelocity2.value = distanceInput.value / 0.167;
                                                                                                                                                   dvVelocity3.value = dvVelocity.value - (distanceInput.value / 0.13 * 9.8);
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   }else if (document.getElementById("velocity").value == "Lari13km"){
                                                                                                                                                   
                                                                                                                                                   dvVelocity.value = distanceInput.value / 0.217 * 16.53;
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   dvVelocity1.value = dvVelocity.value * 0.0017564;
                                                                                                                                                   dvVelocity2.value = distanceInput.value / 0.217;
                                                                                                                                                   dvVelocity3.value = dvVelocity.value - (distanceInput.value / 0.13 * 9.8);
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   }else if (document.getElementById("velocity").value == "Lari15km"){
                                                                                                                                                   
                                                                                                                                                   dvVelocity1.value = distanceInput.value / 0.25 * 19.6;
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   dvVelocity1.value = dvVelocity.value * 0.0017564;
                                                                                                                                                   dvVelocity2.value = distanceInput.value / 0.25;
                                                                                                                                                   dvVelocity3.value = dvVelocity.value - (distanceInput.value / 0.13 * 9.8);
                                                                                                                                                   
                                                                                                                                                   
                                                                                                                                                   }else {
                                                                                                                                                   window.alert('Directions request failed due to ' + status);
                                                                                                                                                   }
                                                                                                                                                   
                                                                                                                                                   ajax_send("GET","api.php","perintah=simpan&origin="+startValue+"&destination="+endValue+"&distance="+distanceInput.value+"&exercise="+document.getElementById("velocity").value+"&calories="+dvVelocity.value+"&hydration="+dvVelocity1.value+"&time="+dvVelocity2.value+"&compare="+dvVelocity3.value,function(){});
                                                                                                                                                
                                                                                                                                                   
                                                                                                                                                   }
                                                                                                                                                 
                                                                                                                                                   });
                                                                                                                       }                                                                                                     
                  }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqoU0wZzPW_PojpOOqkyYLtiVO8XelUII&libraries=places&callback=initMap"
                async defer></script>
</div>
<div class="hasil">

    <h1 style="align-text:center">Diary Calories User</h1>
  <form method="get">
  <label> Filter kalori: </label>
    <select name='kalori' id="hasil">
        <option value="0">Semua Kalori</option>
        <option value="50">Kalori diatas 50 kcal</option>
        <option value="100">Kalori diatas 100 kcal</option>
        <option value="250">Kalori diatas 250 kcal</option>
        <option value="500">Kalori diatas 500 kcal</option>
        <input type="submit" name ='submit' value='submit'>
  </form>
<?php include ('api.php');

function gambar_tabel($calories){
  echo "<table border='1' class='hasil'>";
  foreach ($calories as $row) {
      echo"<tr>";
      foreach($row as $key => $value){
        echo"<th>".$key."</th>";
      }
      echo"</tr>";
      break;
  }
  foreach ($calories as $row) {
      echo"<tr>";
      foreach($row as $key => $value){
        echo"<td>".$value."</td>";
      }
      echo"</tr>";
  }
  echo "</table>";
}

$kalori = isset($_GET['kalori'])?$_GET['kalori']:0;
$tabel = tampil($kalori);
gambar_tabel($tabel);
?>
</div>

<div class="dark">
    <center><p>This web service was made by <a href="https://www.facebook.com/nafisah.andina">Nafisah Andina - 18214025</a></p></center>
</div>


