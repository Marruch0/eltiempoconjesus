# Proyecto Final IAW
# El tiempo con jesus
## Índice
- [Introducción](#introducción)
- [Objetivo del Proyecto](#objetivo-del-proyecto)
- [Características](#características)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Descripción del Código](#descripción-del-código)
  - [index.php](#indexphp)
  - [Geolocalizacion.php](#geolocalizacionphp)
  - [Clima.php](#climaphp)
  - [process.php](#processphp)
  - [tiempo_actual.php](#tiempo_actualphp)
  - [pronostico_horas.php](#pronostico_horasphp)
  - [pronostico_días.php](#pronostico_díasphp)

## Introducción

En este proyecto, se ha desarrollado una aplicación web sencilla para consultar el estado del tiempo. La aplicación permite obtener el clima actual, un pronóstico por horas y otro diario (agrupado cada 3 horas) utilizando la API de OpenWeather.

## Objetivo del Proyecto

El objetivo principal es poner en práctica el consumo de APIs externas y el uso de la programación orientada a objetos en PHP. Además se busca crear una interfaz limpia y moderna utilizando Bootstrap y Highcharts, que permita obtener y visualizar la información meteorológica de forma sencilla.

## Características

- **Clima Actual:** Consulta y muestra la temperatura, velocidad y dirección del viento, así como una breve descripción del estado del tiempo.
- **Pronóstico por Horas:** Presenta los datos del pronóstico cada 3 horas durante las próximas 24 horas mediante un gráfico.
- **Pronóstico Diario:** Agrupa los datos cada 3 horas para generar un resumen (temperatura máxima y mínima) de hasta 5 días, mostrado en una gráfica.
- **Programación Orientada a Objetos:** Uso de clases como `Geolocalizacion` y `Clima` para organizar el código de forma modular y comprensible.
- **Interfaz Moderna:** Empleo de Bootstrap para los estilos y Highcharts para la visualización de datos.

## Estructura del Proyecto

El proyecto consta de los siguientes archivos:

- **index.php:** Página inicial en la que se introduce el nombre de la ciudad.
- **Geolocalizacion.php:** Clase que se encarga de obtener el nombre real, la latitud y la longitud de la ciudad mediante la API de geolocalización de OpenWeather.
- **Clima.php:** Clase que gestiona la obtención de datos meteorológicos, tanto del clima actual, como de los pronósticos por horas y diarios.
- **process.php:** Procesa la información ingresada en el formulario, obtiene las coordenadas mediante la clase `Geolocalizacion` y almacena esos datos en sesión.
- **tiempo_actual.php:** Muestra la información del clima actual utilizando los datos proporcionados por la clase `Clima`.
- **pronostico_horas.php:** Genera un gráfico del pronóstico por horas (aproximadamente las siguientes 24 horas) a partir de los datos de OpenWeather.
- **pronostico_días.php:** Muestra la evolución diaria del clima (para hasta 5 días) agrupando los datos cada 3 horas para calcular la temperatura máxima y mínima.

## Descripción del Código

### index.php
En este archivo se presenta el formulario principal donde se solicita al usuario que ingrese el nombre de la ciudad. Se utiliza Bootstrap para garantizar un diseño claro y atractivo, y se ha añadido un fondo con imagen temática.

### Geolocalizacion.php
Aquí se implementa la clase `Geolocalizacion`. El constructor recibe el nombre de la ciudad y la API Key. El método `obtenerCoordenadas()` realiza la llamada a la API de geocodificación de OpenWeather, obteniendo y guardando el nombre correcto de la ciudad junto a sus coordenadas.

### Clima.php
La clase `Clima` se encarga de todo lo relacionado con la consulta del clima:
- `obtenerClimaActual()`: Consulta y devuelve el clima actual.
- `obtenerPronosticoHoras()`: Devuelve los datos del pronóstico en intervalos de 3 horas.
- `obtenerPronosticoDiario()`: Agrupa los datos obtenidos para generar un resumen diario (hasta 5 días) con la temperatura máxima y mínima.

### process.php
Este archivo recibe la entrada del usuario desde `index.php`, instancia la clase `Geolocalizacion`, obtiene los datos correspondientes y los almacena en la sesión, permitiendo que otros archivos accedan a ellos.

### tiempo_actual.php
Utilizando la clase `Clima`, se muestran los datos del clima actual: temperatura, velocidad y dirección del viento, y una descripción que se representa tanto en texto como en un gráfico sencillo creado con Highcharts.

### pronostico_horas.php
Extrae los datos del pronóstico por horas (utilizando los primeros 8 registros para cubrir unas 24 horas) y muestra una gráfica interactiva usando Highcharts.

### pronostico_días.php
En este archivo se realiza una llamada al endpoint Forecast 5 de OpenWeather. Los datos se agrupan por día, calculando para cada uno la temperatura máxima y mínima. Esta información se visualiza mediante un gráfico interactivo generado con Highcharts.
