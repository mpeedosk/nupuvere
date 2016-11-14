<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Nuppel">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Lehekülge ei leitud</title>

    <!-- Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">

    @if (App::isLocal())
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
    @else
        <link rel="stylesheet" href="{{secure_asset('css/main.css')}}">
    @endif

    <style>
        html, body {
            margin: 0;
            color: #313131;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 15em;
            line-height: 1em;
        }

        .sub-title {
            font-size: 3em;
            line-height: 1em;
            margin-bottom: 40px;
        }
        a {
            -webkit-box-shadow: inset 0 0 0 2px #EEEEEE;
            -moz-box-shadow: inset 0 0 0 2px #EEEEEE;
            -ms-box-shadow: inset 0 0 0 2px #EEEEEE;
            -o-box-shadow: inset 0 0 0 2px #EEEEEE;
            box-shadow: inset 0 0 0 2px #EEEEEE;
            border-radius: 5px;
            text-transform: uppercase;
            padding: 20px;
            background-color: #313131;
            color: #EEEEEE;
        }

    </style>
</head>
<body id="body-bg">

<div class="flex-center position-ref full-height ">
    <div class="content">
        <div class="title">
            404
        </div>
        <div class="sub-title">
            Lehekülge ei leitud
        </div>

        <a href="/" class="bu"> Tagasi pealehele</a>
    </div>
</div>
</body>
</html>
