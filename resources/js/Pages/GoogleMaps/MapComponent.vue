<template>
    <div id="mapComponent">
      <div id="map"></div>
  
      <form id="routeForm"></form>
    </div>
  </template>
    
  <script setup>
  import { onMounted } from "vue";
  
  function initMap() {
    var ocosingo = { lat: 16.9064, lng: -92.0883 };
  

    var mapOptions = {
      center: ocosingo,
      zoom: 12, 
    };
  
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
  
    var staticRoutes = [
      { lat: 16.903084, lng: -92.093510 },
      { lat: 16.911298, lng: -92.096734 },
      { lat: 16.909725, lng: -92.080393 },
      { lat: 16.912029, lng: -92.088289 },
      { lat: 16.919331, lng: -92.092610 }
    ];
  
    staticRoutes.forEach((location, index) => {
      var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: `Ruta ${index + 1}`,
      });
    });
  
    var form = document.getElementById("routeForm");
    form.addEventListener("submit", function (event) {
      event.preventDefault();
  

      var route = document.getElementById("route").value;
  
      if (route.trim() !== "") {
 
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ address: route }, function (results, status) {
          if (status === "OK") {
            var location = results[0].geometry.location;
            var marker = new google.maps.Marker({
              position: location,
              map: map,
              title: route,
            });
            document.getElementById("route").value = "";
          } else {
            alert("No se pudo encontrar la ubicación: " + status);
          }
        });
      } else {
        alert("Por favor ingresa una ruta válida.");
      }
    });
  }
  
  onMounted(() => {
    if (typeof google !== "undefined") {
      initMap();
    } else {
      console.error("Error: Google Maps API no está cargada.");
    }
  });
  </script>
    
  <style scoped>
  #map {
    height: 400px;
    width: 100%;
  }
  </style>
  