@extends('layouts.app')
@section('content')
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Consuming google map api for searching  address</title>
  </head>
  <body>
    <div class="contanier m-5">
        <div class="alert alert-info">
          Integration of address functionality  using google map api in laravel web app
        </div>
        <form>
          <div class="mb-3">
            <label for="address-input" class="form-label">Search Address , City or Country</label>
            <input type="text" class="form-control map-input" id="address-input">
          </div>
          <hr>
            <div id="address-map-container" style="width: 100%;height: 400px;">
              <div style="width: 100%;height: 100%" id="address-map"></div>
              
            </div>
         </hr>
          <div class="mb-3">
            <label for="address-latitude" class="form-label">Latitude</label>
            <input type="password" class="form-control" id="address-latitude">
          </div>
          <div class="mb-3">
            <label for="address-longitude" class="form-label">Longitude</label>
            <input type="password" class="form-control" id="address-longitude">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyD7ldBfN1NhKaHkK7iGbAx5InQXyc7pFkI&callback" ></script>
    <!-- <script src="{{ asset('js/mapInput.js')}}" type="text/javascript"></script> -->
  </body>

</html>
<script type="text/javascript">
  google.maps.event.addDomListener(window, 'load', initialize);
function initialize() {
    var  marker_objects = [];
    const myLatLng = new google.maps.LatLng(23.022505, 72.5713621);
    const map = new google.maps.Map(document.getElementById("address-map"), {
        zoom: 5,
        center: myLatLng,
    });
} 
window.initialize = initialize;
</script>
@endsection
