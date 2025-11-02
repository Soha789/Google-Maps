<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Map Explorer</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Leaflet CDN -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<style>
body {
  margin: 0; font-family: 'Poppins', sans-serif; background: #f2f4f8;
}
header {
  background: #0066cc; color: white; padding: 12px 25px;
  display: flex; justify-content: space-between; align-items: center;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}
header h1 { font-size: 20px; margin: 0; letter-spacing: 1px; }
nav a {
  color: white; text-decoration: none; margin-left: 20px; font-weight: 500;
  transition: 0.3s;
}
nav a:hover { color: #ffcc00; }
#search-bar {
  display: flex; justify-content: center; margin: 15px auto; max-width: 500px;
}
#search-bar input {
  width: 80%; padding: 10px 12px; border-radius: 5px 0 0 5px;
  border: 1px solid #ccc; font-size: 15px;
}
#search-bar button {
  width: 20%; border: none; background: #0066cc; color: white;
  font-size: 15px; border-radius: 0 5px 5px 0; cursor: pointer;
  transition: 0.3s;
}
#search-bar button:hover { background: #004c99; }
#map {
  height: calc(100vh - 130px); width: 90%; margin: 0 auto; border-radius: 10px;
  box-shadow: 0 0 8px rgba(0,0,0,0.3);
}
#result {
  text-align: center; margin-top: 10px; font-size: 16px; color: #333;
}
.heart {
  color: #aaa; cursor: pointer; margin-left: 10px; font-size: 20px;
  transition: color 0.3s;
}
.heart:hover, .heart.active { color: red; }
</style>
</head>
<body>
<header>
  <h1>Map Explorer</h1>
  <nav>
    <a href="#" onclick="goToMap()">Map</a>
    <a href="#" onclick="goToFav()">Favourites ❤️</a>
    <a href="#" onclick="logout()">Logout</a>
  </nav>
</header>

<div id="search-bar">
  <input type="text" id="location" placeholder="Search for a place...">
  <button onclick="searchLocation()">Search</button>
</div>
<div id="result"></div>
<div id="map"></div>

<script>
// navigation JS
function goToMap(){ window.location.href='map.php'; }
function goToFav(){ window.location.href='favourites.php'; }
function logout(){ window.location.href='logout.php'; }

// Leaflet map
var map = L.map('map').setView([24.7136, 46.6753], 6); // Default Riyadh
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

var marker;

// Search location
function searchLocation() {
  var query = document.getElementById('location').value.trim();
  if(query === "") return alert("Please enter a location name!");
  fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`)
  .then(response => response.json())
  .then(data => {
    if(data.length === 0){ 
      document.getElementById('result').innerHTML = "No results found.";
      return;
    }
    var place = data[0];
    var lat = place.lat;
    var lon = place.lon;
    var name = place.display_name;
    map.setView([lat, lon], 13);
    if(marker) map.removeLayer(marker);
    marker = L.marker([lat, lon]).addTo(map);
    document.getElementById('result').innerHTML =
      `${name} <span class="heart" onclick="addFav('${name.replace(/'/g, "\\'")}')">❤️</span>`;
  })
  .catch(err => console.error(err));
}

// Add to favourites
function addFav(name){
  let favs = JSON.parse(sessionStorage.getItem("favourites") || "[]");
  if(!favs.includes(name)){
    favs.push(name);
    sessionStorage.setItem("favourites", JSON.stringify(favs));
    alert("Added to favourites!");
  } else {
    alert("Already in favourites!");
  }
}
</script>
</body>
</html>
