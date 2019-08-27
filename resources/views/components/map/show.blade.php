
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 300px;
      }
      /* Optional: Makes the sample page fill the window. */

      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }
      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
    </style>
    <div class="pac-card" id="pac-card">
      <div>
        <div id="strict-bounds-selector" class="pac-controls">
       </div>
      </div>
      <div id="pac-container">

    </div>
    </div>
    <div id="map"></div>
    <div id="infowindow-content">
      <img src="" width="16" height="16" id="place-icon">
      <span id="place-name"  class="title"></span><br>
      <span id="place-address"></span>
    </div>



<script>

function initMap() {
  console.log({!! json_encode($post->place_location) !!});
  var restaurant = {!! json_encode($post->place_location) !!}.split(',');
  var lat = parseFloat(restaurant[0].substr(1));
  var lng = parseFloat(restaurant[1].slice(0,-1));
  
  var myLatLng = {lat: lat, lng: lng};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'Hello World!'
  });
}
</script>

{{-- <script>
     alert("hey");
      function initMap() {
        alert("hallo");
        var position = {!! $post->place_location !!}.split(',');
        var lat = position[0].substr(1);
        var lng = position[1].slice(0,-1);
        alert(position);
        var myLatLng = {lat: lat, lng: lng};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng
          map: map,
          title: 'Hello World!'
        }); 
      }
    </script> --}}

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3DK63t2-dRXz_AaXsS5kyjMN7V0MATGc&libraries=places&callback=initMap"
        async defer></script>