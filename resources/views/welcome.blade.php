<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Material Design fonts -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <!-- Bootstrap Material Design -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/ripples.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-material-design.css')}}">

</head>
<body>

<H1> Hello World! </H1>
<H2> CI working </H2>

<!-- Twitter Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Material Design for Bootstrap -->
<script src={{asset('js/material.js')}}></script>
<script src={{asset('js/ripples.min.js')}}></script>
<script>
    $.material.init();
</script>
</body>
</html>
