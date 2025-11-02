<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Favourites</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
  margin: 0; font-family: 'Poppins', sans-serif; background: #f2f4f8;
}
header {
  background: #0066cc; color: white; padding: 12px 25px;
  display: flex; justify-content: space-between; align-items: center;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}
header h1 { font-size: 20px; margin: 0; }
nav a {
  color: white; text-decoration: none; margin-left: 20px; font-weight: 500;
}
nav a:hover { color: #ffcc00; }
.container {
  width: 80%; margin: 40px auto; background: white; border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.2); padding: 20px;
}
.container h2 { color: #0066cc; text-align: center; }
.list {
  display: flex; flex-direction: column; align-items: center; gap: 10px;
}
.card {
  background: #eaf3ff; width: 90%; padding: 12px; border-radius: 6px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2); font-size: 16px; color: #333;
  display: flex; justify-content: space-between; align-items: center;
}
button {
  background: #0066cc; border: none; color: white; padding: 8px 14px;
  border-radius: 5px; cursor: pointer; transition: 0.3s;
}
button:hover { background: #004c99; }
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

<div class="container">
  <h2>Your Favourite Places</h2>
  <div class="list" id="favList"></div>
  <div style="text-align:center; margin-top:20px;">
    <button onclick="goToMap()">Back to Map</button>
  </div>
</div>

<script>
function goToMap(){ window.location.href='map.php'; }
function goToFav(){ window.location.href='favourites.php'; }
function logout(){ window.location.href='logout.php'; }

// load favourites
window.onload = () => {
  let favs = JSON.parse(sessionStorage.getItem("favourites") || "[]");
  let container = document.getElementById("favList");
  if(favs.length === 0){
    container.innerHTML = "<p style='color:#555;'>No favourites added yet.</p>";
    return;
  }
  favs.forEach(name => {
    let div = document.createElement("div");
    div.className = "card";
    div.innerHTML = `<span>${name}</span>`;
    container.appendChild(div);
  });
}
</script>
</body>
</html>
