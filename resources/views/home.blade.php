<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Hackerrank_meaningful_logo.svg/1200px-Hackerrank_meaningful_logo.svg.png" type="image/gif" sizes="16x16">
        <title>Challenge App Mini</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <!-- Fonts -->
        <style>
            .loader {
                width: 320px;
                height: 150px;
                margin: auto;
                display: block;
                position: relative;
                box-sizing: border-box;
            }
            .loader::after {
                content: '';
                width: calc(100% - 30px);
                height: calc(100% - 30px);
                top: 15px;
                left: 15px;
                background: #FFF;
                position: absolute;
                background-image: linear-gradient(100deg, transparent, rgba(255, 255, 255, 0.5) 50%, transparent 80%), linear-gradient(#DDD 56px, transparent 0), linear-gradient(#DDD 24px, transparent 0), linear-gradient(#DDD 18px, transparent 0), linear-gradient(#DDD 66px, transparent 0);
                background-repeat: no-repeat;
                background-size: 75px 130px, 55px 56px, 160px 30px, 260px 20px, 290px 56px;
                background-position: 0% 0, 0 0, 70px 5px, 70px 38px, 0px 66px;
                box-sizing: border-box;
                animation: animloader 1s linear infinite;
            }

            @keyframes animloader {
                0% {
                    background-position: 0% 0, 0 0, 70px 5px, 70px 38px, 0px 66px;
                }
                100% {
                    background-position: 150% 0, 0 0, 70px 5px, 70px 38px, 0px 66px;
                }
            }


            .antialiased{
                height: 100vh;
                background: #f3f7f7;
            }


            .loader-head {
                position: relative;
                height: 10px;
                width: 200px;
                border-bottom: 3px solid #ff3d00;
                box-sizing: border-box;
                animation: drawLine 4s linear infinite;
            }
            .loader-head:before {
                content: "";
                position: absolute;
                left: calc(100% + 14px);
                bottom: -6px;
                width: 16px;
                height: 100px;
                border-radius: 20px 20px 50px 50px;
                background-repeat: no-repeat;
                background-image: linear-gradient(#ff3d00 6px, transparent 0),
                    linear-gradient(45deg, rgba(0, 0, 0, 0.02) 49%, white 51%),
                    linear-gradient(315deg, rgba(0, 0, 0, 0.02) 49%, white 51%),
                    linear-gradient( to bottom, #ffffff 10%, #ff3d00 10%, #ff3d00 90%, #ffffff 90% );
                background-size: 3px 3px, 8px 8px, 8px 8px, 16px 88px;
                background-position: center bottom, left 88px, right 88px, left top;
                transform: rotate(25deg);
                animation: pencilRot 4s linear infinite;
            }

            @keyframes drawLine {
                0%, 100% { width: 0px }
                45%, 55% { width: 200px }
            }

            @keyframes pencilRot {
                0%, 45% {
                    bottom: -6px;
                    left: calc(100% + 14px);
                    transform: rotate(25deg);
                }
                55%,
                100% {
                    bottom: -12px;
                    left: calc(100% + 16px);
                    transform: rotate(220deg);
                }
            }
        </style>
    </head>
    <body class="antialiased">
        <div id="app">
            <router-view></router-view>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>
