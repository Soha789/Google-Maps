<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Logging Out</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
  display: flex; justify-content: center; align-items: center;
  height: 100vh; font-family: 'Poppins', sans-serif; background: #f0f4f8;
}
.box {
  background: white; padding: 30px 50px; text-align: center;
  border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.2);
}
h2 { color: #0066cc; }
</style>
</head>
<body>
<div class="box">
  <h2>Logging out...</h2>
  <p>Please wait, redirecting to map...</p>
</div>

<script>
sessionStorage.clear();
setTimeout(()=>{ window.location.href='map.php'; },1500);
</script>
</body>
</html>
