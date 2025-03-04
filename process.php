<?php
session_start();
require_once "Geolocalizacion.php";

$apiKey = '0f02977357acfbb51e17e450cbb9107a'; 

if (!isset($_POST['city']) || empty(trim($_POST['city']))) {
    header("Location: index.php");
    exit;
}

$ciudad = trim($_POST['city']);
$geo = new Geolocalizacion($ciudad, $apiKey);
if (!$geo->obtenerCoordenadas()) {
    $errorMensaje = "No se han podido obtener las coordenadas para '$ciudad'.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo isset($errorMensaje) ? "Error - Weather App" : "Ciudad Encontrada - " . htmlspecialchars($geo->nombre); ?></title>
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
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
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
    .btn {
      font-size: 1.8rem;
      padding: 1rem 2rem;
      border-radius: 2rem;
      margin-top: 1rem;
    }
  </style>
</head>
<body>
  <div class="overlay"></div>
  <div class="card">
    <div class="card-body">
      <?php if (isset($errorMensaje)): ?>
        <h1 class="mb-4">Error</h1>
        <p class="mb-4"><?php echo htmlspecialchars($errorMensaje); ?></p>
        <form action="index.php" method="get">
          <button type="submit" class="btn btn-secondary">Volver</button>
        </form>
      <?php else: ?>
        <h1 class="mb-4"><?php echo htmlspecialchars($geo->nombre); ?> Encontrada</h1>
        <p class="mb-4">
          <strong>Latitud:</strong> <?php echo htmlspecialchars($geo->latitud); ?> &nbsp;&nbsp;
          <strong>Longitud:</strong> <?php echo htmlspecialchars($geo->longitud); ?>
        </p>
        <div class="d-grid gap-2">
          <form action="tiempo_actual.php" method="get">
            <button type="submit" class="btn btn-success">Tiempo Actual</button>
          </form>
          <form action="pronostico_horas.php" method="get">
            <button type="submit" class="btn btn-info text-white">Pronóstico por Horas</button>
          </form>
          <form action="pronostico_dias.php" method="get">
            <button type="submit" class="btn btn-primary">Pronóstico Diario</button>
          </form>
          <form action="index.php" method="get">
            <button type="submit" class="btn btn-secondary">Nueva Búsqueda</button>
          </form>
        </div>
        <?php
        $_SESSION['ciudad'] = $geo->nombre;
        $_SESSION['latitud'] = $geo->latitud;
        $_SESSION['longitud'] = $geo->longitud;
        ?>
      <?php endif; ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3qM7NEfMvZkarsztt+0vMGKp0b4Q" crossorigin="anonymous"></script>
</body>
</html>