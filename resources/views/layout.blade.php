<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >


</head>
<body>
    <div id="app">
        <app-layout></app-layout>
    </div>
    <script src="{{mix('js/app.js')}}"></script>
</body>
</html>
