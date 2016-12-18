 <script>
            function initMap() {
              var directionsService = new google.maps.DirectionsService;
              var directionsDisplay = new google.maps.DirectionsRenderer({
                draggable: true,
                map: map,
              });

              google.maps.event.addDomListener(window, 'load', function() {
                new google.maps.places.SearchBox(document.getElementById('start'));
                new google.maps.places.SearchBox(document.getElementById('end'));
              });

              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: {lat: -6.917464, lng: 107.619123},
                styles: [
                {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                {
                  featureType: 'administrative.locality',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#d59563'}]
                },
                {
                  featureType: 'poi',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#d59563'}]
                },
                {
                  featureType: 'poi.park',
                  elementType: 'geometry',
                  stylers: [{color: '#263c3f'}]
                },
                {
                  featureType: 'poi.park',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#6b9a76'}]
                },
                {
                  featureType: 'road',
                  elementType: 'geometry',
                  stylers: [{color: '#38414e'}]
                },
                {
                  featureType: 'road',
                  elementType: 'geometry.stroke',
                  stylers: [{color: '#212a37'}]
                },
                {
                  featureType: 'road',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#9ca5b3'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'geometry',
                  stylers: [{color: '#746855'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'geometry.stroke',
                  stylers: [{color: '#1f2835'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#f3d19c'}]
                },
                {
                  featureType: 'transit',
                  elementType: 'geometry',
                  stylers: [{color: '#2f3948'}]
                },
                {
                  featureType: 'transit.station',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#d59563'}]
                },
                {
                  featureType: 'water',
                  elementType: 'geometry',
                  stylers: [{color: '#17263c'}]
                },
                {
                  featureType: 'water',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#515c6d'}]
                },
                {
                  featureType: 'water',
                  elementType: 'labels.text.stroke',
                  stylers: [{color: '#17263c'}]
                }
                ]
              });
directionsDisplay.setMap(map);


var control = document.getElementById('floating-panel');
control.style.display = 'block';
map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);

var onChangeHandler = function() {
  calculateAndDisplayRoute(directionsService, directionsDisplay);
};
document.getElementById('start').addEventListener('change', onChangeHandler);
document.getElementById('end').addEventListener('change', onChangeHandler);
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  var start = document.getElementById('start').value;
  var end = document.getElementById('end').value;
  directionsService.route({
    origin: start,
    destination: end,
    travelMode: 'DRIVING'
  }, function(response, status) {
    if (status === 'OK') {
      directionsDisplay.setDirections(response);
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });

  directionsService.route({
    origin: document.getElementById('start').value,
    destination: document.getElementById('end').value,
    optimizeWaypoints: true,
    travelMode: 'DRIVING'
  }, function(response, status) {
    if (status === 'OK') {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];      
      var summaryPanel1 = document.getElementById('directions-panel1');
      var summaryPanel2 = document.getElementById('directions-panel2');
      var summaryPanel3 = document.getElementById('directions-panel3');
      var summaryPanel4 = document.getElementById('directions-panel4');
      summaryPanel1.innerHTML = '';
      summaryPanel2.innerHTML = '';
      // For each route, display summary information.
      for (var i = 0; i < route.legs.length; i++) {
        var routeSegment = i + 1;
        var konsumsi  = document.getElementById("bbm").value; //nilai konsumsi kendaraan
        var hargabbm = document.getElementById("harga").value; //harga bahan bakar yang dipakai
        var capacity = 50; //kapasitas fuel tank
        var dir = route.legs[i].distance.text; //rubah agar bisa diparsing
        dir = dir.split(',').join(''); //hapus koma agar pas diparsing tidak bulat ke kecil
        var ongkos = parseFloat(dir)*(1/Number(konsumsi))*hargabbm; //rumus ongkos bbm dengan km/l
        var ongkos2 = parseFloat(dir)*(1/konsumsi)*hargabbm*2;
        var ongkos3 = parseFloat(dir)*(1/konsumsi)*hargabbm*14;
        var jmlisi= (ongkos/(hargabbm*capacity)); //jumlah pengisian berdasarkan konsumsi dan kapasitas
        var jmlisi2= (ongkos2/(hargabbm*capacity));
        var jmlisi3= (ongkos3/(hargabbm*capacity));;
        summaryPanel1.innerHTML += "<strong>Jarak: </strong>" + route.legs[i].distance.text;
        summaryPanel2.innerHTML += "<strong>Waktu Tempuh: </strong>" + route.legs[i].duration.text;
        summaryPanel3.innerHTML +=  "Rp." + parseInt(ongkos) + " (Sekali Jalan) | Rp." + parseInt(ongkos2) + " (Pulang Pergi) | Rp." + parseInt(ongkos3) + " (Mingguan)"; //menghapus nilai km agar bisa dikalkulasi
        summaryPanel4.innerHTML +=  parseInt(jmlisi) + " kali (Sekali Jalan) | " + parseInt(jmlisi2) + " kali (Pulang Pergi) | " + parseInt(jmlisi3) + " kali (Mingguan)"; //merubah ke angka bulat
      }
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });

}
</script>
<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUoaKKLrTaer0E2iF5O9Owoc4qotqfdPo&amp;callback=initMap&libraries=places">
</script>