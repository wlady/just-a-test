import jQuery from 'jquery';
import popper from 'popper.js';
import bootstrap from 'bootstrap';

const INTERVAL = 2000;

jQuery( document ).ready(function() {
    setTimeout(getMarkers, INTERVAL);
});

function getMarkers() {
    jQuery.get('/ajax-latest-navigators.php', {},
        function (req, resp) {
            for (var i = 0, len = res.length; i < len; i++) {

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(res[i].position.lat, res[i].position.long),
                    title: res[i].name,
                    map: map
                });
            }
        }, "json");
}

