@include('helpers.head')

<body class="bg-dark text-light transition-colors duration-300">
    @include('helpers.navbar')

<h2>User Locations Map</h2>

<div id="map"></div>


    <!-- Footer -->
    @include('helpers.footer')

    <!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Initial world map view
    var map = L.map('map').setView([20, 0], 2);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    // Visitor data from controller
    var visitors = @json($visitors);

    visitors.forEach(function(v) {
        if (v.latitude && v.longitude) {
            L.marker([v.latitude, v.longitude]).addTo(map)
                .bindPopup(`<b>${v.city}</b><br>${v.country}<br>IP: ${v.ip}`);
        }
    });
</script>


</body>
</html>
