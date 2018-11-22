import jQuery from 'jquery';
import popper from 'popper.js';
import bootstrap from 'bootstrap';

(function() {

    const INTERVAL = 2000;
    var zooming = true;
    var infoWindow = null;

    jQuery(document).ready(function () {
        setTimeout(getMarkers, INTERVAL);
        setInterval(getMarkers, INTERVAL * 5);
    });

    var markers = [];

    function getMarkers() {
        infoWindow = new google.maps.InfoWindow({
            content: "Loading..."
        });
        if (markers.length > 0) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }
        // map.data.loadGeoJson('ajax-latest-navigators.php');
        jQuery.get('/ajax-latest-navigators.php', {},
            function (response) {
                if (response.success) {
                    var res = response.data;
                    var bounds = new google.maps.LatLngBounds();
                    for (var i = 0, len = res.length; i < len; i++) {
                        var myLatLng = new google.maps.LatLng(res[i].latitude, res[i].longitude);
                        var iconUrl = res[i].active == 1 ? "green-dot.png" : "red-dot.png";
                        var pinImage = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/icons/" + iconUrl,
                            new google.maps.Size(21, 34),
                            new google.maps.Point(0, 0),
                            new google.maps.Point(10, 34));
                        var title = (res[i].alias ? res[i].alias : res[i].nId);
                        var contentString = "<div class='text-center'>Alias: " + title + "</div>" +
                            "<div>Last Updated: " + res[i].time + "</div>";
                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            title: title,
                            icon: pinImage,
                            html: contentString,
                            navData: res[i],
                            map: map
                        });
                        google.maps.event.addListener(marker, "click", function () {
                            populateForm(this);
                        });
                        if (zooming) {
                            bounds.extend(myLatLng);
                            map.fitBounds(bounds);
                        }
                        markers[i] = marker;
                    }
                }
                zooming = false;
            }, "json");
    }

    function populateForm(obj) {
        jQuery('#renameId').val(obj.navData.id);
        jQuery('#renameAlias').val(obj.navData.alias ? obj.navData.alias : obj.navData.nId);
    }

}());

window.saveAlias = function() {
    if (jQuery('#renameId').val() == "") {
        return;
    }
    jQuery.ajax({
        url: "/",
        method: "POST",
        data: jQuery('#renameForm').serialize(),
        success: function (resp) {
            if (resp.success) {
                jQuery('#renameId').val("");
                jQuery('#renameAlias').val("");
            } else {
                alert("Error!");
            }
        }
    });
};

