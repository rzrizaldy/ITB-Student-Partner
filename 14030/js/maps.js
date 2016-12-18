var notMarker24hr = [];
var marker24hr = [];

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(-6.890560, 107.609673),
        zoom: 18,
        mapTypeControl: false
    });
    var infoWindow = new google.maps.InfoWindow({ map: map });

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }

    // Add controls to the map, allowing users to hide/show features.
    var styleControl = document.getElementById('style-selector-control');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(styleControl);

    // Apply new JSON when the user chooses to hide/show features.
    document.getElementById('hide-poi').addEventListener('click', function() {
        map.setOptions({ styles: styles['hide'] });
    });
    document.getElementById('show-poi').addEventListener('click', function() {
        map.setOptions({ styles: styles['default'] });
    });

    // USE MYSQL DATA
    downloadUrl("database2xml.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function(markerElem) {
            var name = markerElem.getAttribute('name');
            var address = markerElem.getAttribute('address');
            var point = new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng')));

            var is24hr = markerElem.getAttribute('is24hr');

            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = name
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));

            var text = document.createElement('text');
            text.textContent = address
            infowincontent.appendChild(text);

            var marker = new google.maps.Marker({
                map: map,
                position: point,
            });

            if (is24hr == 0) {
                notMarker24hr.push(marker);
            } else {
                marker24hr.push(marker);
            }

            marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
            });
        });
    });

    map.addListener("rightclick", function(event) {
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();
        var formlat = lat;
        var formlng = lng;
        document.forms[0].ToiletLat.value = formlat;
        document.forms[0].ToiletLng.value = formlng;
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

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}

var styles = {
    default: null,
    hide: [{
        featureType: 'poi',
        stylers: [{ visibility: 'off' }]
    }, {
        featureType: 'transit',
        elementType: 'labels.icon',
        stylers: [{ visibility: 'off' }]
    }]
};

function showAllToilet() {
    for (var i = 0; i < notMarker24hr.length; i++) {
        notMarker24hr[i].setVisible(true);
    }
    for (var i = 0; i < marker24hr.length; i++) {
        marker24hr[i].setVisible(true);
    }
}

function show24hrToilet() {
    for (var i = 0; i < notMarker24hr.length; i++) {
        notMarker24hr[i].setVisible(false);
    }
    for (var i = 0; i < marker24hr.length; i++) {
        marker24hr[i].setVisible(true);
    }
}

function shownot24hrToilet() {
    for (var i = 0; i < notMarker24hr.length; i++) {
        notMarker24hr[i].setVisible(true);
    }
    for (var i = 0; i < marker24hr.length; i++) {
        marker24hr[i].setVisible(false);
    }
}
