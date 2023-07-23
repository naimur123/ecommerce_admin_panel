<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $system->application_name }}</title>
    {{-- <meta http-equiv="refresh" content="30"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- BootStrap Path -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
   
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   
    {{-- Summer Note --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    {{-- Datatable --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.css"/>

    {{-- Custom Css --}}
    <link rel="stylesheet" href="{{ asset('custom/app.css') }}">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    
</head>