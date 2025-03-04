<?php
class Clima {
  private $latitud;
  private $longitud;
  private $apiKey;

  public function __construct($latitud, $longitud, $apiKey) {
    $this->latitud = $latitud;
    $this->longitud = $longitud;
    $this->apiKey = $apiKey;
  }

  public function obtenerClimaActual() {
    $url = "https://api.openweathermap.org/data/2.5/weather?lat={$this->latitud}&lon={$this->longitud}&units=metric&appid={$this->apiKey}";
    $respuesta = @file_get_contents($url);
    return json_decode($respuesta, true);
  }

  public function obtenerPronosticoHoras() {
    $url = "https://api.openweathermap.org/data/2.5/forecast?lat={$this->latitud}&lon={$this->longitud}&units=metric&appid={$this->apiKey}";
    $respuesta = @file_get_contents($url);
    return json_decode($respuesta, true);
  }

  public function obtenerPronosticoDiario() {
    $datosPronostico = $this->obtenerPronosticoHoras();
    $agrupado = [];
    if(isset($datosPronostico['list'])) {
      foreach($datosPronostico['list'] as $registro) {
        $fecha = date("Y-m-d", $registro['dt']);
        if (!isset($agrupado[$fecha])) {
          $agrupado[$fecha] = [];
        }
        $agrupado[$fecha][] = $registro;
      }
    }
    $dias = array_slice($agrupado, 0, 5, true);
    $resultado = [];
    foreach($dias as $fecha => $lista) {
      $max = -INF;
      $min = INF;
      foreach($lista as $registro) {
        if ($registro['main']['temp_max'] > $max) {
          $max = $registro['main']['temp_max'];
        }
        if ($registro['main']['temp_min'] < $min) {
          $min = $registro['main']['temp_min'];
        }
      }
      $resultado[] = [
        'fecha' => date("d/m", strtotime($fecha)),
        'max' => round($max),
        'min' => round($min)
      ];
    }
    return $resultado;
  }
}
?>