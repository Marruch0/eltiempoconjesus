<?php
class Geolocalizacion {
  private $ciudad;
  private $apiKey;

  public $nombre;
  public $latitud;
  public $longitud;

  public function __construct($ciudad, $apiKey) {
    $this->ciudad = $ciudad;
    $this->apiKey = $apiKey;
  }

  public function obtenerCoordenadas() {
    $url = "http://api.openweathermap.org/geo/1.0/direct?q=" . urlencode($this->ciudad) . "&limit=1&appid=" . $this->apiKey;
    $respuesta = @file_get_contents($url);
    if ($respuesta === false) {
      return false;
    }
    $data = json_decode($respuesta, true);
    if (empty($data)) {
      return false;
    }
    $this->nombre = $data[0]['name'];
    $this->latitud = $data[0]['lat'];
    $this->longitud = $data[0]['lon'];
    return true;
  }
}
?>