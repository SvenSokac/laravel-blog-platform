<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spezia - Interactive Blogging Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('styles/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Added SweetAlert CSS for notifications -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> --}}
    <!--logo  -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://maps.googleapis.com/maps/api/js?key=g_lkfkvsdcasca5d2d6&libraries=maps"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <style>
        #map { height: 600px; width: 100%; }
    </style>
</head>

