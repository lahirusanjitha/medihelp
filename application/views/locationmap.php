<?php 
include "include/header.php";  
include "include/topnavbar.php"; 
?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include "include/menubar.php"; ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="page-header page-header-light bg-white shadow">
                <div class="container-fluid">
                    <div class="page-header-content py-3">
                        <h1 class="page-header-title font-weight-light">
                            <div class="page-header-icon"><i data-feather="map"></i></div>
                            <span>Location Map</span>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body p-2">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </main>
        <?php include "include/footerbar.php"; ?>
    </div>
</div>
</div>

<?php include "include/footerscripts.php"; ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var mapStyle = "height: 500px; width: 100%; margin-top: 20px;";
    document.getElementById("map").setAttribute("style", mapStyle);

    var map = L.map('map').setView([7.8731, 80.7718], 7);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url('Locationtrack/get_locations') ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    var customIcon = L.icon({
                    iconUrl: "https://maps.google.com/mapfiles/ms/icons/red-dot.png", 
                    iconSize: [32, 32], 
                    iconAnchor: [16, 32], 
                    popupAnchor: [0, -32] 
                });

                for (var i = 0; i < data.length; i++) {
                    L.marker([data[i].latitude, data[i].longitude], { icon: customIcon })
                    .addTo(map)
                    .bindPopup(data[i].name);
                }

                }
            }
        });
    });
</script>

<?php include "include/footer.php"; ?>
