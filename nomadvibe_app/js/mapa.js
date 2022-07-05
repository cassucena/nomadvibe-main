// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
let map, infoWindow;

//carregamento do mapa

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 38.7071, lng: -9.13549 },
    zoom: 13,
    mapId: '4c21ddd3d4afba87',
    mapTypeControl: false,
    fullScreenControl: false,
    streetViewControl: false
  });

//marcadores personalizados

  const marker = new google.maps.Marker({
    position: { lat: 38.697518862794304, lng: -9.203908851537374 },
    map,
    title: "Pao Pao, Queijo Queijo",
    icon: {
      url: "./img/Star.svg",
      scaledSize: new google.maps.Size(38,31)
    },
    Animation: google.maps.Animation.DROP
  });

//função de geolocalização

 infoWindow = new google.maps.InfoWindow();

  const locationButton = document.createElement("button");
  locationButton.textContent = "Qual a minha localizacao";  
  locationButton.classList.add("custom-map-control-button");
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

  locationButton.addEventListener("click", () => 
  {
    if (navigator.geolocation) 
    {

      navigator.geolocation.getCurrentPosition(
        (position) => 
        {

          const pos = {

            lat: position.coords.latitude,
            lng: position.coords.longitude,

          };

          infoWindow.setPosition(pos);
          infoWindow.setContent("Voce esta aqui.");
          infoWindow.open(map);
          map.setCenter(pos);

        },

        () => 
        {

          handleLocationError(true, infoWindow, map.getCenter());

        }

      );

    } 
    else 
    {
      
      handleLocationError(false, infoWindow, map.getCenter());

    }

  });

}

function handleLocationError(browserHasGeolocation, infoWindow, pos) 
{

  infoWindow.setPosition(pos);

  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );

  infoWindow.open(map);

}