<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet Marker with Fetch</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="crossorigin=""/>
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
            <link rel="stylesheet" href="leaflet-measure-path\leaflet-measure-path.css">
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
            <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet-src.js"></script>
            <script src="https://unpkg.com/leaflet-editable@latest/src/Leaflet.Editable.js" ></script>
            <script src="leaflet-measure-path\leaflet-measure-path.js"></script>
            <script src="https://unpkg.com/leaflet-realtime@2.2.0/dist/leaflet-realtime.js"></script>
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([-7.282111316601084, 112.79481616987013], 15);
        var polygon ;
        // Tambahkan TileLayer ke peta
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        function DotMarker(data){
                var latitude = data.latitude;
                var longitude = data.longitude;

                return [longitude,latitude];
        }
        function dynamicUpdate(){
        fetch('konek.php') 
            .then(response => response.json())
            .then(res => {
                var data = res.data;
                var mapping = data.map(function(data){
                    return DotMarker(data)
                })
                if (polygon) {
                        map.removeLayer(polygon);
                    }

                    // Tambahkan poligon baru
                    polygon =L.polygon(mapping,
                    {
                        showMeasurements: true,
                        measurementOptions: { showTotalDistance:true,
                        }
                    })
                    .updateMeasurements()
                    .addTo(map);
            })
        }

        setInterval(() => dynamicUpdate(), 1000);
    </script>
</body>
<script>
</script>
</html>
