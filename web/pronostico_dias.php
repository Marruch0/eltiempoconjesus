<?php
session_start();
require_once "Clima.php";

$apiKey = '0f02977357acfbb51e17e450cbb9107a'; 
if (!isset($_SESSION['latitud']) || !isset($_SESSION['longitud'])) {
    header("Location: index.php");
    exit;
}

$ciudad = $_SESSION['ciudad'];
$latitud = $_SESSION['latitud'];
$longitud = $_SESSION['longitud'];

$clima = new Clima($latitud, $longitud, $apiKey);
$pronosticoDiario = $clima->obtenerPronosticoDiario();

if (!$pronosticoDiario) {
    die("Error al obtener el pronóstico diario.");
}

$fechas = [];
$tempMax = [];
$tempMin = [];

foreach ($pronosticoDiario as $dia) {
    $fechas[] = $dia['fecha'];
    $tempMax[] = $dia['max'];
    $tempMin[] = $dia['min'];
}

$fechas_json   = json_encode($fechas);
$tempMax_json  = json_encode($tempMax);
$tempMin_json  = json_encode($tempMin);
?>
<!DOCTYPE html>Horas
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pronóstico Diario en <?php echo htmlspecialchars($ciudad); ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoToMB8kz6qCc3Yw1qHCPVQnYZdZ6r3hZp1RhmBfFA8y6H8" crossorigin="anonymous">
  <script src="https://code.highcharts.com/highcharts.js"></script>
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
      box-shadow: 0px 6px 15px rgba(0,0,0,0.3);
      position: relative;
      z-index: 2;
      width: 100%;
      max-width: 800px;
      text-align: center;
    }
    h1 {
      color: #222;
      font-weight: 800;
      font-size: 2.5rem;
    }
    #grafico-dias {
      height: 500px;
      margin: 2rem auto;
    }
    .btn {
      font-size: 1.8rem;
      padding: 1rem 2rem;
      border-radius: 2rem;
      margin-top: 1rem;
    }
  </style>
  <body>
  <div class="overlay"></div>
  <div class="card">
    <div class="card-body">
      <h1>Pronóstico por Dias en <?php echo htmlspecialchars($ciudad); ?></h1>
      <div id="grafico-horas"></div>
      <div class="d-grid gap-2">
        <form action="tiempo_actual.php" method="get">
          <button type="submit" class="btn btn-success">Tiempo Actual</button>
        </form>
        <form action="pronostico_horas.php" method="get">
          <button type="submit" class="btn btn-primary">Pronóstico Horas</button>
        </form>
        <form action="index.php" method="get">
          <button type="submit" class="btn btn-secondary">Nueva Búsqueda</button>
        </form>
      </div>
    </div>
  </div>
  <script>
Highcharts.chart('grafico-horas', {
  chart: { type: 'line' },
  title: { text: 'Evolución Diaria de Temperatura' },
  xAxis: {
    categories: <?php echo $fechas_json; ?>,
    title: { text: 'Fecha' }
  },
  yAxis: { title: { text: 'Temperatura (°C)' } },
  tooltip: { shared: true, valueSuffix: '°C' },
  series: [{
    name: 'Máxima',
    data: <?php echo $tempMax_json; ?>,
    marker: { symbol: 'circle' }
  }, {
    name: 'Mínima',
    data: <?php echo $tempMin_json; ?>,
    marker: { symbol: 'diamond' }
  }],
  credits: { enabled: false }
});
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3qM7NEfMvZkarsztt+0vMGKp0b4Q" crossorigin="anonymous"></script>
</body>
</html>