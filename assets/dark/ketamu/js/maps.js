
function initMap() {
  const myLatlng = {
    lat: -5.422159780198365,
    lng: 105.25816842472247
  };
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 8,
    center: myLatlng,
  });
  // Create the initial InfoWindow.
  let infoWindow = new google.maps.InfoWindow({
    content: "Klik untuk mengisi latitude dan longitude",
    position: myLatlng,
  });

  infoWindow.open(map);
  // Configure the click listener.
  map.addListener("click", (mapsMouseEvent) => {
    // Close the current InfoWindow.
    $('#latitude').val(mapsMouseEvent.latLng.lat())
    $('#longitude').val(mapsMouseEvent.latLng.lng())
    infoWindow.close();
    // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: mapsMouseEvent.latLng,
    });
    infoWindow.setContent(
      JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
    );
    infoWindow.open(map);
  });
}
