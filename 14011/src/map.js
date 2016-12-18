var pos;
var customLabel = {
  murah: {
    label: 'M'
  },
  populer: {
    label: 'P'
  }
};

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -6.891610, lng: 107.610694},
    zoom: 15
  });

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      var posmark = new google.maps.Marker({
      	position: pos,
      	map: map,
      	animation: google.maps.Animation.BOUNCE,
      	title: 'Selamat datang.'
      });map.setCenter(pos);
    });
  } else {
    document.getElementById('google_canvas').innerHTML = 'No Geolocation Support.';
  };

  var infoWindow = new InfoBubble({
    shadowStyle: 1,
    borderWidth: 2,
    borderColor: 'black',
    minWidth: 500,
    maxWidth: 500,
    minHeight: 200,
    arrowPosition: 5,
    arrowStyle: 2,
    closeSrc: './img/close.png',
  });
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer({
    polylineOptions: {
      strokeColor: 'black'
    }
  });
  directionsDisplay.setMap(map);
  directionsDisplay.setOptions({suppressMarkers:true});

  downloadUrl('koneksi.php', function(data) {
      var xml = data.responseXML;
      var markers = xml.documentElement.getElementsByTagName('marker');
      Array.prototype.forEach.call(markers, function(markerElem) {
        var nama = markerElem.getAttribute('nama');
        var deskripsi = markerElem.getAttribute('deskripsi');
        var jenis = markerElem.getAttribute('jenis');
        var lat = markerElem.getAttribute('lat');
        var lng = markerElem.getAttribute('lng')
        var point = new google.maps.LatLng(
          parseFloat(lat),
          parseFloat(lng));
        var image = markerElem.getAttribute('img');

        var infowincontent = document.createElement('table');
        var row1 = document.createElement('tr');
        var header = document.createElement('th');
        var strong = document.createElement('h1');
        strong.textContent = nama
        infowincontent.appendChild(row1.appendChild(header.appendChild(strong)));
        var row2 = document.createElement('tr');
        var img = document.createElement('td');
        var gambar = document.createElement('img');
        gambar.setAttribute('src', image);
        infowincontent.appendChild(row2.appendChild(img.appendChild(gambar)));
        var row3 = document.createElement('tr');
        var data1 = document.createElement('td');
        var text1 = document.createElement('p');
        text1.textContent = deskripsi
        infowincontent.appendChild(row3.appendChild(data1.appendChild(text1)));
        var row4 = document.createElement('tr');
        var data2 = document.createElement('td');
        var text2 = document.createElement('text');
        text2.textContent = 'Lewat mana ya?'
        infowincontent.appendChild(row4.appendChild(data2.appendChild(text2)));
        infowincontent.appendChild(document.createElement('br'));
        var row5 = document.createElement('tr');
        var data3 = document.createElement('td');
        var button1 = document.createElement('button');
        button1.setAttribute('class', 'kendaraan');
        button1.innerHTML = 'Kendaraan'
        button1.onclick = function(){
          directionsService.route({
	          origin: pos,
	          destination: point,
	          travelMode: 'DRIVING'
	        }, function(response, status) {
	          if (status === 'OK') {
	            directionsDisplay.setDirections(response);
	          } else {
	            window.alert('Directions request failed due to ' + status);
	          }
            infoWindow.close();
	        });
	        return false;
          };
        infowincontent.appendChild(row5.appendChild(data3.appendChild(button1)));
        var row6 = document.createElement('tr');
        var data4 = document.createElement('td');
        var button2 = document.createElement('button');
        button2.setAttribute('class', 'jalan');
        button2.innerHTML = 'Jalan Kaki'
        button2.onclick = function(){
          directionsService.route({
            origin: pos,
            destination: point,
            travelMode: 'WALKING'
          }, function(response, status) {
            if (status === 'OK') {
              directionsDisplay.setDirections(response);
            } else {
              window.alert('Directions request failed due to ' + status);
            }
            infoWindow.close();
          });
          return false;
          };
        infowincontent.appendChild(row6.appendChild(data4.appendChild(button2)));

        var icon = customLabel[jenis] || {};
        var image = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter_withshadow&chld='+icon.label+'|000000|FFFFFF';
        var marker = new google.maps.Marker({
          map: map,
          position: point,
          animation: google.maps.Animation.DROP,
          icon: image
        });
        marker.addListener('click', function() {
          infoWindow.setContent(infowincontent);
          infoWindow.open(map, marker);
          map.panTo(point);
        });
      });
    });
}

function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      request.onreadystatechange = doNothing;
      callback(request, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
}

function doNothing() {}