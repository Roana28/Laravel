@extends('layouts.presensi')

@section('header')
<!-- App Header -->
<div class="appHeader text-dark" style="background-color: transparent;">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">FACE ATTENDANCE</div>
    <div class="right"></div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<style>
    .webcam-capture,
    .webcam-capture video {
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
        border-radius: 15px;
    }

    #map {
        height: 200px;
    }


</style>
@endsection

@section('content')
<div class="row" style="margin-top: 70px">
    <div class="col">
        <input type="hidden" id="lokasi">
        <div id="webcam" class="webcam-capture"></div>
    </div>
</div>

<div class="row mt-3">
    <div class="col">
        @if ($cek > 0) 
        <button id="takeabsen" class="btn btn-danger btn-block">
            <ion-icon name="camera-outline"></ion-icon>
            Absen Pulang
        </button>
        @else
        <button id="takeabsen" class="btn btn-primary btn-block">
            <ion-icon name="camera-outline"></ion-icon>
            Absen Masuk
        </button>
        @endif

    </div>
</div>

<div class="row mt-2">
    <div class="col">
        <div id="map"></div>
    </div>
</div>

<audio id="notifikasi_in">
    <source src="{{ asset('assets/sound/notifikasi_in.mp3') }}" type="audio/mpeg">
</audio>
<audio id="notifikasi_out">
    <source src="{{ asset('assets/sound/notifikasi_out.mp3') }}" type="audio/mpeg">
</audio>
<audio id="radius_sound">
    <source src="{{ asset('assets/sound/radius.mp3') }}" type="audio/mpeg">
</audio>
@endsection

@push('myscript')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<!-- WebcamJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    
    var notifikasi_in = document.getElementById('notifikasi_in')
    var notifikasi_out = document.getElementById('notifikasi_out')
    var radius_sound = document.getElementById('radius_sound')

    // Inisialisasi Webcam
    Webcam.set({
        height: 480,
        width: 640,
        image_format: 'jpeg',
        jpeg_quality: 80
    });

    Webcam.attach('#webcam');

    // Inisialisasi Lokasi & Peta
    var lokasi = document.getElementById('lokasi');

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    } else {
        alert("Browser tidak mendukung geolokasi.");
    }

    function successCallback(position) {
    lokasi.value = position.coords.latitude + "," + position.coords.longitude;

    var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
    var circle = L.circle([-6.229964711646418, 106.80697236624897],{
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 100
        }).addTo(map);
        
    }

    function errorCallback(error) {
        console.error("Geolocation error: ", error);
        alert("Gagal mendapatkan lokasi. Pastikan GPS aktif dan izin lokasi diberikan.");
    }

    $("#takeabsen").click(function(e) {
        Webcam.snap(function(uri) {
            image = uri;

            var lokasi = $("#lokasi").val();
            $.ajax({
                type: 'POST',
                url: '/presensi/store',
                data: {
                    _token: "{{ csrf_token() }}",
                    image: image,
                    lokasi: lokasi
                },
                cache: false,
                success: function(respond) {
                    var status = respond.split("|");
                    if (status[0] === "success") {
                        if(status[2]== "in"){
                            notifikasi_in.play();
                        } else {
                            notifikasi_out.play();
                        }
                        Swal.fire({
                            title: 'Berhasil!',
                            text: status[1],
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        setTimeout(function () {
                            window.location.href = "/dashboard";
                        }, 3000);
                    } else {
                        if(status[2]== "radius") {
                            radius_sound.play();
                        }
                        Swal.fire({
                            title: 'Error!',
                            text: status[1],
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });

        });
    });
</script>
@endpush
