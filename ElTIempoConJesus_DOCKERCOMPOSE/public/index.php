<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Weather App - Consulta Clima</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoToMB8kz6qCc3Yw1qHCPVQnYZdZ6r3hZp1RhmBfFA8y6H8" crossorigin="anonymous">
  <style>
    body {
      background: url('https://source.unsplash.com/1920x1080/?weather,sky') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .overlay {
      position: absolute;
      top: 0; bottom: 0; left: 0; right: 0;
      background: rgba(0, 0, 0, 0.6);
    }
    .card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 1.5rem;
      padding: 4rem;
      box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
      position: relative;
      z-index: 2;
      width: 100%;
      max-width: 600px;
      text-align: center;
    }
    h1 {
      color: #222;
      font-weight: 800;
      font-size: 2.5rem;
    }
    .form-label {
      color: #444;
      font-size: 1.5rem;
      font-weight: 600;
    }
    .form-control {
      font-size: 1.5rem;
      padding: 1rem;
      text-align: center;
      width: 100%;
    }
    .text-muted {
      color: #666 !important;
      font-size: 1.5rem;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
      transition: 0.3s;
      margin-top: 1rem;
      border-radius: 2rem;
      font-size: 1.8rem;
      padding: 1rem 2rem;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="overlay"></div>
  <div class="card">
    <div class="card-body">
      <h1 class="mb-4">El Tiempo con Jesús</h1>
      <form action="process.php" method="post">
        <div class="mb-4">
          <label for="city" class="form-label">Ingresa el nombre de la ciudad:</label>
          <input type="text" name="city" id="city" class="form-control" placeholder="Ej. Madrid" required>
        </div>
        <div>
          <button type="submit" class="btn btn-primary">Buscar clima</button>
        </div>
      </form>
      <p class="mt-4 text-muted">Consulta pronósticos en tiempo real y semanales.</p>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3qM7NEfMvZkarsztt+0vMGKp0b4Q" crossorigin="anonymous"></script>
</body>
</html>