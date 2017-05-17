<html>
<head>
    <title>@yield('title')</title>

        <!-- Material Design fonts -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Bootstrap Material Design -->
    {{--<link rel="stylesheet" type="text/css" href="/css/bootstrap-material-design.css">--}}
    <!-- <link rel="stylesheet" type="text/css" href="/css/ripples.min.css"> -->

    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <!-- bxSlider Javascript file -->
    <script src="{{asset('/js/jquery.bxslider.min.js')}}"></script>
    <!-- bxSlider CSS file -->
    <link href="{{asset('/css/jquery.bxslider.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="bg-white">
	@include('shared.navbar')
	@yield('content')
	<!-- <script src="/js/ripples.min.js"></script> -->
	<script src="/js/material.min.js"></script>
	<script>
    $(document).ready(function() {
        // This command is used to initialize some elements and make them work properly
        $.material.init();
    });
    </script>
    @yield('scripts')
    <footer>
    <div class="row footer">
        <div class="col-md-12 feedback">
            <p>
                <img src="/images/phone.png"/>Закать обратный звонок</p>
        </div>
        <div class="col-md-4">
            <h4>Интернет магазин</h4>
            <ul>
                <li><a>Главная</a></li>
                <li><a>Каталог</a></li>
                <li><a>Доставка</a></li>
                <li><a>Контакты</a></li>
                <li><a>О нас</a></li>
            </ul>
        </div>
        <div class="col-md-4 middle">
            <h4>Контакты</h4>
            <p>
                +7(913)123 45 00
            </p>
            <p>
                +7(913)123 45 99
            </p>
        </div>
        <div class="col-md-4">
            <h4>AppleMarket</h4>
            <p>
                Мы в социальных сетях:
            </p>
        </div>
        <div class="col-md-12 copyright">
            <p>Заказать обратный звонок</p>
        </div>
    </div>

    </footer>
</body>
</html>